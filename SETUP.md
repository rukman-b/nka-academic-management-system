# 🚀 Setup Guide  
_**NKA Academic Management System**_

---
## 📌 Introduction

This guide will help you set up the NKA system locally using Docker.

The goal is simple:

👉 Get the system running quickly  
👉 Explore the architecture and features  

---
## 🧠 Before You Start

This project uses a modern development stack:

- Laravel 11 + Livewire 3  
- Docker (Nginx, MariaDB, Redis)  
- Vite for frontend assets  

You don’t need to install PHP or MySQL locally — Docker handles everything.

---
## ⚙️ Prerequisites

Make sure you have:

- Docker installed and running  
- Git installed  

Optional:
- phpMyAdmin (included in Docker setup)  
- VS Code  

---
## 🧭 Step 1 — Clone the Repository
```bash
git clone https://github.com/rukman-b/nka-academic-management-system.git
cd nka-academic-management-system
```
---
## 🧭 Step 2 — Prepare Environment
```bash
cp .env.example .env
```
---
## 🧭 Step 3 — Start Docker
```bash
sudo systemctl start docker
```
Verify:
```bash
docker ps
```
---
## 🧭 Step 4 — Build and Run the System
```bash
docker compose up -d --build
```
This will start:

* Laravel application
* Nginx server
* MariaDB database
* Redis cache
* Vite dev server
---
## 🧭 Step 5 — Install Dependencies
```bash
docker compose exec laravel composer install
```
---
## 🧭 Step 6 — Generate Application Key
```bash
docker compose exec laravel php artisan key:generate
```
---
## 🧭 Step 7 — Setup Database
Run migrations:
```bash
docker compose exec laravel php artisan migrate
```
---
## 🧭 Step 8 — Seed Base Data
```bash
docker compose exec laravel php artisan db:seed
```
This loads:

* Roles and permissions
* Basic user structure
---
## 📊 Step 9 — Import Sample Dataset (Recommended)

To experience the system fully, import the provided dataset.

👉 See: `docs/dataset-guide.md`

This dataset includes:

* Departments
* Programmes
* Levels
* Modules
* Practicals
* Theories
* Skill Categories
* Skills

⚠️ Important: Import SQL files **in numeric order**.

---

## 🌐 Step 10 — Access the System
| Service     | URL                                            |
| ----------- | ---------------------------------------------- |
| Application | [http://localhost:8000](http://localhost:8000) |
| phpMyAdmin  | [http://localhost:8080](http://localhost:8080) |
| Vite Dev    | [http://localhost:5173](http://localhost:5173) |

---
## 🔁 Daily Workflow

Start system:
```bash
docker compose up -d
```
Stop system:
```bash
docker compose down
```
⚠️ Avoid `-v` unless you want to delete all data.

---
## 🧪 Useful Commands

### Run tests
```bash
docker compose exec laravel php artisan test
```
### Open Laravel shell
```bash
docker compose exec laravel bash
```
### Run Tinker
```bash
docker compose exec laravel php artisan tinker
```
---
## 🧩 Understanding the System

Once running, explore:

* 🔐 Role-based access (RBAC)
* 🧱 Academic structure (Programmes → Modules → Skills)
* ⚙️ Admin dashboards
* 📊 DataTable components
---
## ⚠️ Important Notes

* This is a **Phase 1 implementation**
* Student and employer modules are **partially implemented**
* All data is **synthetic (Faker-generated)**
---
## 🎯 Need Help?

If something doesn’t work:

1. Check Docker is running
2. Run `docker compose logs`
3. Restart containers
---
## 🚀 Next Step

Once setup is complete:

👉 Go back to the README and explore the system architecture and features.
