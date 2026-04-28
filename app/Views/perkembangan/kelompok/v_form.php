<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= esc($title) ?></h1>
        <div class="flex gap-3">
            <a href="<?= site_url('perkembangan/kelompok') ?>" 
               class="bg-stone-200 hover:bg-stone-300 text-stone-700 px-4 py-2 rounded-xl transition-colors duration-300 font-medium">
                Kembali
            </a>
        </div>
    </div>

    <!-- Konten Form -->
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        <div class="p-8">
            <?php 
                $action = isset($kelompok) ? site_url('perkembangan/kelompok_edit/'.$kelompok->id) : site_url('perkembangan/kelompok_add');
            ?>
            <form action="<?= $action ?>" method="post" class="space-y-8">
                <?php if(isset($kelompok)) echo '<input type="hidden" name="id" value="'.esc($kelompok->id).'">'; ?>

                <?php if(session()->getFlashdata('errors')): ?>
                <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6">
                    <ul class="list-disc list-inside">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Section: Informasi Dasar -->
                    <div class="space-y-6 md:col-span-2">
                        <h3 class="text-lg font-bold text-[#1a120b] border-l-4 border-[#a27b5c] pl-3 uppercase tracking-wider">Informasi Dasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Kode Kelompok</label>
                                <input type="text" name="kode_kelompok" 
                                       class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300 bg-stone-50"
                                       value="<?= isset($kelompok) ? esc($kelompok->kode_kelompok) : '' ?>" <?= isset($kelompok) ? 'readonly' : 'required' ?>>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Nama Kelompok</label>
                                <input type="text" name="nama_kelompok" 
                                       class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                       value="<?= isset($kelompok) ? esc($kelompok->nama_kelompok) : '' ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Lokasi -->
                    <div class="space-y-6 md:col-span-2">
                        <h3 class="text-lg font-bold text-[#1a120b] border-l-4 border-[#a27b5c] pl-3 uppercase tracking-wider">Lokasi & Alamat</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan_id" 
                                        class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                        required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    <?php foreach($kecamatan_list as $kec): ?>
                                        <option value="<?= $kec->kecamatan_id ?>" <?= (isset($kelompok) && $kelompok->kecamatan_id == $kec->kecamatan_id) ? 'selected' : '' ?>>
                                            <?= esc($kec->kecamatan_nama) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Desa</label>
                                <select id="desa" name="desa_id" 
                                        class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                        required>
                                    <option value="">-- Pilih Kecamatan Terlebih Dahulu --</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" rows="3" 
                                          class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"><?= isset($kelompok) ? esc($kelompok->alamat_lengkap) : '' ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Detail Ternak -->
                    <div class="space-y-6 md:col-span-2">
                        <h3 class="text-lg font-bold text-[#1a120b] border-l-4 border-[#a27b5c] pl-3 uppercase tracking-wider">Detail & Anggaran</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Tahun Anggaran</label>
                                <input type="number" name="tahun_anggaran" 
                                       class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300"
                                       value="<?= isset($kelompok) ? esc($kelompok->tahun_anggaran) : date('Y') ?>">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Sumber Dana</label>
                                <select name="sumber_dana" 
                                        class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300">
                                    <?php $sd = isset($kelompok) ? $kelompok->sumber_dana : ''; ?>
                                    <option value="APBN" <?= ($sd == 'APBN') ? 'selected' : '' ?>>APBN</option>
                                    <option value="APBD I" <?= ($sd == 'APBD I') ? 'selected' : '' ?>>APBD I</option>
                                    <option value="APBD II" <?= ($sd == 'APBD II') ? 'selected' : '' ?>>APBD II</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1a120b] uppercase tracking-wider mb-2">Ras Ternak</label>
                                <select name="rasternak" 
                                        class="w-full px-4 py-3 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all duration-300">
                                    <?php $rt = isset($kelompok) ? $kelompok->rasternak : ''; ?>
                                    <option value="Bali" <?= ($rt == 'Bali') ? 'selected' : '' ?>>Bali</option>
                                    <option value="Kambing" <?= ($rt == 'Kambing') ? 'selected' : '' ?>>Kambing</option>
                                    <option value="Sapi Perah" <?= ($rt == 'Sapi Perah') ? 'selected' : '' ?>>Sapi Perah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-8 border-t border-stone-100">
                    <button type="submit" 
                            class="bg-[#1a120b] hover:bg-[#a27b5c] text-white px-10 py-3 rounded-xl transition-all duration-300 font-bold tracking-widest uppercase text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Simpan Kelompok
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function loadDesa(kecamatan_id, selected_desa_id = '') {
        var desa_dd = $('#desa');
        desa_dd.html('<option value="">Loading...</option>');
        
        $.ajax({
            url: "<?= site_url('perkembangan/get_desa_by_kecamatan') ?>",
            type: 'POST',
            dataType: 'json',
            data: {kecamatan_id: kecamatan_id},
            success: function(response) {
                desa_dd.html('<option value="">-- Pilih Desa --</option>');
                $.each(response, function(key, value) {
                    var is_selected = (value.desa_id == selected_desa_id) ? 'selected' : '';
                    desa_dd.append('<option value="' + value.desa_id + '" ' + is_selected + '>' + value.desa_nama + '</option>');
                });
            },
            error: function() { desa_dd.html('<option value="">Gagal memuat data</option>'); }
        });
    }

    $('#kecamatan').on('change', function() {
        var kecamatan_id = $(this).val();
        if (kecamatan_id) {
            loadDesa(kecamatan_id);
        } else {
            $('#desa').html('<option value="">-- Pilih Kecamatan Terlebih Dahulu --</option>');
        }
    });

    <?php if (isset($kelompok) && !empty($kelompok->kecamatan_id)): ?>
        var selected_desa_id = "<?= $kelompok->desa_id ?>";
        var kecamatan_id_on_load = $('#kecamatan').val();
        
        if(kecamatan_id_on_load){
             loadDesa(kecamatan_id_on_load, selected_desa_id);
        }
    <?php endif; ?>
});
</script>
