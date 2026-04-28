<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide">Laporan Perkembangan</h1>
        <div class="flex gap-3">
            <a href="<?= site_url('perkembangan/laporan_add') ?>" 
               class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-5 py-2.5 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-xs shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Input Laporan
            </a>
        </div>
    </div>

    <!-- Filter Periode -->
    <div class="mb-8 bg-white p-6 rounded-2xl shadow-sm border border-stone-100"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 100)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform -translate-y-2">
        <form action="<?= site_url('perkembangan/laporan') ?>" method="get" class="flex flex-col md:flex-row items-end gap-4">
            <div class="flex-1">
                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Pilih Periode Laporan</label>
                <select name="periode" onchange="this.form.submit()"
                        class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300">
                    <option value="">-- Semua Periode --</option>
                    <?php 
                    $nama_bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                    foreach($periods as $p): 
                        $period_value = $p->tahun . '-' . $p->bulan;
                        $period_text = $nama_bulan[(int)$p->bulan] . ' ' . $p->tahun;
                        $is_selected = ($period_value == $selected_period) ? 'selected' : '';
                    ?>
                        <option value="<?= esc($period_value) ?>" <?= $is_selected ?>>
                            <?= esc($period_text) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="hidden md:block">
                <button type="submit" class="bg-stone-100 text-stone-700 px-6 py-3 rounded-xl font-bold hover:bg-stone-200 transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div x-data="{ show: true }" x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
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
         x-init="setTimeout(() => show = true, 200)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="p-0">
            <?php if (!empty($laporan_list)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-stone-200">
                        <thead class="bg-stone-50">
                            <tr>
                                <th rowspan="2" class="px-6 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest border-r border-stone-200">No.</th>
                                <th rowspan="2" class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest border-r border-stone-200">Nama Kelompok</th>
                                <th colspan="5" class="px-6 py-3 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest border-b border-stone-200">Perkembangan Populasi</th>
                                <th rowspan="2" class="px-6 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest">Aksi</th>
                            </tr>
                            <tr class="bg-stone-50/50">
                                <th class="px-4 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-r border-stone-100">Awal</th>
                                <th class="px-4 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-r border-stone-100">Lahir</th>
                                <th class="px-4 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-r border-stone-100">Mati</th>
                                <th class="px-4 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-r border-stone-100">Jual</th>
                                <th class="px-4 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-r border-stone-200">Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-stone-100">
                            <?php $no = 1; foreach($laporan_list as $item): ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-stone-500"><?= $no++ ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-stone-800"><?= esc($item->nama_kelompok) ?></td>
                                <td class="px-4 py-4 text-center text-sm font-bold text-stone-900 bg-stone-50/30">
                                    <?= ($item->populasi_awal_dewasa_jt + $item->populasi_awal_dewasa_bt + $item->populasi_awal_anak_jt + $item->populasi_awal_anak_bt) ?>
                                </td>
                                <td class="px-4 py-4 text-center text-sm font-medium text-green-600">
                                    <?= ($item->lahir_jt + $item->lahir_bt) ?>
                                </td>
                                <td class="px-4 py-4 text-center text-sm font-medium text-red-600">
                                    <?= ($item->mati_dewasa_jt + $item->mati_dewasa_bt + $item->mati_anak_jt + $item->mati_anak_bt) ?>
                                </td>
                                <td class="px-4 py-4 text-center text-sm font-medium text-orange-600">
                                    <?= ($item->jual_jt + $item->jual_bt) ?>
                                </td>
                                <td class="px-4 py-4 text-center text-sm font-bold text-[#1a120b] bg-[#faf7f2]">
                                    <?php 
                                        $populasi_awal = $item->populasi_awal_dewasa_jt + $item->populasi_awal_dewasa_bt + $item->populasi_awal_anak_jt + $item->populasi_awal_anak_bt;
                                        $kelahiran = $item->lahir_jt + $item->lahir_bt;
                                        $kematian = $item->mati_dewasa_jt + $item->mati_dewasa_bt + $item->mati_anak_jt + $item->mati_anak_bt;
                                        $penjualan = $item->jual_jt + $item->jual_bt;
                                        echo ($populasi_awal + $kelahiran - $kematian - $penjualan);
                                    ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="<?= site_url('perkembangan/laporan_delete/'.$item->id) ?>" 
                                       onclick="return confirm('Yakin hapus data?');"
                                       class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-300 text-xs font-bold uppercase tracking-tighter">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="px-6 py-20 text-center">
                    <div class="mb-4 inline-flex items-center justify-center w-16 h-16 bg-stone-100 rounded-full">
                        <svg class="w-8 h-8 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-stone-500 font-medium">Silakan pilih periode laporan untuk menampilkan data.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
