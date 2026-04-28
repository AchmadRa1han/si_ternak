<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
            <a href="<?= site_url('master/peternak_add') ?>" 
               class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Data
            </a>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')) : ?>
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm animate-fade-in"
             x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium text-sm"><?= session()->getFlashdata('success') ?></span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Konten Card dengan Staggered Animation -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="p-8">
            <div class="overflow-x-auto rounded-xl border border-stone-200">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">ID Peternak</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Nama Peternak</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Alamat</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">No HP</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest">Hewan Aktif</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-[#1a120b] uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php foreach($peternak_list as $peternak): ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#1a120b]"><?= esc($peternak->id_peternak) ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-stone-800"><?= esc($peternak->nama_peternak) ?></td>
                                <td class="px-6 py-4 text-sm text-stone-600">
                                    <div class="max-w-xs truncate">
                                        <?= esc($peternak->alamat ? : '-') ?>, <?= esc($peternak->desa) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-stone-600 font-mono"><?= esc($peternak->no_hp ? : '-') ?></td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center px-3 py-1 text-sm font-bold leading-none text-white bg-[#a27b5c] rounded-full shadow-sm">
                                        <?= esc($peternak->jumlah_hewan) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="<?= site_url('master/peternak_edit/' . $peternak->id_peternak) ?>" 
                                       class="text-[#a27b5c] hover:text-[#1a120b] font-bold text-sm transition-colors uppercase tracking-tight">EDIT</a>
                                    <a href="<?= site_url('master/peternak_delete/' . $peternak->id_peternak) ?>" 
                                       class="text-red-400 hover:text-red-700 font-bold text-sm transition-colors uppercase tracking-tight"
                                       onclick="return confirm('Yakin ingin menghapus data ini?')">HAPUS</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
