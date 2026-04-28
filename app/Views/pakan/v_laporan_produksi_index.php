<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
            <a href="<?= site_url('pakan/laporan_produksi_create') ?>" 
               class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Laporan
            </a>
        </div>
    </div>

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
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">ID Laporan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Nama Kelompok</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest text-center">Bulan / Tahun</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest">Total Produksi</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest text-center">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-[#1a120b] uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php foreach($laporan as $row): ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#1a120b]"><?= esc($row->id_laporan) ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-stone-800"><?= esc($row->nama_kelompok) ?></td>
                                <td class="px-6 py-4 text-center text-sm text-stone-600">
                                    <span class="font-bold"><?= esc($row->bulan) ?></span> / <?= esc($row->tahun) ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm font-bold text-[#1a120b]"><?= number_format($row->total_produksi, 0, ',', '.') ?></span>
                                    <span class="text-[10px] text-stone-400 font-bold uppercase ml-1">KG</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 text-[10px] font-bold rounded-full bg-blue-50 text-blue-600 uppercase tracking-tighter">
                                        <?= esc($row->status) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="<?= site_url('pakan/laporan_produksi_detail/' . $row->id_laporan) ?>" 
                                       class="text-stone-400 hover:text-[#1a120b] font-bold text-sm transition-colors uppercase tracking-tight">DETAIL</a>
                                    <a href="<?= site_url('pakan/laporan_produksi_edit/' . $row->id_laporan) ?>" 
                                       class="text-[#a27b5c] hover:text-[#1a120b] font-bold text-sm transition-colors uppercase tracking-tight">EDIT</a>
                                    <a href="<?= site_url('pakan/laporan_produksi_delete/' . $row->id_laporan) ?>" 
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
