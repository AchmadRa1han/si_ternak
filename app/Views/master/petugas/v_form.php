<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <a href="<?= site_url('master/petugas') ?>" class="text-[#a27b5c] hover:text-[#1a120b] flex items-center gap-2 transition-colors font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Card Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
             x-data="{ show: false }" 
             x-init="setTimeout(() => show = true, 150)"
             x-show="show"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-8">
            
            <?php 
                $is_edit = isset($petugas);
                $action_url = $is_edit ? site_url('master/petugas_edit/' . $petugas->id_petugas) : site_url('master/petugas_add');
            ?>
            
            <form action="<?= $action_url ?>" method="post" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- ID Petugas -->
                    <div class="space-y-2">
                        <label for="id_petugas" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">ID Petugas</label>
                        <input type="text" name="id_petugas" id="id_petugas" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none bg-stone-50 text-stone-700 font-medium"
                               value="<?= $is_edit ? esc($petugas->id_petugas) : set_value('id_petugas') ?>" 
                               <?= $is_edit ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Nama Petugas -->
                    <div class="space-y-2">
                        <label for="nama_petugas" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="nama_petugas" id="nama_petugas" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium"
                               value="<?= $is_edit ? esc($petugas->nama_petugas) : set_value('nama_petugas') ?>" required>
                    </div>

                    <!-- NIP -->
                    <div class="space-y-2">
                        <label for="nip" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">NIP</label>
                        <input type="text" name="nip" id="nip" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-mono"
                               value="<?= $is_edit ? esc($petugas->nip) : set_value('nip') ?>" placeholder="7307...">
                    </div>

                    <!-- Pangkat -->
                    <div class="space-y-2">
                        <label for="pangkat" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Pangkat</label>
                        <input type="text" name="pangkat" id="pangkat" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800"
                               value="<?= $is_edit ? esc($petugas->pangkat) : set_value('pangkat') ?>" placeholder="Contoh: Penata Muda">
                    </div>

                    <!-- Jabatan -->
                    <div class="space-y-2">
                        <label for="jabatan" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800"
                               value="<?= $is_edit ? esc($petugas->jabatan) : set_value('jabatan') ?>" placeholder="Contoh: Petugas IB">
                    </div>

                    <!-- No HP -->
                    <div class="space-y-2">
                        <label for="no_hp" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">No. Handphone</label>
                        <input type="text" name="no_hp" id="no_hp" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-mono"
                               value="<?= $is_edit ? esc($petugas->no_hp) : set_value('no_hp') ?>" placeholder="08...">
                    </div>
                    
                    <!-- Status Aktif -->
                    <div class="space-y-2">
                        <label for="is_active" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Status Aktif</label>
                        <select name="is_active" id="is_active" 
                                class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 appearance-none bg-white">
                            <option value="1" <?= ($is_edit && $petugas->is_active == 1) ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= ($is_edit && $petugas->is_active == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="mt-10 flex justify-end gap-3 border-t border-stone-100 pt-8">
                    <a href="<?= site_url('master/petugas') ?>" 
                       class="px-6 py-3 rounded-xl border border-stone-200 text-stone-600 font-bold hover:bg-stone-50 transition-all">
                        BATAL
                    </a>
                    <button type="submit" 
                            class="px-10 py-3 rounded-xl bg-[#1a120b] text-white font-bold hover:bg-[#a27b5c] shadow-lg shadow-stone-200 transition-all transform hover:-translate-y-1 uppercase tracking-wider">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
