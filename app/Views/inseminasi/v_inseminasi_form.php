<!-- application/views/inseminasi/v_inseminasi_form.php -->

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 100)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        
        <div class="p-8 border-b border-stone-100 bg-stone-50/50">
            <h3 class="text-xl font-bold text-[#1a120b] tracking-wide"><?= $is_edit = isset($ib) ? 'Edit Data Inseminasi' : 'Tambah Data Inseminasi' ?></h3>
            <p class="text-stone-500 text-sm mt-1 font-medium">Lengkapi informasi detail inseminasi buatan di bawah ini.</p>
        </div>

        <?php 
            $is_edit = isset($ib);
            $action_url = $is_edit ? site_url('inseminasi/update_ib/' . $ib->id_ib) : site_url('inseminasi/store_ib');
        ?>
        
        <form action="<?= $action_url ?>" method="post" class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Hewan Ternak -->
                <div class="space-y-2">
                    <label for="id_hewan" class="block text-sm font-bold text-stone-700 tracking-wide uppercase text-xs">Hewan Ternak (Betina)</label>
                    <select name="id_hewan" id="id_hewan" class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium" required>
                        <option value="">-- Pilih Hewan --</option>
                        <?php foreach ($hewan as $h): ?>
                            <option value="<?= $h->id_hewan ?>" <?= ($is_edit && $h->id_hewan == $ib->id_hewan) ? 'selected' : '' ?>><?= $h->id_hewan ?> - <?= esc($h->nama_peternak) ?> (<?= esc($h->nama_hewan) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tanggal IB -->
                <div class="space-y-2">
                    <label for="tanggal_ib" class="block text-sm font-bold text-stone-700 tracking-wide uppercase text-xs">Tanggal Inseminasi</label>
                    <input type="date" name="tanggal_ib" id="tanggal_ib" 
                           class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium"
                           value="<?= $is_edit ? $ib->tanggal_ib : date('Y-m-d') ?>" required>
                </div>

                <!-- Petugas IB -->
                <div class="space-y-2">
                    <label for="id_petugas" class="block text-sm font-bold text-stone-700 tracking-wide uppercase text-xs">Petugas Inseminator</label>
                    <select name="id_petugas" id="id_petugas" class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium" required>
                        <option value="">-- Pilih Petugas --</option>
                        <?php foreach ($petugas as $p): ?>
                            <option value="<?= $p->id_petugas ?>" <?= ($is_edit && $p->id_petugas == $ib->id_petugas) ? 'selected' : '' ?>><?= esc($p->nama_petugas) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Inseminasi Ke -->
                <div class="space-y-2">
                    <label for="ib_ke" class="block text-sm font-bold text-stone-700 tracking-wide uppercase text-xs">Inseminasi Ke-</label>
                    <input type="number" name="ib_ke" id="ib_ke" 
                           class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium"
                           placeholder="Misal: 1" value="<?= $is_edit ? $ib->ib_ke : '' ?>" required>
                </div>

                <!-- ID Pejantan -->
                <div class="space-y-2">
                    <label for="id_pejantan" class="block text-sm font-bold text-stone-700 tracking-wide uppercase text-xs">ID Pejantan</label>
                    <input type="text" name="id_pejantan" id="id_pejantan" 
                           class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium"
                           placeholder="Masukkan ID Pejantan" value="<?= $is_edit ? esc($ib->id_pejantan) : '' ?>">
                </div>

                <!-- Bangsa Pejantan -->
                <div class="space-y-2">
                    <label for="bangsa_pejantan" class="block text-sm font-bold text-stone-700 tracking-wide uppercase text-xs">Bangsa Pejantan</label>
                    <input type="text" name="bangsa_pejantan" id="bangsa_pejantan" 
                           class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium"
                           placeholder="Contoh: Limousin" value="<?= $is_edit ? esc($ib->bangsa_pejantan) : '' ?>">
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="status" class="block text-sm font-bold text-stone-700 tracking-wide uppercase text-xs">Status Awal</label>
                    <select name="status" id="status" class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium">
                        <option value="menunggu" <?= ($is_edit && $ib->status == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                        <option value="berhasil" <?= ($is_edit && $ib->status == 'berhasil') ? 'selected' : '' ?>>Berhasil</option>
                        <option value="gagal" <?= ($is_edit && $ib->status == 'gagal') ? 'selected' : '' ?>>Gagal</option>
                    </select>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-8 border-t border-stone-100 flex items-center justify-end gap-4">
                <a href="<?= site_url('inseminasi') ?>" 
                   class="px-6 py-3 rounded-xl text-stone-600 font-bold hover:bg-stone-100 transition-all duration-300">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-10 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm">
                    <?= $is_edit ? 'Simpan Perubahan' : 'Simpan Data' ?>
                </button>
            </div>
        </form>
    </div>
</div>