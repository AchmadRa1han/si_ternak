<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide">Dashboard</h1>
        <div class="text-stone-500 text-sm font-medium">
            <?= date('l, d F Y') ?>
        </div>
    </div>

    <!-- Statistik Cards (Staggered Reveal) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Card Petugas -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-100 hover:border-[#a27b5c] transition-all duration-300 group"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
             x-show="show" x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-8">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-stone-50 rounded-xl group-hover:bg-[#faf7f2] transition-colors">
                    <i class="fas fa-user-tie text-2xl text-[#1a120b]"></i>
                </div>
                <span class="text-2xl font-bold text-[#1a120b]"><?= number_format($total_petugas) ?></span>
            </div>
            <h3 class="text-sm font-bold text-stone-400 uppercase tracking-widest mb-1">Petugas</h3>
            <p class="text-stone-500 text-sm mb-4">Total petugas lapangan</p>
            <a href="<?= site_url('user') ?>" class="inline-flex items-center text-sm font-bold text-[#a27b5c] hover:text-[#1a120b] transition-colors">
                Manajemen <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>

        <!-- Card Pemilik -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-100 hover:border-[#a27b5c] transition-all duration-300 group"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)"
             x-show="show" x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-8">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-stone-50 rounded-xl group-hover:bg-[#faf7f2] transition-colors">
                    <i class="fas fa-users text-2xl text-[#1a120b]"></i>
                </div>
                <span class="text-2xl font-bold text-[#1a120b]"><?= number_format($total_pemilik) ?></span>
            </div>
            <h3 class="text-sm font-bold text-stone-400 uppercase tracking-widest mb-1">Peternak</h3>
            <p class="text-stone-500 text-sm mb-4">Total pemilik terdaftar</p>
            <a href="<?= site_url('master/peternak') ?>" class="inline-flex items-center text-sm font-bold text-[#a27b5c] hover:text-[#1a120b] transition-colors">
                Data Pemilik <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>

        <!-- Card Ternak -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-100 hover:border-[#a27b5c] transition-all duration-300 group"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 400)"
             x-show="show" x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-8">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-stone-50 rounded-xl group-hover:bg-[#faf7f2] transition-colors">
                    <i class="fas fa-paw text-2xl text-[#1a120b]"></i>
                </div>
                <span class="text-2xl font-bold text-[#1a120b]"><?= number_format($total_ternak) ?></span>
            </div>
            <h3 class="text-sm font-bold text-stone-400 uppercase tracking-widest mb-1">Populasi</h3>
            <p class="text-stone-500 text-sm mb-4">Total populasi ternak</p>
            <a href="<?= site_url('master/hewan') ?>" class="inline-flex items-center text-sm font-bold text-[#a27b5c] hover:text-[#1a120b] transition-colors">
                Data Ternak <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>

        <!-- Card Vaksinasi -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-100 hover:border-[#a27b5c] transition-all duration-300 group"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)"
             x-show="show" x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-8">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-stone-50 rounded-xl group-hover:bg-[#faf7f2] transition-colors">
                    <i class="fas fa-syringe text-2xl text-[#1a120b]"></i>
                </div>
                <span class="text-2xl font-bold text-[#1a120b]"><?= number_format($total_vaksinasi) ?></span>
            </div>
            <h3 class="text-sm font-bold text-stone-400 uppercase tracking-widest mb-1">Vaksinasi</h3>
            <p class="text-stone-500 text-sm mb-4">Total riwayat vaksinasi</p>
            <a href="<?= site_url('vaksinasi/rekap') ?>" class="inline-flex items-center text-sm font-bold text-[#a27b5c] hover:text-[#1a120b] transition-colors">
                Lihat Rekap <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 650)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="p-8 md:p-12 flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-[#1a120b] mb-4 tracking-tight">Selamat Datang di SI-TERNAK</h2>
                <div class="space-y-4 text-stone-600 leading-relaxed">
                    <p>Halo <span class="font-bold text-[#1a120b]"><?= session()->get('nama_lengkap') ?? 'Admin' ?></span>, selamat datang kembali di Sistem Informasi Peternakan.</p>
                    <p>Anda saat ini mengelola data strategis peternakan melalui NIK: <span class="px-2 py-1 bg-stone-100 rounded text-[#1a120b] font-mono text-sm"><?= session()->get('username') ?? '-' ?></span></p>
                </div>
            </div>
            <div class="w-full md:w-1/3 bg-[#faf7f2] rounded-2xl p-8 border border-stone-100 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-sm mb-4">
                    <i class="fas fa-shield-alt text-3xl text-[#a27b5c]"></i>
                </div>
                <h4 class="text-lg font-bold text-[#1a120b] mb-1">Akses Terjamin</h4>
                <p class="text-xs text-stone-500 uppercase tracking-widest font-bold">Sistem Aman & Terintegrasi</p>
            </div>
        </div>
    </div>
</div>
