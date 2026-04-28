<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI TERNAK | <?= $title ?? 'Dashboard' ?></title>

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

<div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: true }">
  <!-- Sidebar -->
  <aside class="bg-[#1a120b] text-white w-64 flex-shrink-0 transition-all duration-300 ease-in-out overflow-y-auto" 
         :class="sidebarOpen ? 'ml-0' : '-ml-64'">
    <div class="p-6 flex items-center justify-between border-b border-stone-800 sticky top-0 bg-[#1a120b] z-10">
      <span class="text-2xl font-bold tracking-widest text-[#a27b5c]">SI-TERNAK</span>
    </div>
    <nav class="mt-6 px-4 pb-10 space-y-2">
      <!-- Main Section -->
      <div class="pb-2 px-4 text-xs font-bold text-stone-500 uppercase tracking-widest">Main</div>
      <a href="<?= site_url('dashboard') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (current_url() == site_url('dashboard')) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-tachometer-alt w-6"></i> Dashboard
      </a>

      <!-- Master Data Section -->
      <div class="pt-6 pb-2 px-4 text-xs font-bold text-stone-500 uppercase tracking-widest">Master Data</div>
      <a href="<?= site_url('user') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'user') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-users-cog w-6"></i> Manajemen Petugas
      </a>
      <a href="<?= site_url('master/peternak') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'peternak') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-user-friends w-6"></i> Data Pemilik
      </a>
      <a href="<?= site_url('master/hewan') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'hewan') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-paw w-6"></i> Data Ternak
      </a>

      <!-- Pelayanan Section -->
      <div class="pt-6 pb-2 px-4 text-xs font-bold text-stone-500 uppercase tracking-widest">Pelayanan</div>
      <a href="<?= site_url('inseminasi') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'inseminasi') !== false && strpos(current_url(), 'pkb') === false && strpos(current_url(), 'kelahiran') === false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-syringe w-6"></i> Inseminasi Buatan
      </a>
      <a href="<?= site_url('inseminasi/pkb') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'pkb') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-stethoscope w-6"></i> Pemeriksaan PKB
      </a>
      <a href="<?= site_url('inseminasi/kelahiran') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'kelahiran') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-baby w-6"></i> Data Kelahiran
      </a>
      <a href="<?= site_url('vaksinasi') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'vaksinasi') !== false && strpos(current_url(), 'rekap') === false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-shield-virus w-6"></i> Vaksinasi
      </a>

      <!-- Pakan & Produksi -->
      <div class="pt-6 pb-2 px-4 text-xs font-bold text-stone-500 uppercase tracking-widest">Pakan & Produksi</div>
      <a href="<?= site_url('pakan') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'pakan/index') !== false || current_url() == site_url('pakan')) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-seedling w-6"></i> Stok Pakan
      </a>
      <a href="<?= site_url('pakan/laporan_produksi') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'laporan_produksi') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-industry w-6"></i> Laporan Produksi
      </a>
      <a href="<?= site_url('pakan/laporan_bulanan') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'laporan_bulanan') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-calendar-check w-6"></i> Laporan Bulanan
      </a>

      <!-- Perkembangan Section -->
      <div class="pt-6 pb-2 px-4 text-xs font-bold text-stone-500 uppercase tracking-widest">Perkembangan</div>
      <a href="<?= site_url('perkembangan/kelompok') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'kelompok') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-layer-group w-6"></i> Kelompok Ternak
      </a>
      <a href="<?= site_url('perkembangan/laporan') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'laporan') !== false && strpos(current_url(), 'pakan') === false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-chart-line w-6"></i> Laporan Populasi
      </a>

      <!-- Laporan Section -->
      <div class="pt-6 pb-2 px-4 text-xs font-bold text-stone-500 uppercase tracking-widest">Laporan Akhir</div>
      <a href="<?= site_url('vaksinasi/rekap') ?>" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl hover:bg-[#a27b5c] transition-all duration-300 <?= (strpos(current_url(), 'rekap') !== false) ? 'bg-[#a27b5c]' : '' ?>">
        <i class="fas fa-file-contract w-6"></i> Rekapitulasi Umum
      </a>
    </nav>
  </aside>

  <!-- Main Content Area -->
  <div class="flex-1 flex flex-col min-w-0 h-screen">
    <!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 border-b border-stone-200 flex-shrink-0">
      <div class="px-6 h-20 flex items-center justify-between">
        <button @click="sidebarOpen = !sidebarOpen" class="text-stone-600 hover:text-[#1a120b] focus:outline-none transition-colors p-2 hover:bg-stone-50 rounded-lg">
          <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="flex items-center gap-6">
          <div class="hidden md:flex flex-col items-end">
            <span class="text-sm font-bold text-[#1a120b]"><?= session()->get('nama_lengkap') ?? 'Petugas Lapangan' ?></span>
            <span class="text-[10px] font-bold text-stone-400 uppercase tracking-tighter">Sistem Informasi Peternakan</span>
          </div>
          <a href="<?= site_url('auth/logout') ?>" class="px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-all duration-300 flex items-center gap-2 shadow-sm shadow-red-100">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </div>
    </header>

    <!-- Page Content Scrollable Area -->
    <div class="flex-1 overflow-y-auto">
      <main class="p-8">
        <div class="mb-10 border-b border-stone-200 pb-6"
             x-data="{ show: false }" 
             x-init="setTimeout(() => show = true, 50)"
             x-show="show"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
          <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= $title ?? 'Dashboard' ?></h1>
        </div>
