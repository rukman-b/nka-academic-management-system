# 📊 Dataset Import Guide

This guide explains how to import the sample dataset provided with this project.

---
## 📌 Overview

The repository includes a set of SQL dump files designed to help users quickly explore the system with realistic data.

These files represent core academic entities such as:

- Departments  
- Programmes  
- Levels  
- Modules
- Practicals
- Theories
- Skill Categories
- Skills  

---

## ⚠️ Important

The SQL files are **numbered intentionally**.

👉 You MUST import them in order.

This ensures that **foreign key constraints** are satisfied.

---
## 🗂 File Location

```text
database/dumps/
```
Example:

01_departments.sql
02_levels.sql
03_programmes.sql
04_modules.sql
05_module_department.sql
06_practicals.sql
07_theories.sql
08_skill_categories.sql
09_skills.sql

---

## 🛠 Import Methods

### 🔹 Option 1 — MySQL CLI

Run each file in order:
```bash
mysql -h 127.0.0.1 -P 3306 -u root -p < database/dumps/01_departments.sql
```
Repeat for all files.

---
### 🔹 Option 2 — phpMyAdmin

1. Open: [http://localhost:8080](http://localhost:8080)
2. Select your database
3. Import each SQL file one by one
4. Follow numeric order strictly

---
## 💡 Tips

* Run migrations before importing:
  ```bash
  php artisan migrate
  ```
* If you face foreign key errors:

  * check import order
  * ensure tables exist

---
## 🧪 What This Data Is For

The dataset is intended to:

* simulate a real academic environment
* allow users to explore system features
* demonstrate relationships between entities

---
## ⚠️ Notes

* All data is synthetic (generated for demonstration)
* You can modify or extend the dataset as needed
* This dataset is optional but highly recommended for full experience

---
## 🎯 Recommended Flow

1. Run system setup → `SETUP.md`
2. Import dataset → this guide
3. Explore system → dashboards and modules

---
## 🚀 Final Note

This dataset is designed to help users quickly experience the system without needing to manually create complex relational data.

```