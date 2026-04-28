<div class="container mx-auto px-6 py-10 bg-[#faf7f2] min-h-screen">
    <!-- Header Halaman -->
    <div class="max-w-4xl mx-auto flex justify-between items-center mb-8 border-b border-stone-200 pb-4"
         x-data="{ show: false }" x-init="setTimeout(() => show = true, 50)"
         x-show="show" x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform -translate-y-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1a120b] tracking-wide"><?= $title ?></h1>
            <p class="text-stone-500 text-sm mt-1">Lengkapi informasi detail akun dan profil petugas</p>
        </div>
        <div class="flex gap-3">
            <a href="<?= site_url('user') ?>" class="inline-flex items-center text-sm font-bold text-stone-400 hover:text-[#1a120b] transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Konten Form dengan Reveal Animation -->
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden"
         x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 150)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8">
        
        <?php 
            $action = isset($user) ? site_url('user/edit/'.$user->id) : site_url('user/add');
            echo form_open($action, ['class' => '']); 
        ?>
        
        <?php if (isset($user)) : ?>
            <input type="hidden" name="id" value="<?= $user->id; ?>">
        <?php endif; ?>

        <div class="p-8 space-y-8">
            <!-- Validation Errors -->
            <?php if (validation_list_errors()) : ?>
                <div class="p-4 bg-red-50 border border-red-100 rounded-xl flex gap-3 text-red-700 text-sm" x-data="{ show: true }" x-show="show">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <div class="flex-1">
                        <span class="font-bold block mb-1">Perhatian!</span>
                        <?= validation_list_errors() ?>
                    </div>
                    <button @click="show = false" type="button" class="text-red-400 hover:text-red-600">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Section: Identitas Utama -->
                <div class="md:col-span-2">
                    <h3 class="text-xs font-bold text-[#a27b5c] uppercase tracking-widest mb-4 flex items-center">
                        <span class="w-8 h-[1px] bg-[#a27b5c] mr-3"></span> Identitas Akun
                    </h3>
                </div>

                <!-- Nama Lengkap -->
                <div class="space-y-2">
                    <label for="nama_lengkap" class="block text-sm font-bold text-[#1a120b] tracking-tight">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" 
                           class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 placeholder-stone-400 font-medium"
                           placeholder="Masukkan Nama Lengkap" 
                           value="<?= isset($user) ? $user->nama_lengkap : set_value('nama_lengkap'); ?>" required>
                </div>

                <!-- Username (NIK) -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-bold text-[#1a120b] tracking-tight">Username (NIK)</label>
                    <input type="text" name="username" id="username" 
                           class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 placeholder-stone-400 font-medium"
                           placeholder="Masukkan NIK sebagai Username" 
                           value="<?= isset($user) ? $user->username : set_value('username'); ?>" required>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-bold text-[#1a120b] tracking-tight">Kata Sandi</label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 placeholder-stone-400"
                           placeholder="••••••••">
                    <?php if (isset($user)) : ?>
                        <p class="text-[10px] text-stone-400 mt-1 italic font-medium uppercase tracking-wider">* Kosongkan jika tidak ingin mengubah sandi.</p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-bold text-[#1a120b] tracking-tight">Alamat Email</label>
                    <input type="email" name="email" id="email" 
                           class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 placeholder-stone-400 font-medium"
                           placeholder="nama@email.com" 
                           value="<?= isset($user) ? $user->email : set_value('email'); ?>">
                </div>

                <!-- Section: Informasi Kepegawaian -->
                <div class="md:col-span-2 pt-4">
                    <h3 class="text-xs font-bold text-[#a27b5c] uppercase tracking-widest mb-4 flex items-center">
                        <span class="w-8 h-[1px] bg-[#a27b5c] mr-3"></span> Detail Kepegawaian
                    </h3>
                </div>

                <!-- NIP -->
                <div class="space-y-2">
                    <label for="nip" class="block text-sm font-bold text-[#1a120b] tracking-tight">NIP</label>
                    <input type="text" name="nip" id="nip" 
                           class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 placeholder-stone-400 font-medium"
                           placeholder="Masukkan NIP" 
                           value="<?= isset($user) ? $user->nip : set_value('nip'); ?>">
                </div>
                
                <!-- Jabatan -->
                <div class="space-y-2">
                    <label for="jabatan" class="block text-sm font-bold text-[#1a120b] tracking-tight">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" 
                           class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none text-stone-800 placeholder-stone-400 font-medium"
                           placeholder="Masukkan Jabatan" 
                           value="<?= isset($user) ? $user->jabatan : set_value('jabatan'); ?>">
                </div>

                <!-- Role -->
                <div class="space-y-2">
                    <label for="role" class="block text-sm font-bold text-[#1a120b] tracking-tight">Hak Akses (Role)</label>
                    <select name="role" id="role" 
                            class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none bg-white text-stone-800 font-medium" required>
                        <?php $role = isset($user) ? $user->role : set_value('role'); ?>
                        <option value="admin" <?= ($role == 'admin') ? 'selected' : ''; ?>>Administrator Utama</option>
                        <option value="operator" <?= ($role == 'operator') ? 'selected' : ''; ?>>Operator Sistem</option>
                        <option value="penandatangan" <?= ($role == 'penandatangan') ? 'selected' : ''; ?>>Pejabat Penandatangan</option>
                        <option value="petugas" <?= ($role == 'petugas') ? 'selected' : ''; ?>>Petugas Lapangan</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="is_active" class="block text-sm font-bold text-[#1a120b] tracking-tight">Status Akun</label>
                    <select name="is_active" id="is_active" 
                            class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-[#a27b5c] focus:border-transparent transition-all outline-none bg-white text-stone-800 font-medium" required>
                        <?php $status = isset($user) ? $user->is_active : set_value('is_active'); ?>
                        <option value="1" <?= ($status == '1') ? 'selected' : ''; ?>>Aktif (Diberikan Akses)</option>
                        <option value="0" <?= ($status == '0') ? 'selected' : ''; ?>>Tidak Aktif (Akses Dicabut)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Footer Form -->
        <div class="px-8 py-6 bg-stone-50 border-t border-stone-100 flex items-center justify-end gap-4">
            <a href="<?= site_url('user'); ?>" class="px-6 py-2.5 text-stone-400 hover:text-[#1a120b] text-sm font-bold transition-colors">
                Batalkan
            </a>
            <button type="submit" class="px-10 py-2.5 bg-[#1a120b] hover:bg-[#a27b5c] text-white rounded-xl transition-all duration-300 shadow-sm text-sm font-bold tracking-wide">
                Simpan Informasi
            </button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
