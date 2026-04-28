<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI-TERNAK | Portal Utama</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-[#faf7f2] min-h-screen">

<div class="container mx-auto px-6 py-20 max-w-6xl">
    <!-- Header Portal -->
    <div class="text-center mb-16"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-8">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-[#1a120b] rounded-[2.5rem] shadow-2xl mb-8 transform hover:scale-110 transition-transform duration-500">
            <i class="fas fa-paw text-[#a27b5c] text-4xl"></i>
        </div>
        <h1 class="text-5xl font-extrabold text-[#1a120b] tracking-[0.2em] uppercase mb-4">SI-TERNAK</h1>
        <p class="text-stone-500 text-lg font-medium max-w-2xl mx-auto">Sistem Informasi Pengelolaan Ternak - Portal Navigasi Mandiri & Cepat</p>
    </div>

    <!-- Grid Navigasi -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
         x-show="show" x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 transform translate-y-12">
        
        <!-- Section: Auth -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-stone-100 hover:shadow-xl transition-all duration-500 group">
            <div class="w-14 h-14 bg-stone-50 rounded-2xl flex items-center justify-center mb-6 text-[#1a120b] group-hover:bg-[#1a120b] group-hover:text-white transition-all duration-500">
                <i class="fas fa-lock text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a120b] mb-4">Akses & Admin</h3>
            <div class="space-y-3">
                <a href="<?= site_url('auth') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Halaman Login</a>
                <a href="<?= site_url('admin/dashboard') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Admin Dashboard</a>
            </div>
        </div>

        <!-- Section: Dashboard -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-stone-100 hover:shadow-xl transition-all duration-500 group">
            <div class="w-14 h-14 bg-stone-50 rounded-2xl flex items-center justify-center mb-6 text-[#1a120b] group-hover:bg-[#1a120b] group-hover:text-white transition-all duration-500">
                <i class="fas fa-tachometer-alt text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a120b] mb-4">Dashboard & Inseminasi</h3>
            <div class="space-y-3">
                <a href="<?= site_url('dashboard') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">User Dashboard</a>
                <a href="<?= site_url('inseminasi') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Inseminasi Buatan</a>
                <a href="<?= site_url('inseminasi/pkb') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Data PKB</a>
                <a href="<?= site_url('inseminasi/kelahiran') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Data Kelahiran</a>
            </div>
        </div>

        <!-- Section: Master Data -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-stone-100 hover:shadow-xl transition-all duration-500 group">
            <div class="w-14 h-14 bg-stone-50 rounded-2xl flex items-center justify-center mb-6 text-[#1a120b] group-hover:bg-[#1a120b] group-hover:text-white transition-all duration-500">
                <i class="fas fa-database text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a120b] mb-4">Master Data Utama</h3>
            <div class="space-y-3">
                <a href="<?= site_url('master/petugas') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Manajemen Petugas</a>
                <a href="<?= site_url('master/peternak') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Data Pemilik</a>
                <a href="<?= site_url('master/hewan') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Data Ternak</a>
            </div>
        </div>

        <!-- Section: Pakan -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-stone-100 hover:shadow-xl transition-all duration-500 group">
            <div class="w-14 h-14 bg-stone-50 rounded-2xl flex items-center justify-center mb-6 text-[#1a120b] group-hover:bg-[#1a120b] group-hover:text-white transition-all duration-500">
                <i class="fas fa-leaf text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a120b] mb-4">Pakan & Produksi</h3>
            <div class="space-y-3">
                <a href="<?= site_url('pakan') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Master Jenis Pakan</a>
                <a href="<?= site_url('pakan/laporan_produksi') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Laporan Produksi</a>
                <a href="<?= site_url('pakan/laporan_bulanan') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Rekap Bulanan</a>
            </div>
        </div>

        <!-- Section: Vaksin -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-stone-100 hover:shadow-xl transition-all duration-500 group">
            <div class="w-14 h-14 bg-stone-50 rounded-2xl flex items-center justify-center mb-6 text-[#1a120b] group-hover:bg-[#1a120b] group-hover:text-white transition-all duration-500">
                <i class="fas fa-syringe text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a120b] mb-4">Vaksinasi & Kesehatan</h3>
            <div class="space-y-3">
                <a href="<?= site_url('vaksinasi') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Upload Data Vaksin</a>
                <a href="<?= site_url('vaksinasi/rekap') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Rekapitulasi Vaksin</a>
            </div>
        </div>

        <!-- Section: Perkembangan -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-stone-100 hover:shadow-xl transition-all duration-500 group">
            <div class="w-14 h-14 bg-stone-50 rounded-2xl flex items-center justify-center mb-6 text-[#1a120b] group-hover:bg-[#1a120b] group-hover:text-white transition-all duration-500">
                <i class="fas fa-chart-line text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a120b] mb-4">Perkembangan</h3>
            <div class="space-y-3">
                <a href="<?= site_url('perkembangan/kelompok') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Kelompok Ternak</a>
                <a href="<?= site_url('perkembangan/laporan') ?>" class="block px-4 py-3 bg-stone-50 hover:bg-[#a27b5c] hover:text-white text-[#1a120b] text-sm font-bold rounded-xl transition-all duration-300">Laporan Perkembangan</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-20">
        <p class="text-stone-400 text-sm font-medium">
            &copy; <?= date('Y') ?> SI-TERNAK - Dinas Peternakan. Dikembangkan dengan <i class="fas fa-heart text-[#a27b5c]"></i> oleh Gemini CLI.
        </p>
    </div>
</div>

</body>
</html>
