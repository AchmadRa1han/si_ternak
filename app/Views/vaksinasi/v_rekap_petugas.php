<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
    </div>

    <!-- Filter Periode -->
    <div class="mb-8 bg-white p-6 rounded-2xl shadow-sm border border-stone-100"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 100)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform -translate-y-2">
        <form action="<?= site_url('vaksinasi/rekap_petugas') ?>" method="get" class="flex flex-col md:flex-row items-end gap-4">
            <div class="flex-1">
                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Pilih Periode Laporan</label>
                <select name="periode" id="periode"
                        class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300">
                    <option value="">Semua Periode</option>
                    <?php 
                        $month_names = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        foreach ($grouped_periods as $tahun => $bulan_list):
                    ?>
                        <optgroup label="<?= esc($tahun) ?>" class="font-bold text-[#1a120b]">
                            <?php foreach ($bulan_list as $bulan):
                                $period_val = $bulan . '-' . $tahun;
                                $period_text = $month_names[(int)$bulan];
                            ?>
                                <option value="<?= esc($period_val) ?>" <?= ($selected_period == $period_val) ? 'selected' : '' ?>>
                                    <?= esc($period_text) ?>
                                </option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-8 py-3 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-sm shadow-md">
                    Filter Data
                </button>
            </div>
        </form>
    </div>

    <!-- Konten Tabel -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 200)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Nama Petugas</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Total Dosis</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Kecamatan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Desa</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Vaksinasi Pertama</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Vaksinasi Terakhir</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php if (empty($rekap)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-stone-500 italic">Belum ada data laporan.</td>
                            </tr>
                        <?php else: 
                            $total_dosis = 0;
                            foreach ($rekap as $row): 
                            $total_dosis += $row->total_vaksinasi;
                        ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#1a120b]"><?= esc($row->namapetugas) ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-stone-800"><?= number_format($row->total_vaksinasi, 0, ',', '.') ?></td>
                                <td class="px-6 py-4 text-sm text-stone-600"><?= number_format($row->jumlah_kecamatan, 0, ',', '.') ?></td>
                                <td class="px-6 py-4 text-sm text-stone-600"><?= number_format($row->jumlah_desa, 0, ',', '.') ?></td>
                                <td class="px-6 py-4 text-sm text-stone-500"><?= date('d/m/Y', strtotime($row->vaksinasi_pertama)) ?></td>
                                <td class="px-6 py-4 text-sm text-stone-500"><?= date('d/m/Y', strtotime($row->vaksinasi_terakhir)) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($rekap)): ?>
                    <tfoot class="bg-stone-50/50">
                        <tr class="font-bold text-[#1a120b]">
                            <td class="px-6 py-4 uppercase tracking-widest text-xs">JUMLAH TOTAL</td>
                            <td class="px-6 py-4 text-sm"><?= number_format($total_dosis, 0, ',', '.') ?></td>
                            <td colspan="4"></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
