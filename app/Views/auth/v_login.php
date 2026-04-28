<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI TERNAK | Log in</title>

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
<body class="bg-[#faf7f2] min-h-screen flex items-center justify-center p-6">

<div class="max-w-md w-full" 
     x-data="{ show: false }" 
     x-init="setTimeout(() => show = true, 100)"
     x-show="show"
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-12">
    
    <!-- Logo & Title -->
    <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-[#1a120b] rounded-3xl shadow-xl mb-6 transform rotate-3 hover:rotate-0 transition-transform duration-500">
            <i class="fas fa-paw text-[#a27b5c] text-3xl"></i>
        </div>
        <h1 class="text-4xl font-bold text-[#1a120b] tracking-widest uppercase">SI-TERNAK</h1>
        <p class="text-stone-500 mt-2 font-medium">Sistem Informasi Pengelolaan Ternak</p>
    </div>

    <!-- Login Card -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-stone-100 overflow-hidden">
        <div class="p-10">
            <h2 class="text-xl font-bold text-[#1a120b] mb-2">Selamat Datang</h2>
            <p class="text-stone-400 text-sm mb-8">Silakan masuk menggunakan NIK Petugas Anda.</p>

            <?php if(session()->getFlashdata('error')): ?>
                <div x-data="{ open: true }" x-show="open" 
                     class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-center gap-3 text-red-700 text-sm animate-pulse">
                    <i class="fas fa-exclamation-circle"></i>
                    <span class="font-bold"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('auth/process_login') ?>" method="post" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-[#1a120b] uppercase tracking-widest ml-1">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-stone-400 group-focus-within:text-[#a27b5c] transition-colors">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <input type="text" name="username" 
                               class="w-full pl-11 pr-4 py-4 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 placeholder-stone-300 font-medium" 
                               placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-[#1a120b] uppercase tracking-widest ml-1">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-stone-400 group-focus-within:text-[#a27b5c] transition-colors">
                            <i class="fas fa-lock text-sm"></i>
                        </div>
                        <input type="password" name="password" 
                               class="w-full pl-11 pr-4 py-4 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 placeholder-stone-300 font-medium" 
                               placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full py-4 bg-[#1a120b] hover:bg-[#a27b5c] text-white rounded-2xl font-bold tracking-widest uppercase transition-all duration-500 shadow-lg hover:shadow-xl transform hover:-translate-y-1 active:scale-95">
                    Masuk Sekarang
                </button>
            </form>
        </div>
        
        <div class="px-10 py-6 bg-stone-50 border-t border-stone-100 text-center">
            <p class="text-stone-400 text-xs font-medium">
                &copy; <?= date('Y') ?> Dinas Peternakan. All rights reserved.
            </p>
        </div>
    </div>
    
    <!-- Back to Portal -->
    <div class="text-center mt-8">
        <a href="<?= site_url('/') ?>" class="text-stone-400 hover:text-[#1a120b] text-sm font-bold transition-colors inline-flex items-center gap-2">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke Portal Utama
        </a>
    </div>
</div>

</body>
</html>
