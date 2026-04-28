<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide">Daftar Kelompok Ternak</h1>
        <div class="flex gap-3">
            <a href="<?= site_url('perkembangan/kelompok_add') ?>" 
               class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-5 py-2.5 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-xs shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Kelompok
            </a>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div x-data="{ show: true }" x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
         x-transition:leave="transition ease-in duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl flex justify-between items-center shadow-sm">
        <span class="font-medium"><?= session()->getFlashdata('success') ?></span>
        <button @click="show = false" class="text-green-600 hover:text-green-800">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <?php endif; ?>

    <!-- Konten Tabel -->
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
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Kode</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Nama Kelompok</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Kecamatan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Desa</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Ras Ternak</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-[#1a120b] uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php foreach($kelompok_list as $item): ?>
                        <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-stone-900"><?= esc($item->kode_kelompok) ?></td>
                            <td class="px-6 py-4 text-sm font-medium text-stone-800"><?= esc($item->nama_kelompok) ?></td>
                            <td class="px-6 py-4 text-sm text-stone-600"><?= esc($item->kecamatan_nama) ?></td>
                            <td class="px-6 py-4 text-sm text-stone-600"><?= esc($item->desa_nama) ?></td>
                            <td class="px-6 py-4 text-sm font-semibold text-[#a27b5c]"><?= esc($item->ras_ternak) ?></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="<?= site_url('perkembangan/kelompok_edit/'.$item->id) ?>" 
                                   class="inline-flex items-center px-3 py-1.5 bg-stone-100 text-stone-700 hover:bg-[#a27b5c] hover:text-white rounded-lg transition-all duration-300 text-xs font-bold uppercase tracking-tighter">
                                    Edit
                                </a>
                                <a href="<?= site_url('perkembangan/kelompok_delete/'.$item->id) ?>" 
                                   onclick="return confirm('Yakin hapus data?');"
                                   class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-300 text-xs font-bold uppercase tracking-tighter">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($kelompok_list)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-stone-500 italic">Belum ada data kelompok ternak.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
