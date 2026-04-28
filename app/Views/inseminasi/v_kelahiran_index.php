<!-- application/views/inseminasi/v_kelahiran_index.php -->

<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex justify-end"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 100)"
         x-show="show"
         x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform translate-x-4">
        <a href="<?= site_url('inseminasi/tambah_kelahiran') ?>" 
           class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Data Kelahiran
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        
        <div class="p-8">
            <?php if(session()->getFlashdata('success')) : ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl flex items-center gap-3 animate-pulse">
                    <i class="fas fa-check-circle"></i>
                    <span class="font-medium"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <div class="overflow-x-auto rounded-xl border border-stone-200">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Tgl Lapor</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">ID Induk</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Nama Peternak</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Jenis Kelamin Anak</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Petugas Lapor</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-[#1a120b] uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php if (empty($kelahiran)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-stone-400 font-medium italic">
                                    Data masih kosong
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach($kelahiran as $k): ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600"><?= $no++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-stone-800"><?= date('d/m/Y', strtotime($k->tgl_laporan)) ?></td>
                                <td class="px-6 py-4 text-sm text-stone-700"><?= esc($k->id_hewan) ?></td>
                                <td class="px-6 py-4 text-sm text-stone-700"><?= esc($k->nama_peternak) ?></td>
                                <td class="px-6 py-4 text-sm text-stone-700">
                                    <span class="px-3 py-1 <?= strtolower($k->jenis_kelamin) == 'jantan' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600' ?> text-xs font-bold rounded-full uppercase tracking-wider">
                                        <?= esc($k->jenis_kelamin) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-stone-700"><?= esc($k->nama_petugas) ?></td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="<?= site_url('inseminasi/edit_kelahiran/' . $k->id_laporan) ?>" class="text-[#a27b5c] hover:text-[#1a120b] transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= site_url('inseminasi/destroy_kelahiran/' . $k->id_laporan) ?>" 
                                       class="text-red-400 hover:text-red-700 transition-colors" 
                                       title="Hapus"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
