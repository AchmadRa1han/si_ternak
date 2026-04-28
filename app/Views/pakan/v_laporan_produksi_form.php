<div class="max-w-4xl mx-auto"
     x-data="{ 
        items: [{ id: Date.now() }],
        addItem() {
            this.items.push({ id: Date.now() });
        },
        removeItem(index) {
            if (this.items.length > 1) {
                this.items.splice(index, 1);
            }
        },
        show: false 
     }" 
     x-init="setTimeout(() => show = true, 150)"
     x-show="show"
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="opacity-0 transform translate-y-8">
    
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <div class="bg-stone-50/50 px-8 py-4 border-b border-stone-100">
            <h2 class="text-lg font-bold text-[#1a120b] tracking-wide uppercase flex items-center gap-2">
                <i class="fas fa-edit text-[#a27b5c]"></i>
                Form Laporan Produksi
            </h2>
        </div>
        
        <div class="p-8">
            <form action="<?= site_url('pakan/laporan_produksi_store') ?>" method="POST" class="space-y-8">
                <?= csrf_field() ?>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <label class="block text-xs font-bold text-stone-500 uppercase tracking-widest mb-2">Nama Kelompok</label>
                        <select name="id_kelompok" class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none bg-stone-50/30 text-stone-800 font-medium">
                            <?php foreach ($kelompok as $row) : ?>
                                <option value="<?= esc($row->id_kelompok) ?>"><?= esc($row->nama_kelompok) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-500 uppercase tracking-widest mb-2">Bulan (1-12)</label>
                        <input type="number" name="bulan" min="1" max="12" required
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none bg-stone-50/30 text-stone-800 font-medium"
                               placeholder="Contoh: 5">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-500 uppercase tracking-widest mb-2">Tahun</label>
                        <input type="number" name="tahun" min="2020" required
                               class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none bg-stone-50/30 text-stone-800 font-medium"
                               value="<?= date('Y') ?>">
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-[#1a120b] tracking-wide">Detail Produksi</h3>
                        <button type="button" @click="addItem()"
                                class="bg-stone-100 hover:bg-stone-200 text-[#1a120b] px-4 py-2 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                            <i class="fas fa-plus text-[#a27b5c]"></i> Tambah Baris
                        </button>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(item, index) in items" :key="item.id">
                            <div class="p-6 rounded-2xl border border-stone-100 bg-stone-50/30 flex flex-wrap md:flex-nowrap gap-4 items-end"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform -translate-x-4">
                                <div class="flex-1 min-w-[200px]">
                                    <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-1">Jenis Pakan</label>
                                    <select name="id_jenis_pakan[]" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] outline-none bg-white text-sm font-medium">
                                        <?php foreach ($jenis_pakan as $row) : ?>
                                            <option value="<?= esc($row->id_jenis_pakan) ?>"><?= esc($row->nama_jenis) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="w-full md:w-48">
                                    <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-1">Jumlah Produksi (KG)</label>
                                    <input type="number" name="jumlah_produksi[]" required
                                           class="w-full px-4 py-2.5 rounded-xl border border-stone-200 focus:ring-2 focus:ring-[#a27b5c] outline-none bg-white text-sm font-medium"
                                           placeholder="0">
                                </div>
                                <button type="button" @click="removeItem(index)" 
                                        class="p-2.5 text-red-400 hover:text-red-600 transition-colors"
                                        x-show="items.length > 1">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="pt-10 flex items-center gap-4 border-t border-stone-100">
                    <button type="submit" 
                            class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-10 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-stone-200 flex items-center gap-3">
                        <i class="fas fa-save"></i>
                        Simpan Laporan
                    </button>
                    <a href="<?= site_url('pakan/laporan_produksi') ?>" 
                       class="text-stone-500 hover:text-[#1a120b] font-bold transition-colors px-6">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
