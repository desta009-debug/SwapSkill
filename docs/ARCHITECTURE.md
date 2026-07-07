# Architecture

## Overview

SwapSkill menggunakan arsitektur MVC (Model-View-Controller) dengan Service Layer untuk menjaga pemisahan tanggung jawab (Separation of Concerns) dan meningkatkan maintainability.

---

# Technology Stack

Backend

- Laravel 13
- PHP 8.3

Frontend

- Blade
- Tailwind CSS
- Alpine.js
- Vite

Database

- MySQL

Authentication

- Laravel Breeze

---

# High-Level Architecture

```
Browser
    │
    ▼
Routes
    │
    ▼
Controller
    │
    ▼
Service (optional)
    │
    ▼
Model
    │
    ▼
Database
```

---

# Directory Structure

```
app/
 ├── Http/
 ├── Models/
 ├── Services/
 ├── Providers/

resources/
 ├── views/
 ├── css/
 ├── js/

routes/
database/
config/
```

---

# Layer Responsibilities

## Controller

Controller bertugas:

- menerima request
- memanggil service
- mengembalikan response

Controller tidak boleh menyimpan business logic yang kompleks.

---

## Service

Service bertugas:

- menjalankan business logic
- mengorkestrasi beberapa model
- menjaga controller tetap tipis

---

## Model

Model bertugas:

- representasi data
- relasi Eloquent
- query scope
- accessor/mutator

---

## Blade

Blade hanya bertanggung jawab pada presentasi.

Business logic tidak boleh berada di Blade.

---

# Coding Principles

Selalu ikuti:

- SOLID
- DRY
- KISS
- Laravel Best Practices

---

# Current Modules

- Authentication
- Dashboard
- Profile
- Skill
- Match
- Swap
- Chat

---

# Future Architecture

Target jangka panjang:

- Form Request
- Policy
- Event
- Queue
- Cache
- Notification
- Better Testing