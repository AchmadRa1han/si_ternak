<?php
$month_names = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$nama_bulan = isset($selected_bulan) ? $month_names[(int)$selected_bulan] : '';
$nama_tahun = isset($selected_tahun) ? $selected_tahun : '';

// Inisialisasi total kolom
$column_totals = [];
foreach ($all_jenis_pakan as $jp) {
    $column_totals[$jp->nama_jenis] = 0;
}
$grand_total_jumlah = 0;
?>

<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen no-print">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
             <button onclick="window.print();" 
                    class="bg-[#a27b5c] hover:bg-[#1a120b] text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                </svg>
                Cetak Laporan
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden mb-8 p-6"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 100)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500">
        <form action="<?= site_url('pakan/laporan_bulanan') ?>" method="get" class="flex flex-wrap items-end gap-4">
            <div class="space-y-2">
                <label for="periode" class="block text-xs font-bold text-[#1a120b] uppercase tracking-widest">Periode Laporan</label>
                <select name="periode" id="periode" 
                        class="px-4 py-2.5 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-sm text-stone-700 bg-stone-50 min-w-[240px]">
                    <option value="">-- Pilih Periode --</option>
                    <?php foreach ($grouped_periods as $tahun => $bulan_list): ?>
                        <optgroup label="<?= $tahun ?>" class="font-bold text-[#1a120b]">
                            <?php foreach ($bulan_list as $bulan):
                                $period_val = $bulan . '-' . $tahun;
                                $period_text = $month_names[(int)$bulan];
                            ?>
                                <option value="<?= $period_val ?>" <?= ($selected_period == $period_val) ? 'selected' : '' ?>><?= $period_text ?> <?= $tahun ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" 
                    class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-8 py-2.5 rounded-xl font-bold transition-all duration-300 shadow-sm uppercase text-sm tracking-wider">
                Tampilkan
            </button>
        </form>
    </div>

    <?php if (!empty($selected_period)): ?>
    <!-- Report Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 200)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="p-10">
            <!-- Kop Laporan -->
            <div class="text-center mb-10 space-y-1">
                <h5 class="text-stone-500 font-bold uppercase tracking-widest text-sm">Pemerintah Kabupaten Sinjai</h5>
                <h4 class="text-[#1a120b] font-black uppercase tracking-[0.2em] text-xl">Dinas Peternakan dan Kesehatan Hewan</h4>
                <div class="w-24 h-1 bg-[#a27b5c] mx-auto my-4"></div>
                <p class="text-stone-600 font-medium">Laporan Produksi Pakan pada Unit Pengolahan Pakan Silase dan Konsentrat</p>
                <p class="text-[#1a120b] font-bold text-lg">Bulan: <?= $nama_bulan ?> <?= $nama_tahun ?></p>
            </div>

            <div class="overflow-x-auto rounded-xl border border-stone-200">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th rowspan="2" class="px-4 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest border-r border-stone-200">NO</th>
                            <th rowspan="2" class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest border-r border-stone-200">KECAMATAN</th>
                            <th rowspan="2" class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest border-r border-stone-200">NAMA KELOMPOK</th>
                            <th rowspan="2" class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest border-r border-stone-200">ALAMAT</th>
                            <th colspan="<?= count($all_jenis_pakan) ?>" class="px-6 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest border-b border-stone-200">PRODUKSI (KG)</th>
                            <th rowspan="2" class="px-6 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest">JUMLAH (KG)</th>
                        </tr>
                        <tr>
                            <?php foreach ($all_jenis_pakan as $jp): ?>
                                <th class="px-4 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-tighter border-r border-stone-200"><?= esc($jp->nama_jenis) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php if (empty($laporan)): ?>
                            <tr>
                                <td colspan="<?= 5 + count($all_jenis_pakan) ?>" class="px-6 py-10 text-center text-stone-400 italic font-medium">
                                    Data tidak ditemukan untuk periode yang dipilih.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($laporan as $kecamatan => $kelompok_list): ?>
                                <?php $first_row = true; foreach ($kelompok_list as $kelompok => $data): ?>
                                    <tr class="hover:bg-[#fcfaf7] transition-colors">
                                        <?php if ($first_row): ?>
                                            <td rowspan="<?= count($kelompok_list) ?>" class="px-4 py-4 text-center text-sm font-bold text-[#1a120b] border-r border-stone-100 bg-stone-50/30"><?= $no++ ?></td>
                                            <td rowspan="<?= count($kelompok_list) ?>" class="px-6 py-4 text-sm font-bold text-[#1a120b] border-r border-stone-100 bg-stone-50/30 uppercase tracking-tight"><?= esc($kecamatan) ?></td>
                                        <?php endif; ?>
                                        <td class="px-6 py-4 text-sm font-medium text-stone-800 border-r border-stone-50"><?= esc($kelompok) ?></td>
                                        <td class="px-6 py-4 text-sm text-stone-500 border-r border-stone-50 italic"><?= esc($data['alamat']) ?></td>
                                        <?php 
                                            $row_total = 0;
                                            foreach ($all_jenis_pakan as $jp) {
                                                $jumlah = isset($data[$jp->nama_jenis]) ? $data[$jp->nama_jenis] : 0;
                                                echo '<td class="px-4 py-4 text-center text-sm text-stone-600 border-r border-stone-50">' . number_format($jumlah, 0, ',', '.') . '</td>';
                                                $row_total += $jumlah;
                                                $column_totals[$jp->nama_jenis] += $jumlah;
                                            }
                                            $grand_total_jumlah += $row_total;
                                        ?>
                                        <td class="px-6 py-4 text-center text-sm font-black text-[#1a120b] bg-[#faf7f2]/50"><?= number_format($row_total, 0, ',', '.') ?></td>
                                    </tr>
                                <?php $first_row = false; endforeach; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="bg-stone-50/50">
                        <tr class="font-black text-[#1a120b]">
                            <td colspan="4" class="px-6 py-6 text-right text-xs uppercase tracking-[0.2em]">TOTAL KESELURUHAN (KG)</td>
                            <?php foreach ($all_jenis_pakan as $jp): ?>
                                <td class="px-4 py-6 text-center text-sm border-t-2 border-[#a27b5c]"><?= number_format($column_totals[$jp->nama_jenis], 0, ',', '.') ?></td>
                            <?php endforeach; ?>
                            <td class="px-6 py-6 text-center text-lg border-t-2 border-[#a27b5c] bg-[#1a120b] text-white"><?= number_format($grand_total_jumlah, 0, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Tanda Tangan (Hanya Muncul Saat Cetak) -->
            <div class="mt-16 hidden print-block grid grid-cols-2 gap-20">
                <div class="text-center">
                    <p class="text-sm font-bold text-stone-800 mb-20">Mengetahui,<br>Kepala Dinas</p>
                    <p class="font-bold border-b border-[#1a120b] inline-block px-4 text-[#1a120b]">NAMA KEPALA DINAS, M.Si</p>
                    <p class="text-xs text-stone-500 mt-1 uppercase">NIP. 19XXXXXXXXXXXXXXXX</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-bold text-stone-800 mb-20">Sinjai, <?= date('d') ?> <?= $month_names[(int)date('m')] ?> <?= date('Y') ?><br>Petugas Administrasi</p>
                    <p class="font-bold border-b border-[#1a120b] inline-block px-4 text-[#1a120b]">NAMA PETUGAS</p>
                    <p class="text-xs text-stone-500 mt-1 uppercase">NIP. 19XXXXXXXXXXXXXXXX</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
    @media print {
        body { background-color: white !important; }
        .no-print { display: none !important; }
        .print-block { display: grid !important; }
        .container { max-width: 100% !important; padding: 0 !important; margin: 0 !important; }
        .bg-white { box-shadow: none !important; border: none !important; }
        table { font-size: 10pt !important; border-collapse: collapse !important; }
        th, td { border: 1px solid #1a120b !important; }
        .bg-stone-50 { background-color: #f5f5f4 !important; }
        .text-white { color: black !important; }
        .bg-[#1a120b] { background-color: transparent !important; }
        tfoot td { border-top: 2px solid #1a120b !important; }
    }
</style>
