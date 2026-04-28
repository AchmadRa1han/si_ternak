<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide">Manajemen Pengguna</h1>
            <p class="text-stone-500 text-sm mt-1">Daftar akun yang terdaftar dalam sistem</p>
        </div>
        <div class="flex gap-3">
            <a href="<?= site_url('user/add') ?>" class="inline-flex items-center px-5 py-2.5 bg-[#1a120b] hover:bg-[#a27b5c] text-white text-sm font-bold rounded-xl transition-all duration-300 shadow-sm">
                <i class="fas fa-plus mr-2 text-xs"></i> Tambah Pengguna
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    <?php if(session()->getFlashdata('success')): ?>
        <div x-data="{ open: true }" x-show="open" 
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="mb-6 flex items-center p-4 text-stone-800 rounded-2xl bg-white border border-stone-200 shadow-sm" role="alert">
            <div class="w-10 h-10 bg-[#faf7f2] rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-check text-[#a27b5c]"></i>
            </div>
            <div class="text-sm font-bold text-[#1a120b]">
                <?= session()->getFlashdata('success') ?>
            </div>
            <button @click="open = false" type="button" class="ml-auto text-stone-400 hover:text-[#1a120b] transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <!-- Konten Table dengan Reveal Animation -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        
        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-6 py-5 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">No</th>
                            <th class="px-6 py-5 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Username</th>
                            <th class="px-6 py-5 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Nama Lengkap</th>
                            <th class="px-6 py-5 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Role</th>
                            <th class="px-6 py-5 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Status</th>
                            <th class="px-6 py-5 text-right text-xs font-bold text-[#1a120b] uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php $no = 1; foreach($users as $user): ?>
                        <tr class="hover:bg-[#fcfaf7] transition-colors duration-300 group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500"><?= $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-[#1a120b]"><?= esc($user->username) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-stone-800"><?= esc($user->nama_lengkap) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 bg-stone-100 text-stone-600 rounded-lg text-xs font-bold uppercase tracking-wider">
                                    <?= ucfirst(esc($user->role)) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($user->is_active == 1): ?>
                                    <span class="flex items-center text-xs font-bold text-green-600">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="flex items-center text-xs font-bold text-red-600">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span> Tidak Aktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="<?= site_url('user/edit/'.$user->id) ?>" 
                                       class="inline-flex items-center px-3 py-1.5 bg-stone-50 text-[#1a120b] hover:bg-[#a27b5c] hover:text-white rounded-xl transition-all duration-300">
                                        <i class="fas fa-edit mr-1.5 text-[10px]"></i> Edit
                                    </a>
                                    <a href="<?= site_url('user/delete/'.$user->id) ?>" 
                                       class="inline-flex items-center px-3 py-1.5 bg-stone-50 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all duration-300"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash mr-1.5 text-[10px]"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-stone-400 italic">
                                Belum ada data pengguna yang terdaftar.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
