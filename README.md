# SI-TERNAK

**SI-TERNAK** (Sistem Informasi Peternakan) adalah aplikasi berbasis web yang dirancang untuk mengelola data peternakan secara komprehensif, mulai dari manajemen hewan, pelaporan vaksinasi, inseminasi buatan, hingga monitoring produksi pakan.

## ✨ Fitur Utama

*   **Manajemen Data Master**: Pengelolaan data Petugas Lapangan, Peternak, dan Hewan Ternak.
*   **Sistem Vaksinasi**: Fitur upload laporan vaksinasi secara massal melalui file ZIP (CSV) dengan rekapitulasi performa per petugas.
*   **Inseminasi & Kelahiran**: Pelacakan riwayat Inseminasi Buatan (IB), Pemeriksaan Kebuntingan (PKB), dan pencatatan kelahiran ternak.
*   **Manajemen Pakan**: Pencatatan jenis pakan dan laporan produksi pakan bulanan per kelompok ternak.
*   **Monitoring Populasi**: Laporan bulanan perkembangan populasi ternak (lahir, mati, jual).
*   **Manajemen Pengguna**: Kontrol akses sistem untuk berbagai level pengguna.

## 🎨 UI Philosophy: The Earthy Boldness

Aplikasi ini mengusung tema **"The Earthy Boldness"** yang memberikan kesan modern, profesional, dan berwibawa:
*   **Deep Espresso**: Digunakan untuk navigasi dan elemen utama untuk kesan otoritas.
*   **Mocha Cream**: Latar belakang lembut yang nyaman di mata.
*   **Terracotta/Clay**: Aksen warna tanah untuk interaksi dan elemen penting.
*   **Soft-Edge Design**: Penggunaan radius besar (`rounded-2xl`) dan bayangan halus untuk tampilan yang premium.

## 🚀 Teknologi

*   **Framework**: CodeIgniter 4 (PHP 8.1+)
*   **Styling**: Tailwind CSS
*   **Interaktivitas**: Alpine.js
*   **Database**: MySQL

## 🛠️ Instalasi

1.  Clone repository.
2.  Jalankan `composer install`.
3.  Salin `env` ke `.env` dan sesuaikan konfigurasi database serta `app.baseURL`.
4.  Jalankan migrasi atau impor database (jika tersedia).
5.  Akses aplikasi melalui server lokal (misal: `php spark serve`).

## 📋 Lisensi

Aplikasi ini dikembangkan untuk kebutuhan internal manajemen peternakan. Seluruh hak cipta dilindungi.
