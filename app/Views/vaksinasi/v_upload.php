<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
    </div>

    <div class="max-w-3xl mx-auto"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        
        <!-- Flash Messages -->
        <?php if(session()->getFlashdata('success')) : ?>
            <div x-data="{ show: true }" x-show="show" class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium"><?= session()->getFlashdata('success') ?></span>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800">×</button>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')) : ?>
            <div x-data="{ show: true }" x-show="show" class="mb-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium"><?= session()->getFlashdata('error') ?></span>
                </div>
                <button @click="show = false" class="text-red-600 hover:text-red-800">×</button>
            </div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
            <div class="p-8">
                <div class="mb-8">
                    <div class="w-16 h-16 bg-[#faf7f2] rounded-2xl flex items-center justify-center mb-4 border border-stone-100">
                        <svg class="w-8 h-8 text-[#a27b5c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <p class="text-stone-600 leading-relaxed">
                        Silakan pilih file ZIP laporan vaksinasi untuk diunggah. Sistem akan secara otomatis mengekstrak dan memfilter data untuk <b class="text-[#1a120b]">Kabupaten Sinjai</b>.
                    </p>
                </div>

                <hr class="border-stone-100 mb-8">

                <?= form_open_multipart('vaksinasi/process_upload', ['class' => 'space-y-6']) ?>
                    <div>
                        <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Pilih File ZIP</label>
                        <div class="relative group">
                            <input type="file" name="zip_file" id="zip_file" required accept=".zip"
                                   class="w-full px-4 py-3 border-2 border-dashed border-stone-200 rounded-2xl focus:outline-none focus:border-[#a27b5c] transition-all duration-300 bg-stone-50 hover:bg-white cursor-pointer">
                            <div class="mt-2 text-xs text-stone-500 italic">
                                * Format file yang diperbolehkan hanya .zip
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full bg-[#1a120b] hover:bg-[#a27b5c] text-white px-8 py-4 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Upload dan Proses Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
