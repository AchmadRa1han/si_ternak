<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <a href="<?= site_url('master/hewan') ?>" class="text-[#a27b5c] hover:text-[#1a120b] flex items-center gap-2 transition-colors font-semibold">
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
                $is_edit = isset($hewan);
                $action_url = $is_edit ? site_url('master/hewan_edit/' . $hewan->id_hewan) : site_url('master/hewan_add');
            ?>
            
            <form action="<?= $action_url ?>" method="post" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- ID Hewan -->
                    <div class="space-y-2">
                        <label for="id_hewan" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">ID Hewan / Eartag</label>
                        <input type="text" name="id_hewan" id="id_hewan" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none bg-stone-50 text-stone-700 font-medium"
                               value="<?= $is_edit ? esc($hewan->id_hewan) : set_value('id_hewan') ?>" 
                               <?= $is_edit ? 'readonly' : '' ?> required>
                    </div>

                    <!-- Nama Hewan -->
                    <div class="space-y-2">
                        <label for="nama_hewan" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Nama Hewan</label>
                        <input type="text" name="nama_hewan" id="nama_hewan" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium"
                               value="<?= $is_edit ? esc($hewan->nama_hewan) : set_value('nama_hewan') ?>" required>
                    </div>
                    
                    <!-- Bangsa Induk -->
                    <div class="space-y-2">
                        <label for="bangsa_induk" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Bangsa Induk</label>
                        <input type="text" name="bangsa_induk" id="bangsa_induk" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium"
                               value="<?= $is_edit ? esc($hewan->bangsa_induk) : set_value('bangsa_induk') ?>">
                    </div>

                    <!-- Pemilik -->
                    <div class="space-y-2">
                        <label for="id_peternak" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Pemilik (Peternak)</label>
                        <select name="id_peternak" id="id_peternak" 
                                class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 appearance-none bg-white">
                            <option value="">-- Pilih Peternak --</option>
                            <?php foreach ($peternak_list as $p): ?>
                                <option value="<?= $p->id_peternak ?>" <?= ($is_edit && $p->id_peternak == $hewan->id_peternak) ? 'selected' : '' ?>><?= esc($p->nama_peternak) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="space-y-2">
                        <label for="tanggal_lahir" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800"
                               value="<?= $is_edit ? esc($hewan->tanggal_lahir) : set_value('tanggal_lahir') ?>" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="space-y-2">
                        <label for="jenis_kelamin" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Jenis Kelamin</label>
                        <div class="flex gap-4 pt-2">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="jenis_kelamin" value="jantan" class="hidden peer" <?= ($is_edit && $hewan->jenis_kelamin == 'jantan') ? 'checked' : '' ?> required>
                                <div class="w-5 h-5 rounded-full border-2 border-stone-300 peer-checked:border-[#a27b5c] peer-checked:bg-[#a27b5c] transition-all relative">
                                    <div class="absolute inset-1 bg-white rounded-full scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>
                                <span class="text-sm font-medium text-stone-600 group-hover:text-[#1a120b]">Jantan</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="jenis_kelamin" value="betina" class="hidden peer" <?= ($is_edit && $hewan->jenis_kelamin == 'betina') ? 'checked' : '' ?>>
                                <div class="w-5 h-5 rounded-full border-2 border-stone-300 peer-checked:border-[#a27b5c] peer-checked:bg-[#a27b5c] transition-all relative">
                                    <div class="absolute inset-1 bg-white rounded-full scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>
                                <span class="text-sm font-medium text-stone-600 group-hover:text-[#1a120b]">Betina</span>
                            </label>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="status" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Status Hewan</label>
                        <select name="status" id="status" 
                                class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 appearance-none bg-white">
                            <option value="aktif" <?= ($is_edit && $hewan->status == 'aktif') ? 'selected' : '' ?>>AKTIF</option>
                            <option value="mati" <?= ($is_edit && $hewan->status == 'mati') ? 'selected' : '' ?>>MATI</option>
                            <option value="terjual" <?= ($is_edit && $hewan->status == 'terjual') ? 'selected' : '' ?>>TERJUAL</option>
                        </select>
                    </div>
                </div>

                <div class="mt-10 flex justify-end gap-3 border-t border-stone-100 pt-8">
                    <a href="<?= site_url('master/hewan') ?>" 
                       class="px-6 py-3 rounded-xl border border-stone-200 text-stone-600 font-bold hover:bg-stone-50 transition-all">
                        BATAL
                    </a>
                    <button type="submit" 
                            class="px-10 py-3 rounded-xl bg-[#1a120b] text-white font-bold hover:bg-[#a27b5c] shadow-lg shadow-stone-200 transition-all transform hover:-translate-y-1">
                        SIMPAN DATA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
