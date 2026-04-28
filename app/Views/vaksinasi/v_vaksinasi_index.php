<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
            <a href="<?= site_url('vaksinasi/upload') ?>" 
               class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-6 py-3 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-xs shadow-md flex items-center gap-2">
                <i class="fas fa-upload"></i> Upload Laporan
            </a>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if(session()->getFlashdata('success')) : ?>
        <div x-data="{ show: true }" x-show="show" class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium"><?= session()->getFlashdata('success') ?></span>
            </div>
            <button @click="show = false" class="text-green-600 hover:text-green-800">×</button>
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
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Eartag / ID</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Petugas</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Pemilik</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Wilayah</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Vaksin</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php if (empty($vaksinasi)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-stone-500 italic">Belum ada data vaksinasi. Silakan upload laporan terlebih dahulu.</td>
                            </tr>
                        <?php else: 
                            $no = 1 + (20 * (($pager->getCurrentPage('vaksinasi') ?? 1) - 1));
                            foreach ($vaksinasi as $row): 
                        ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500"><?= $no++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-[#1a120b]"><?= esc($row->eartag ?: $row->identifikasihewan) ?></div>
                                    <div class="text-[10px] text-stone-400 uppercase tracking-tighter"><?= esc($row->hewan) ?> - <?= esc($row->rumpun) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-stone-800"><?= esc($row->namapetugas) ?></div>
                                    <div class="text-xs text-stone-500"><?= esc($row->nomorpetugas) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-stone-800"><?= esc($row->namapemilik) ?></div>
                                    <div class="text-xs text-stone-500"><?= esc($row->nikpemilik) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-stone-600"><?= esc($row->kecamatan) ?></div>
                                    <div class="text-xs text-stone-400"><?= esc($row->desa) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                    <?= date('d/m/Y', strtotime($row->tanggal_vaksinasi)) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-[#faf7f2] text-[#a27b5c] border border-[#a27b5c]/20 rounded-full">
                                        <?= esc($row->penyakit) ?>
                                    </span>
                                    <div class="mt-1 text-[10px] text-stone-400 italic">Dosis ke-<?= esc($row->urutan_vaksinasi) ?></div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        <?= $pager->links('vaksinasi', 'default_full') ?>
    </div>
</div>
