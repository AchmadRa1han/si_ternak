<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    /**
     * Halaman Dashboard Utama
     */
    public function index()
    {
        $mDashboard = new DashboardModel();

        $data['title'] = 'Dashboard';

        // Data untuk Info Boxes
        $data['total_kelompok'] = $mDashboard->countKelompok();
        $data['laporan_perkembangan'] = $mDashboard->countLaporanPerkembangan();
        $data['total_ib'] = $mDashboard->countIbBulanIni();
        $data['laporan_pakan'] = $mDashboard->countLaporanPakan();
        $data['total_hewan'] = $mDashboard->countHewan();

        // Data untuk Chart
        $chart_data = $mDashboard->getPakanChartData();
        $labels = [];
        $values = [];
        $month_names = ["", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

        foreach ($chart_data as $row) {
            $labels[] = $month_names[(int)$row['bulan']] . ' ' . $row['tahun'];
            $values[] = (int)$row['total_produksi'];
        }

        $data['chart_labels'] = json_encode($labels);
        $data['chart_values'] = json_encode($values);
        
        // Di CI4, view bisa dikembalikan sebagai string yang digabung
        return view('template/header', $data)
             . view('dashboard/v_dashboard', $data)
             . view('template/footer');
    }
}
