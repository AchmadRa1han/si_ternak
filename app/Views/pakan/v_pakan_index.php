<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
            <a href="<?= site_url('pakan/create') ?>" 
               class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Jenis Pakan
            </a>
        </div>
    </div>

    <!-- Konten Card dengan Staggered Animation -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="p-8">
            <div class="overflow-x-auto rounded-xl border border-stone-200">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Nama Pakan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest text-center">Kategori</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-[#1a120b] uppercase tracking-widest">Satuan</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-[#1a120b] uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php foreach($pakan as $row): ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#1a120b]"><?= esc($row->id_jenis_pakan) ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-stone-800"><?= esc($row->nama_jenis) ?></td>
                                <td class="px-6 py-4 text-center">
                                    <?php 
                                        $katClass = 'bg-stone-100 text-stone-600';
                                        if($row->kategori == 'Silase') $katClass = 'bg-green-50 text-green-600';
                                        if($row->kategori == 'Konsentrat') $katClass = 'bg-blue-50 text-blue-600';
                                        if($row->kategori == 'Limbah') $katClass = 'bg-orange-50 text-orange-600';
                                    ?>
                                    <span class="px-3 py-1 text-xs font-bold rounded-full <?= $katClass ?>">
                                        <?= strtoupper(esc($row->kategori)) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-0.5 text-xs font-bold border border-stone-200 text-stone-500 rounded uppercase tracking-wider">
                                        <?= esc($row->satuan) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="<?= site_url('pakan/edit/' . $row->id_jenis_pakan) ?>" 
                                       class="text-[#a27b5c] hover:text-[#1a120b] font-bold text-sm transition-colors uppercase tracking-tight">EDIT</a>
                                    <a href="<?= site_url('pakan/delete/' . $row->id_jenis_pakan) ?>" 
                                       class="text-red-400 hover:text-red-700 font-bold text-sm transition-colors uppercase tracking-tight"
                                       onclick="return confirm('Yakin ingin menghapus data ini?')">HAPUS</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>