# Project Context

## Project Overview

SwapSkill adalah platform pertukaran keterampilan (Skill Exchange Platform) yang mempertemukan pengguna untuk saling bertukar ilmu dan kemampuan tanpa menggunakan uang sebagai media transaksi.

Platform ini berfokus pada pembelajaran kolaboratif (Collaborative Learning), di mana setiap pengguna dapat menjadi mentor sekaligus pembelajar.

---

# Vision

Membangun platform komunitas yang memungkinkan setiap orang belajar keterampilan baru melalui sistem barter kemampuan secara mudah, aman, dan profesional.

---

# Mission

- Mempermudah proses menemukan partner belajar.
- Mendorong kolaborasi antar pengguna.
- Menyediakan sistem pertukaran skill yang adil.
- Membangun komunitas pembelajaran yang aktif.

---

# Target Users

- Mahasiswa
- Fresh Graduate
- Professional
- Freelancer
- Lifelong Learner

---

# Core Features

## Authentication

Pengguna dapat:

- Register
- Login
- Logout
- Edit Profile

---

## Skill Management

Pengguna dapat:

- Menambah skill
- Mengubah skill
- Menghapus skill
- Menentukan level skill
- Menentukan kategori skill

---

## Skill Matching

Sistem mencari kecocokan berdasarkan:

- Skill yang dimiliki
- Skill yang dicari
- Level kemampuan
- Kategori

---

## Swap Request

Pengguna dapat mengirim permintaan pertukaran skill.

Status swap terdiri dari:

- Pending
- Accepted
- Rejected
- Cancelled
- Completed
- Expired

---

## Chat

Chat hanya tersedia setelah Swap Request diterima.

Chat tidak boleh dapat diakses ketika status masih Pending atau Rejected.

---

## Dashboard

Dashboard menampilkan:

- Statistik
- Aktivitas terbaru
- Swap terbaru
- Match yang direkomendasikan

---

# Business Rules

## Rule 1

Satu pengguna tidak boleh mengirim Swap Request kepada dirinya sendiri.

---

## Rule 2

Tidak boleh ada lebih dari satu Swap Request aktif antara dua pengguna pada waktu yang sama.

---

## Rule 3

Chat hanya aktif setelah swap Accepted.

---

## Rule 4

Pengguna hanya dapat mengelola data miliknya sendiri.

---

## Rule 5

Skill yang dihapus tidak boleh menyebabkan data swap menjadi rusak.

---

## Rule 6

Semua aksi penting harus melalui proses autentikasi.

---

# Current Scope

Project ini menggunakan:

- Laravel 13
- Blade
- Tailwind CSS
- Vite
- MySQL

Arsitektur:

MVC + Service Layer

---

# Future Scope

Fitur yang dapat ditambahkan di masa depan:

- Rating
- Review
- Achievement
- Badge
- Notification
- Calendar
- Video Meeting
- AI Recommendation
- Email Notification

---

# Non Functional Requirements

Prioritas utama:

- Security
- Maintainability
- Performance
- Scalability
- Accessibility

---

# AI Guidelines

Saat melakukan perubahan:

- Jangan mengubah Business Rules tanpa persetujuan.
- Jangan menghapus fitur yang sudah ada.
- Pertahankan alur aplikasi.
- Selalu usulkan solusi yang paling maintainable.