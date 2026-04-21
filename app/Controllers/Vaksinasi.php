<?php

namespace App\Controllers;

use App\Models\VaksinasiModel;
use CodeIgniter\Files\File;

class Vaksinasi extends BaseController
{
    protected $vaksinasiModel;

    public function __construct()
    {
        $this->vaksinasiModel = new VaksinasiModel();
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
                $header = fgetcsv($handle, 0, ",");
                while (($row = fgetcsv($handle, 0, ",")) !== FALSE) {
                    if (count($header) != count($row)) continue;
                    $dataRow = array_combine($header, $row);

                    if (isset($dataRow['kabupaten']) && strtolower(trim($dataRow['kabupaten'])) == 'sinjai') {
                        $batchData[] = [
                            'id'                => $dataRow['id'],
                            'program_vaksinasi' => $dataRow['program_vaksinasi'],
                            'penyakit'          => $dataRow['penyakit'],
                            'kecamatan'         => $dataRow['kecamatan'],
                            'desa'              => $dataRow['desa'],
                            'tanggal_vaksinasi' => $dataRow['tanggal_vaksinasi'],
                            'namapetugas'       => $dataRow['namapetugas'],
                            'eartag'            => $dataRow['eartag'],
                            'namapemilik'       => $dataRow['namapemilik'],
                        ];

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
