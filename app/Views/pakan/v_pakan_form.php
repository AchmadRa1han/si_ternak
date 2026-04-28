<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <a href="<?= site_url('pakan') ?>" class="text-[#a27b5c] hover:text-[#1a120b] flex items-center gap-2 transition-colors font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="max-w-2xl mx-auto">
        <!-- Card Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
             x-data="{ show: false }" 
             x-init="setTimeout(() => show = true, 150)"
             x-show="show"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-8">
            
            <?php echo isset($pakan) ? form_open('pakan/update/' . $pakan->id_jenis_pakan, ['class' => 'p-8']) : form_open('pakan/store', ['class' => 'p-8']); ?>
                
                <div class="space-y-6">
                    <!-- ID Pakan (ReadOnly if Edit) -->
                    <?php if (isset($pakan)): ?>
                    <div class="space-y-2">
                        <label for="id_jenis_pakan" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">ID Pakan</label>
                        <input type="text" name="id_jenis_pakan" id="id_jenis_pakan" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none bg-stone-50 text-stone-700 font-medium"
                               value="<?= esc($pakan->id_jenis_pakan); ?>" readonly>
                    </div>
                    <?php endif; ?>

                    <!-- Nama Pakan -->
                    <div class="space-y-2">
                        <label for="nama_jenis" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Nama Pakan</label>
                        <input type="text" name="nama_jenis" id="nama_jenis" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-medium"
                               value="<?php echo isset($pakan) ? esc($pakan->nama_jenis) : ''; ?>" required>
                    </div>

                    <!-- Jenis (Kategori) -->
                    <div class="space-y-2">
                        <label for="kategori" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Kategori Pakan</label>
                        <select name="kategori" id="kategori" 
                                class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 bg-white appearance-none">
                            <option value="Silase" <?php echo (isset($pakan) && $pakan->kategori == 'Silase') ? 'selected' : ''; ?>>SILASE</option>
                            <option value="Konsentrat" <?php echo (isset($pakan) && $pakan->kategori == 'Konsentrat') ? 'selected' : ''; ?>>KONSENTRAT</option>
                            <option value="Limbah" <?php echo (isset($pakan) && $pakan->kategori == 'Limbah') ? 'selected' : ''; ?>>LIMBAH</option>
                        </select>
                    </div>

                    <!-- Satuan -->
                    <div class="space-y-2">
                        <label for="satuan" class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider">Satuan</label>
                        <input type="text" name="satuan" id="satuan" 
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 font-bold"
                               value="<?php echo isset($pakan) ? esc($pakan->satuan) : 'KG'; ?>" required>
                    </div>
                </div>

                <div class="mt-10 flex justify-end gap-3 border-t border-stone-100 pt-8">
                    <a href="<?php echo site_url('pakan'); ?>" 
                       class="px-6 py-3 rounded-xl border border-stone-200 text-stone-600 font-bold hover:bg-stone-50 transition-all">
                        BATAL
                    </a>
                    <button type="submit" 
                            class="px-10 py-3 rounded-xl bg-[#1a120b] text-white font-bold hover:bg-[#a27b5c] shadow-lg shadow-stone-200 transition-all transform hover:-translate-y-1 uppercase tracking-wider">
                        Simpan Jenis
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>