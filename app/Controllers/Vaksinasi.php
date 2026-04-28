<?php

namespace App\Controllers;

use App\Models\DatVaksinasiModel;
use CodeIgniter\Files\File;

class Vaksinasi extends BaseController
{
    protected $vaksinasiModel;

    public function __construct()
    {
        $this->vaksinasiModel = new DatVaksinasiModel();
    }

    public function index()
    {
        $data['title'] = 'Upload Laporan Vaksinasi';
        return view('template/header', $data)
             . view('vaksinasi/v_upload', $data)
             . view('template/footer');
    }

    public function rekap()
    {
        $data['title'] = 'Rekapitulasi Laporan Vaksinasi';
        $data['rekap'] = $this->vaksinasiModel->getRekapByMonth();
        return view('template/header', $data)
             . view('vaksinasi/v_rekap', $data)
             . view('template/footer');
    }

    public function process_upload()
    {
        $file = $this->request->getFile('zip_file');

        if (!$file->isValid()) {
            session()->setFlashdata('error', $file->getErrorString());
            return redirect()->to(base_url('vaksinasi'));
        }

        $newName = $file->getRandomName();
        $uploadPath = WRITEPATH . 'uploads/vaksinasi/';
        $file->move($uploadPath, $newName);

        $zipPath = $uploadPath . $newName;
        $zip = new \ZipArchive();

        if ($zip->open($zipPath) === TRUE) {
            $extractPath = $uploadPath . pathinfo($newName, PATHINFO_FILENAME);
            $zip->extractTo($extractPath);
            $zip->close();
            unlink($zipPath);

            $csvFiles = glob($extractPath . '/*.csv');
            if (empty($csvFiles)) {
                session()->setFlashdata('error', 'File CSV tidak ditemukan di dalam ZIP.');
                return redirect()->to(base_url('vaksinasi'));
            }

            $csvFilePath = $csvFiles[0];
            $totalImported = 0;
            $batchData = [];

            if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
                // Map column index to specific keys we want
                $header = fgetcsv($handle, 0, ",");
                $expectedColumns = [
                    'id_program', 'program_vaksinasi', 'id_penyakit', 'penyakit', 
                    'provinsi', 'kabupaten', 'kecamatan', 'desa', 'tanggal_vaksinasi', 
                    'urutan_vaksinasi', 'namapetugas', 'nomorpetugas', 'identifikasihewan', 
                    'eartag', 'rumpun', 'hewan', 'jenis_kelamin', 'umur', 'namapemilik', 
                    'telppemilik', 'nikpemilik'
                ];

                while (($row = fgetcsv($handle, 0, ",")) !== FALSE) {
                    if (count($header) != count($row)) continue;
                    
                    // Filter row logic to only map headers that match our DB columns
                    $dataRow = [];
                    foreach ($header as $idx => $colName) {
                        $cleanColName = strtolower(trim($colName));
                        if (in_array($cleanColName, $expectedColumns)) {
                            $dataRow[$cleanColName] = $row[$idx];
                        }
                    }

                    if (isset($dataRow['kabupaten']) && strtolower(trim($dataRow['kabupaten'])) == 'sinjai') {
                        // Reformat dates from d/m/Y to Y-m-d if needed, though iSikhnas CSVs usually use Y-m-d or d/m/Y
                        if (isset($dataRow['tanggal_vaksinasi'])) {
                            $dateParts = explode('/', $dataRow['tanggal_vaksinasi']);
                            if (count($dateParts) == 3) {
                                $dataRow['tanggal_vaksinasi'] = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
                            }
                        }

                        $dataRow['created_by'] = session()->get('user_id');
                        $batchData[] = $dataRow;

                        if (count($batchData) >= 1000) {
                            $this->vaksinasiModel->insertBatchCustom($batchData);
                            $totalImported += count($batchData);
                            $batchData = [];
                        }
                    }
                }
                if (!empty($batchData)) {
                    $this->vaksinasiModel->insertBatchCustom($batchData);
                    $totalImported += count($batchData);
                }
                fclose($handle);
            }

            session()->setFlashdata('success', "Berhasil mengimpor $totalImported data.");
            return redirect()->to(base_url('vaksinasi'));
        } else {
            session()->setFlashdata('error', 'Gagal membuka file ZIP.');
            return redirect()->to(base_url('vaksinasi'));
        }
    }
}
