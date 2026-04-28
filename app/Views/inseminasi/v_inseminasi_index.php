<!-- application/views/inseminasi/v_inseminasi_index.php -->

<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex justify-end"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 100)"
         x-show="show"
         x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform translate-x-4">
        <a href="<?= site_url('inseminasi/tambah_ib') ?>" 
           class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Data IB
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
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Tgl IB</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">ID Hewan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Nama Peternak</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Petugas IB</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-[#1a120b] uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-[#1a120b] uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-100">
                        <?php if (empty($inseminasi)): ?>
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-stone-400 font-medium italic">
                                    Data masih kosong
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach($inseminasi as $ib): ?>
                            <tr class="hover:bg-[#fcfaf7] transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600"><?= $no++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-stone-800"><?= date('d/m/Y', strtotime($ib->tanggal_ib)) ?></td>
                                <td class="px-6 py-4 text-sm text-stone-700"><?= esc($ib->id_hewan) ?></td>
                                <td class="px-6 py-4 text-sm text-stone-700"><?= esc($ib->nama_peternak) ?></td>
                                <td class="px-6 py-4 text-sm text-stone-700"><?= esc($ib->nama_petugas) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($ib->status == 'berhasil'): ?>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full uppercase tracking-wider">Berhasil</span>
                                    <?php elseif($ib->status == 'gagal'): ?>
                                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full uppercase tracking-wider">Gagal</span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full uppercase tracking-wider">Menunggu</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="<?= site_url('inseminasi/edit_ib/' . $ib->id_ib) ?>" class="text-[#a27b5c] hover:text-[#1a120b] transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= site_url('inseminasi/destroy_ib/' . $ib->id_ib) ?>" 
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