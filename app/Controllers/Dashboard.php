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
        $data['total_petugas'] = $mDashboard->countPetugas();
        $data['total_pemilik'] = $mDashboard->countPemilik();
        $data['total_ternak'] = $mDashboard->countTernak();
        $data['total_vaksinasi'] = $mDashboard->countVaksinasi();

        // Di CI4, view bisa dikembalikan sebagai string yang digabung
        return view('template/header', $data)
             . view('dashboard/v_dashboard', $data)
             . view('template/footer');
    }
}
