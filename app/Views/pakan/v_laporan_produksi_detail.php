<div class="space-y-8" 
     x-data="{ show: false }" 
     x-init="setTimeout(() => show = true, 150)"
     x-show="show"
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="opacity-0 transform translate-y-8">
    
    <!-- Info Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <div class="bg-stone-50/50 px-8 py-4 border-b border-stone-100">
            <h2 class="text-lg font-bold text-[#1a120b] tracking-wide uppercase flex items-center gap-2">
                <i class="fas fa-file-alt text-[#a27b5c]"></i>
                ID Laporan: <?= esc($laporan->id_laporan) ?>
            </h2>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-stone-100 flex items-center justify-center text-[#a27b5c]">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-stone-500 uppercase tracking-widest">Nama Kelompok</p>
                            <p class="text-lg font-semibold text-stone-800"><?= esc($laporan->nama_kelompok) ?></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-stone-100 flex items-center justify-center text-[#a27b5c]">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-stone-500 uppercase tracking-widest">Periode</p>
                            <p class="text-lg font-semibold text-stone-800"><?= esc($laporan->bulan) ?> <?= esc($laporan->tahun) ?></p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-stone-100 flex items-center justify-center text-[#a27b5c]">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-stone-500 uppercase tracking-widest">Status</p>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 uppercase tracking-wider">
                                <?= esc($laporan->status) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-stone-100 my-8">

            <h3 class="text-xl font-bold text-[#1a120b] mb-6 tracking-wide">Detail Produksi</h3>
            
            <div class="overflow-x-auto rounded-xl border border-stone-200">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Jenis Pakan</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-[#1a120b] uppercase tracking-widest">Jumlah Produksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php foreach ($detail as $row) : ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-800"><?= esc($row->nama_jenis) ?></td>
                                <td class="px-6 py-4 text-right text-sm font-bold text-stone-900"><?= esc($row->jumlah_produksi) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-10 flex gap-4">
                <a href="<?= site_url('pakan/laporan_produksi') ?>" 
                   class="bg-stone-200 hover:bg-stone-300 text-stone-700 px-6 py-3 rounded-xl font-bold transition-all flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
