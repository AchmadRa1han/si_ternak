<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
            <a href="<?= site_url('perkembangan/laporan') ?>" 
               class="bg-stone-200 hover:bg-stone-300 text-stone-700 px-4 py-2 rounded-xl transition-colors duration-300 font-medium">
                Kembali
            </a>
        </div>
    </div>

    <!-- Konten Form -->
    <div class="max-w-6xl mx-auto"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        
        <form action="<?= site_url('perkembangan/laporan_add') ?>" method="post" class="space-y-8">
            <!-- Card Utama: Periode -->
            <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
                <h3 class="text-lg font-bold text-[#1a120b] mb-6 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-8 h-8 bg-[#1a120b] text-white rounded-lg flex items-center justify-center text-sm">01</span>
                    Periode Laporan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Kelompok Ternak</label>
                        <select name="kelompok_id" required
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300">
                            <option value="">-- Pilih Kelompok --</option>
                            <?php foreach($kelompok_list as $k): ?>
                                <option value="<?= $k->id ?>"><?= esc($k->nama_kelompok) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Bulan</label>
                        <select name="bulan" required
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300">
                            <?php
                            $bulan_sekarang = date('n');
                            $nama_bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                            for ($i = 1; $i <= 12; $i++) {
                                $selected = ($i == $bulan_sekarang) ? 'selected' : '';
                                echo "<option value='$i' $selected>" . $nama_bulan[$i] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Tahun</label>
                        <input type="number" name="tahun" required
                               class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                               value="<?= date('Y') ?>">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card A: Populasi Awal -->
                <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
                    <h3 class="text-lg font-bold text-[#1a120b] mb-6 uppercase tracking-wider flex items-center gap-2">
                        <span class="w-8 h-8 bg-[#a27b5c] text-white rounded-lg flex items-center justify-center text-sm">A</span>
                        Populasi Awal Bulan
                    </h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-stone-500 uppercase mb-1">Dewasa Jantan</label>
                                <input type="number" name="populasi_awal_dewasa_jt" class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-[#a27b5c]" value="0">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-stone-500 uppercase mb-1">Dewasa Betina</label>
                                <input type="number" name="populasi_awal_dewasa_bt" class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-[#a27b5c]" value="0">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-stone-500 uppercase mb-1">Anak Jantan</label>
                                <input type="number" name="populasi_awal_anak_jt" class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-[#a27b5c]" value="0">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-stone-500 uppercase mb-1">Anak Betina</label>
                                <input type="number" name="populasi_awal_anak_bt" class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-[#a27b5c]" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card B: Perkembangan -->
                <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
                    <h3 class="text-lg font-bold text-[#1a120b] mb-6 uppercase tracking-wider flex items-center gap-2">
                        <span class="w-8 h-8 bg-[#a27b5c] text-white rounded-lg flex items-center justify-center text-sm">B</span>
                        Perkembangan
                    </h3>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                        <div class="col-span-2 text-sm font-bold text-stone-400 uppercase border-b border-stone-100 pb-1">Kelahiran</div>
                        <div>
                            <label class="block text-xs font-bold text-stone-500 mb-1">Jantan</label>
                            <input type="number" name="lahir_jt" class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-green-500" value="0">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-500 mb-1">Betina</label>
                            <input type="number" name="lahir_bt" class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-green-500" value="0">
                        </div>

                        <div class="col-span-2 text-sm font-bold text-stone-400 uppercase border-b border-stone-100 pb-1 mt-2">Kematian</div>
                        <div>
                            <label class="block text-xs font-bold text-stone-500 mb-1">Dewasa</label>
                            <div class="flex gap-2">
                                <input type="number" name="mati_dewasa_jt" class="w-1/2 px-4 py-2 border border-stone-200 rounded-lg" placeholder="Jt" value="0">
                                <input type="number" name="mati_dewasa_bt" class="w-1/2 px-4 py-2 border border-stone-200 rounded-lg" placeholder="Bt" value="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-500 mb-1">Anak</label>
                            <div class="flex gap-2">
                                <input type="number" name="mati_anak_jt" class="w-1/2 px-4 py-2 border border-stone-200 rounded-lg" placeholder="Jt" value="0">
                                <input type="number" name="mati_anak_bt" class="w-1/2 px-4 py-2 border border-stone-200 rounded-lg" placeholder="Bt" value="0">
                            </div>
                        </div>

                        <div class="col-span-2 text-sm font-bold text-stone-400 uppercase border-b border-stone-100 pb-1 mt-2">Penjualan</div>
                        <div>
                            <label class="block text-xs font-bold text-stone-500 mb-1">Jantan</label>
                            <input type="number" name="jual_jt" class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-orange-500" value="0">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-500 mb-1">Betina</label>
                            <input type="number" name="jual_bt" class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-orange-500" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Keterangan -->
            <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-4">Keterangan Tambahan</label>
                <textarea name="keterangan" rows="4" 
                          class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                          placeholder="Tambahkan catatan jika ada..."></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="submit" 
                        class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-10 py-4 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Simpan Laporan Perkembangan
                </button>
            </div>
        </form>
    </div>
</div>
