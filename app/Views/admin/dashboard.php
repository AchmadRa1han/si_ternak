<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide">Admin Dashboard</h1>
        <div class="text-sm font-medium text-stone-500 bg-white px-4 py-2 rounded-full shadow-sm border border-stone-100">
            <?= date('l, d F Y') ?>
        </div>
    </div>

    <!-- Stats Grid with Staggered Animation -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Stat Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition-shadow duration-300"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)"
             x-show="show" x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-stone-400 uppercase tracking-widest mb-1">Total Users</p>
                    <h3 class="text-2xl font-bold text-[#1a120b]">1,250</h3>
                </div>
                <div class="w-12 h-12 bg-stone-50 rounded-xl flex items-center justify-center text-[#a27b5c]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13.481 4.044a4 4 0 014.54 4.558" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium text-green-600">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                </svg>
                <span>+12% dari bulan lalu</span>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition-shadow duration-300"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
             x-show="show" x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-stone-400 uppercase tracking-widest mb-1">Total Posts</p>
                    <h3 class="text-2xl font-bold text-[#1a120b]">5,430</h3>
                </div>
                <div class="w-12 h-12 bg-stone-50 rounded-xl flex items-center justify-center text-[#a27b5c]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium text-green-600">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                </svg>
                <span>+5.4% dari bulan lalu</span>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition-shadow duration-300"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)"
             x-show="show" x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-stone-400 uppercase tracking-widest mb-1">Categories</p>
                    <h3 class="text-2xl font-bold text-[#1a120b]">24</h3>
                </div>
                <div class="w-12 h-12 bg-stone-50 rounded-xl flex items-center justify-center text-[#a27b5c]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium text-stone-400">
                <span>Stabil dari bulan lalu</span>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition-shadow duration-300"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 400)"
             x-show="show" x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-stone-400 uppercase tracking-widest mb-1">Pending Requests</p>
                    <h3 class="text-2xl font-bold text-[#1a120b]">18</h3>
                </div>
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-orange-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium text-orange-600">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 13a1 1 0 110 2H5a1 1 0 01-1-1V7a1 1 0 112 0v5h6z" clip-rule="evenodd" />
                </svg>
                <span>Membutuhkan perhatian</span>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="md:flex">
            <div class="md:w-2/3 p-10">
                <h2 class="text-2xl font-bold text-[#1a120b] mb-4">Selamat Datang, Admin!</h2>
                <p class="text-stone-600 leading-relaxed mb-6">
                    Ini adalah Panel Administrasi Sistem Informasi Ternak (SI-TERNAK). Anda dapat mengelola seluruh data operasional, mulai dari inseminasi, perkembangan kelompok, hingga rekapitulasi vaksinasi dari satu tempat.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?= site_url('inseminasi/pkb') ?>" class="bg-[#1a120b] text-white px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#a27b5c] transition-all duration-300">
                        Cek Laporan PKB
                    </a>
                    <a href="<?= site_url('perkembangan/laporan') ?>" class="bg-stone-100 text-[#1a120b] px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-stone-200 transition-all duration-300">
                        Pantau Perkembangan
                    </a>
                </div>
            </div>
            <div class="hidden md:block md:w-1/3 bg-[#faf7f2] border-l border-stone-100 p-10 flex items-center justify-center">
                <div class="text-center">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-12 h-12 text-[#a27b5c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-[#1a120b] uppercase tracking-tighter">Sistem Terverifikasi</p>
                </div>
            </div>
        </div>
    </div>
</div>
