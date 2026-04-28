<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
            <a href="<?= site_url('inseminasi/pkb') ?>" 
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
                $is_edit = isset($pkb);
                $action_url = $is_edit ? site_url('inseminasi/update_pkb/' . $pkb->id_pkb) : site_url('inseminasi/store_pkb');
            ?>
            <form action="<?= $action_url ?>" method="post" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Tanggal Pemeriksaan</label>
                        <input type="date" name="tanggal_pkb" 
                               class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                               value="<?= $is_edit ? $pkb->tanggal_pkb : date('Y-m-d') ?>" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Hewan</label>
                        <select name="id_hewan" 
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                required>
                            <option value="">-- Pilih Hewan --</option>
                            <?php foreach ($hewan as $h): ?>
                                <option value="<?= $h->id_hewan ?>" <?= ($is_edit && $h->id_hewan == $pkb->id_hewan) ? 'selected' : '' ?>>
                                    <?= esc($h->id_hewan) ?> - <?= esc($h->nama_peternak) ?> (<?= esc($h->nama_hewan) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Metode Pemeriksaan</label>
                        <input type="text" name="metode" 
                               class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                               value="<?= $is_edit ? $pkb->metode : '' ?>" placeholder="Contoh: Palpasi Rektal">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Hasil Pemeriksaan</label>
                        <select name="hasil_kebuntingan" 
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                required>
                            <option value="Bunting" <?= ($is_edit && $pkb->hasil_kebuntingan == 'Bunting') ? 'selected' : '' ?>>Bunting</option>
                            <option value="Tidak Bunting" <?= ($is_edit && $pkb->hasil_kebuntingan == 'Tidak Bunting') ? 'selected' : '' ?>>Tidak Bunting</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Umur Kebuntingan (Hari/Bulan)</label>
                        <input type="text" name="umur_kebuntingan" 
                               class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                               value="<?= $is_edit ? esc($pkb->umur_kebuntingan) : '' ?>" placeholder="Contoh: 3 Bulan">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Petugas Pemeriksa</label>
                        <select name="id_petugas" 
                                class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                required>
                            <option value="">-- Pilih Petugas --</option>
                            <?php foreach ($petugas as $p): ?>
                                <option value="<?= $p->id_petugas ?>" <?= ($is_edit && $p->id_petugas == $pkb->id_petugas) ? 'selected' : '' ?>>
                                    <?= esc($p->nama_petugas) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-stone-100">
                    <button type="submit" 
                            class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-8 py-3 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
