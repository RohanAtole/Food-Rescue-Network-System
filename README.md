# 🍽️ Food Rescue Network System

A web-based platform designed to collect **surplus food from donors (Hotels, Restaurants, Individuals)** and distribute it to **charities, orphanages, and needy people**, helping reduce food waste and hunger.

Built using **PHP, HTML, CSS, Bootstrap, and MySQL**, this system provides role-based modules: **Admin, Donor, and Charity/NGO**.

---

## 🚀 Project Objectives

- Reduce excess food waste
- Allow donors to easily offer food
- Enable NGOs/charities to request food
- Manage food distribution efficiently
- Promote social responsibility using technology

---

## 🛠️ Technology Stack

| Category     | Technology |
|--------------|------------|
| Frontend     | HTML, CSS, Bootstrap |
| Backend      | PHP |
| Database     | MySQL |
| Server       | XAMPP / WAMP / LAMP |
| Version Control | Git & GitHub |

---

## 📁 Project Structure (As-Is)

Food Rescue Network System/
└── code files/
├── admin/
│ ├── adminlogin.php
│ ├── admin_dash.php
│ ├── alldonor.php
│ ├── allcharity.php
│ ├── reports.php
│ └── assets/
│ ├── css/
│ ├── images/
│ └── vendor/
│
├── donor/
│ ├── donorlogin.php
│ ├── donor_dashboard.php
│ ├── donate_food.php
│ └── donor_profile.php
│
├── charity/
│ ├── charitylogin.php
│ ├── charity_dashboard.php
│ ├── request_food.php
│ └── charity_profile.php
│
├── includes/
│ ├── header.php
│ ├── footer.php
│ ├── navbar.php
│ └── session.php
│
├── config/
│ └── db.php
│
├── assets/
│ ├── css/
│ ├── js/
│ └── images/
│
├── sql/
│ └── food_rescue_network.sql
│
└── index.php
---

## ⚙️ Installation Guide

### 1️⃣ Clone the repository

```bash
git clone https://github.com/RohanAtole/Food-Rescue-Network-System.git

### 2️⃣ Move the folder to server directory
```
For XAMPP → htdocs/

For WAMP → www/

### 3️⃣ Import Database

Open phpMyAdmin

Create database: food_rescue_network

Import /sql/food_rescue_network.sql

### 4️⃣ Configure Database Connection

Edit config/db.php

$host = "localhost";
$user = "root";
$password = "";  // default for XAMPP
$dbname = "food_rescue_network";

### 5️⃣ Run the Project

Open browser and visit:

http://localhost/Food-Rescue-Network-System/

## 🔑 Sample Login Credentials
Role	Email	Password
Admin	admin@gmail.com
	admin123
Donor	donor@gmail.com
	donor123
Charity	charity@gmail.com
	charity123

(You can change credentials in database after import)

## ✨ Key Features
### 👤 Donor

Donate surplus food

Track donation history

Manage donor profile

### 🏥 Charity/NGO

Request available food

Manage pickups/distribution

Track received donations

### 🛠 Admin

Manage donors and charities

Monitor food distribution

Generate reports and analytics

### 📌 Future Enhancements

Email / SMS notifications

Live location tracking using Maps API

Mobile-friendly interface

Donation analytics dashboard

### 👨‍💻 Developer

Name: Rohan Atole
GitHub: https://github.com/RohanAtole


---

Let me know if you want:

🔥 README with **badges, shields, screenshots, live preview links**  
📘 Project **Documentation / Report in PDF or Word**  
🎓 Convert to **College mini/micro project format**  
🌐 Help you **host it online (000webhost / InfinityFree / Hostinger)**  

I'll do it fast 🚀
