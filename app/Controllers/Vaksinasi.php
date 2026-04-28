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
        $data['title'] = 'Data Vaksinasi Ternak';
        // Pagination for better performance
        $data['vaksinasi'] = $this->vaksinasiModel->orderBy('tanggal_vaksinasi', 'DESC')->paginate(20, 'vaksinasi');
        $data['pager'] = $this->vaksinasiModel->pager;
        
        return view('template/header', $data)
             . view('vaksinasi/v_vaksinasi_index', $data)
             . view('template/footer');
    }

    public function upload()
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

    public function rekap_petugas()
    {
        $periode = $this->request->getGet('periode');
        $bulan = null;
        $tahun = null;

        if ($periode) {
            $parts = explode('-', $periode);
            if (count($parts) == 2) {
                $bulan = $parts[0];
                $tahun = $parts[1];
            }
        }

        $data['title'] = 'Rekapitulasi Vaksinasi per Petugas';
        $data['rekap'] = $this->vaksinasiModel->getRekapByPetugas($bulan, $tahun);
        $data['grouped_periods'] = $this->vaksinasiModel->getGroupedPeriods();
        $data['selected_period'] = $periode;

        return view('template/header', $data)
             . view('vaksinasi/v_rekap_petugas', $data)
             . view('template/footer');
    }

    public function process_upload()
    {
        $file = $this->request->getFile('zip_file');

        if (!$file->isValid()) {
            session()->setFlashdata('error', $file->getErrorString());
            return redirect()->to(base_url('vaksinasi/upload'));
        }

        $newName = $file->getRandomName();
        $uploadPath = WRITEPATH . 'uploads/vaksinasi/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
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
                return redirect()->to(base_url('vaksinasi/upload'));
            }

            $csvFilePath = $csvFiles[0];
            $totalImported = 0;
            $batchData = [];

            if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
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
                    
                    $dataRow = [];
                    foreach ($header as $idx => $colName) {
                        $cleanColName = strtolower(trim($colName));
                        if (in_array($cleanColName, $expectedColumns)) {
                            $dataRow[$cleanColName] = $row[$idx];
                        }
                    }

                    if (isset($dataRow['kabupaten']) && strtolower(trim($dataRow['kabupaten'])) == 'sinjai') {
                        if (isset($dataRow['tanggal_vaksinasi'])) {
                            $dateStr = $dataRow['tanggal_vaksinasi'];
                            // Try to detect format d/m/Y or Y-m-d
                            if (strpos($dateStr, '/') !== false) {
                                $dateParts = explode('/', $dateStr);
                                if (count($dateParts) == 3) {
                                    $dataRow['tanggal_vaksinasi'] = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
                                }
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

            // Cleanup extracted files
            $this->deleteDirectory($extractPath);

            session()->setFlashdata('success', "Berhasil mengimpor $totalImported data.");
            return redirect()->to(base_url('vaksinasi'));
        } else {
            session()->setFlashdata('error', 'Gagal membuka file ZIP.');
            return redirect()->to(base_url('vaksinasi/upload'));
        }
    }

    private function deleteDirectory($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) return false;
        }
        return rmdir($dir);
    }
}
