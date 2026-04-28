<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
            <a href="<?= site_url('inseminasi/kelahiran') ?>" 
               class="bg-stone-200 hover:bg-stone-300 text-stone-700 px-4 py-2 rounded-xl transition-colors duration-300 font-medium">
                Kembali
            </a>
        </div>
    </div>

    <!-- Konten Form -->
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="p-8">
            <?php 
                $is_edit = isset($kelahiran);
                $action_url = $is_edit ? site_url('inseminasi/update_kelahiran/' . $kelahiran->id_laporan) : site_url('inseminasi/store_kelahiran');
            ?>
            <form action="<?= $action_url ?>" method="post" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Tanggal Laporan</label>
                        <input type="date" name="tgl_laporan" 
                               class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                               value="<?= $is_edit ? $kelahiran->tgl_laporan : date('Y-m-d') ?>" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Tanggal Kelahiran</label>
                        <input type="date" name="tgl_kelahiran" 
                               class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                               value="<?= $is_edit ? $kelahiran->tgl_kelahiran : '' ?>" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Induk</label>
                        <select name="id_hewan" 
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                required>
                            <option value="">-- Pilih Induk --</option>
                            <?php foreach ($hewan as $h): ?>
                                <option value="<?= $h->id_hewan ?>" <?= ($is_edit && $h->id_hewan == $kelahiran->id_hewan) ? 'selected' : '' ?>>
                                    <?= esc($h->id_hewan) ?> - <?= esc($h->nama_peternak) ?> (<?= esc($h->nama_hewan) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Bangsa Anak</label>
                        <input type="text" name="bangsa" 
                               class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                               value="<?= $is_edit ? $kelahiran->bangsa : '' ?>" placeholder="Contoh: Limousin">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Jenis Kelamin Anak</label>
                        <select name="jenis_kelamin" 
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                required>
                            <option value="jantan" <?= ($is_edit && strtolower($kelahiran->jenis_kelamin) == 'jantan') ? 'selected' : '' ?>>Jantan</option>
                            <option value="betina" <?= ($is_edit && strtolower($kelahiran->jenis_kelamin) == 'betina') ? 'selected' : '' ?>>Betina</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Status Kelahiran</label>
                        <select name="status_kelahiran" 
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                required>
                            <option value="hidup" <?= ($is_edit && strtolower($kelahiran->status_kelahiran) == 'hidup') ? 'selected' : '' ?>>Hidup</option>
                            <option value="mati" <?= ($is_edit && strtolower($kelahiran->status_kelahiran) == 'mati') ? 'selected' : '' ?>>Mati</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Metode Kawin</label>
                        <select name="metode_kawin" 
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                required>
                            <option value="IB" <?= ($is_edit && $kelahiran->metode_kawin == 'IB') ? 'selected' : '' ?>>Inseminasi Buatan (IB)</option>
                            <option value="Kawin Alam" <?= ($is_edit && $kelahiran->metode_kawin == 'Kawin Alam') ? 'selected' : '' ?>>Kawin Alam</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Petugas Pelapor</label>
                        <select name="id_petugas" 
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                required>
                            <option value="">-- Pilih Petugas --</option>
                            <?php foreach ($petugas as $p): ?>
                                <option value="<?= $p->id_petugas ?>" <?= ($is_edit && $p->id_petugas == $kelahiran->id_petugas) ? 'selected' : '' ?>>
                                    <?= esc($p->nama_petugas) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-stone-100">
                    <button type="submit" 
                            class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-8 py-3 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
