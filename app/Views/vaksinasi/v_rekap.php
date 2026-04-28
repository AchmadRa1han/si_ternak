<?php
$month_names = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
?>
<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
    </div>

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
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Periode</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Total Dosis</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Kecamatan Terlayani</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Desa Terlayani</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Pemilik Ternak</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php if (empty($rekap)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-stone-500 italic">Belum ada data laporan.</td>
                            </tr>
                        <?php else: 
                            $total_dosis = 0;
                            $total_kecamatan = 0;
                            $total_desa = 0;
                            $total_pemilik = 0;
                            foreach ($rekap as $row): 
                                $total_dosis += $row->total_vaksinasi;
                                $total_kecamatan += $row->jumlah_kecamatan;
                                $total_desa += $row->jumlah_desa;
                                $total_pemilik += $row->jumlah_pemilik;
                        ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#1a120b]">
                                    <?= esc($month_names[(int)$row->bulan] . ' ' . $row->tahun) ?>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-stone-800"><?= number_format($row->total_vaksinasi, 0, ',', '.') ?></td>
                                <td class="px-6 py-4 text-sm text-stone-600"><?= number_format($row->jumlah_kecamatan, 0, ',', '.') ?></td>
                                <td class="px-6 py-4 text-sm text-stone-600"><?= number_format($row->jumlah_desa, 0, ',', '.') ?></td>
                                <td class="px-6 py-4 text-sm font-semibold text-[#a27b5c]"><?= number_format($row->jumlah_pemilik, 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($rekap)): ?>
                    <tfoot class="bg-stone-50/50">
                        <tr class="font-bold text-[#1a120b]">
                            <td class="px-6 py-4 uppercase tracking-widest text-xs">JUMLAH TOTAL</td>
                            <td class="px-6 py-4 text-sm"><?= number_format($total_dosis, 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-sm"><?= number_format($total_kecamatan, 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-sm"><?= number_format($total_desa, 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-sm"><?= number_format($total_pemilik, 0, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
