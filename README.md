# 🚀 OSIS Portal - Frontend (Project B)

Aplikasi web *frontend* berbasis **Laravel** dan **Tailwind CSS (Dark Glassmorphism UI)** yang terintegrasi penuh dengan REST API OSIS (Project A). Aplikasi ini dirancang untuk mengelola pendaftaran calon pengurus OSIS secara interaktif dan real-time.

---

## ✨ Fitur Utama

- **🎨 Modern Dark Glassmorphism UI**: Antarmuka responsif dengan efek visual blur dan glow transparan.
- **📊 Interactive Dashboard**: Menampilkan seluruh kandidat terdaftar beserta relasi data (*Siswa, Kelas, Jenis Kelamin*).
- **🔍 Real-time Search**: Pencarian instan kandidat berdasarkan nama siswa atau pilihan bidang OSIS tanpa *reload* halaman.
- **📄 Client-Side Pagination**: Pembagian tampilan data secara dinamis per halaman.
- **👁️ Pop-up Detail Modal**: Tampilan cepat untuk melihat detail identitas dan motivasi kandidat secara utuh.
- **⚡ Full CRUD Operations**: Fitur Tambah, Edit, dan Hapus pendaftaran yang langsung tersinkronkan dengan REST API backend.
- **⚠️ Interactive Validation (HTTP 422)**: Penanganan error validasi otomatis dari backend dengan pesan yang jelas serta mempertahankan input pengguna (*old input retention*).

---

## 🛠️ Persyaratan Sistem & Dependensi

- **PHP**: `>= 8.1`
- **Laravel**: Framework utama Frontend
- **Tailwind CSS**: Dideploy via CDN / PostCSS
- **Project A (Backend API OSIS)**: Harus berjalan secara independen di port `8000`

---

## 🚀 Cara Menjalankan Project

Untuk menjalankan aplikasi ini secara lokal, pastikan kedua project (**Project A/API** dan **Project B/Frontend**) berjalan secara bersamaan pada dua terminal berbeda.

### 1. Jalankan Backend (Project A - API OSIS)
Buka terminal pertama, masuk ke direktori Project A, lalu jalankan:
```bash
php artisan serve --port=8000
```
> **Endpoint API:** `http://127.0.0.1:8000/api/`

### 2. Jalankan Frontend (Project B - Laravel)
Buka terminal kedua, masuk ke direktori Project B, pastikan dependensi dan file `.env` sudah siap, lalu jalankan:
```bash
php artisan serve --port=8001
```

### 3. Akses Aplikasi
Buka *browser* pilihan Anda dan akses URL utama berikut:
```text
http://127.0.0.1:8001/
```

---

## 🔗 Repository Terkait

- **Backend API OSIS (Project A)**: [https://github.com/aidiekamil-bit/latihan-rest-api-2.git]
- **Frontend OSIS Portal (Project B)**: Repository Saat Ini

---
*Dikembangkan untuk memenuhi Tugas LKPD Integrasi API & Frontend Laravel — RPL Kelas XI.*