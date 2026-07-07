# 🚀 SwapSkill

> A modern Skill Exchange Platform built with Laravel.

![Status](https://img.shields.io/badge/Status-Active-success)
![Laravel](https://img.shields.io/badge/Laravel-13-red)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![License](https://img.shields.io/badge/License-MIT-green)

---

# 📖 Overview

SwapSkill adalah platform pertukaran keterampilan (Skill Exchange Platform) yang memungkinkan pengguna saling bertukar ilmu dan kemampuan tanpa menggunakan uang.

Pengguna dapat menawarkan skill yang dimiliki, mencari pengguna lain dengan kebutuhan yang sesuai, melakukan permintaan pertukaran (Skill Swap), hingga berkomunikasi melalui fitur chat setelah permintaan diterima.

Project ini dikembangkan menggunakan Laravel dengan pendekatan MVC + Service Layer untuk menghasilkan kode yang mudah dipelihara dan dikembangkan.

---

# ✨ Features

- Authentication (Laravel Breeze)
- User Profile
- Skill Management
- Skill Categories
- Skill Matching
- Skill Request
- Swap Management
- Chat
- Dashboard
- Notification

---

# 🛠 Tech Stack

Backend

- Laravel 13
- PHP 8.3

Frontend

- Blade
- Tailwind CSS
- Vite
- Alpine.js

Database

- MySQL

Authentication

- Laravel Breeze

Development

- Composer
- NPM
- Git

---

# 📁 Project Structure

```
app/
bootstrap/
config/
database/
docs/
public/
resources/
routes/
storage/
tests/
```

---

# ⚙ Installation

Clone repository

```bash
git clone https://github.com/desta009-debug/SwapSkill.git
```

Masuk ke project

```bash
cd SwapSkill
```

Install dependency

```bash
composer install
npm install
```

Copy environment

```bash
cp .env.example .env
```

Generate key

```bash
php artisan key:generate
```

Migrasi database

```bash
php artisan migrate
```

Jalankan frontend

```bash
npm run dev
```

Jalankan server

```bash
php artisan serve
```

---

# 🌳 Git Workflow

Main Branch

```
main
```

Development Branch

```
refactor/v2
```

Semua refactor dilakukan pada branch development terlebih dahulu sebelum di-merge ke main.

---

# 📚 Documentation

Dokumentasi project tersedia pada folder:

```
docs/
```

Meliputi:

- Project Context
- Architecture
- Audit
- Sprint
- Changelog
- Roadmap

---

# 🎯 Current Status

Version

```
v1.0
```

Current Development

```
Refactor Version 2.0
```

---

# 📌 Development Principles

Project ini mengikuti prinsip:

- Clean Code
- SOLID
- DRY
- KISS
- Separation of Concerns
- Laravel Best Practices

---

# 👨‍💻 Author

Desta

Information Systems Student

Laravel Developer

---

# 📄 License

This project is developed for educational purposes.