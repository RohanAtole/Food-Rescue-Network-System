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

```
Food Rescue Network System/
└── code files/
    ├── admin/
    │   ├── adminlogin.php
    │   ├── admin_dash.php
    │   ├── alldonor.php
    │   ├── allcharity.php
    │   ├── reports.php
    │   └── assets/
    │       ├── css/
    │       ├── images/
    │       └── vendor/
    │
    ├── donor/
    │   ├── donorlogin.php
    │   ├── donor_dashboard.php
    │   ├── donate_food.php
    │   └── donor_profile.php
    │
    ├── charity/
    │   ├── charitylogin.php
    │   ├── charity_dashboard.php
    │   ├── request_food.php
    │   └── charity_profile.php
    │
    ├── includes/
    │   ├── header.php
    │   ├── footer.php
    │   ├── navbar.php
    │   └── session.php
    │
    ├── config/
    │   └── db.php
    │
    ├── assets/
    │   ├── css/
    │   ├── js/
    │   └── images/
    │
    ├── sql/
    │   └── food_rescue_network.sql
    │
    └── index.php
```
---

## 🧪 Testing Guidelines

| Module | Test Scenario | Expected Result |
|--------|---------------|------------------|
| Donor | Submit donation form | Data stored & confirmation shown |
| Charity | Request food | Request saved & visible to admin |
| Admin | Approve donor/charity | Status updated correctly |
| Login | Wrong password | Shows error message |

---

## ⚙️ Installation Guide

### 1️⃣ Clone the repository

```bash
git clone https://github.com/RohanAtole/Food-Rescue-Network-System.git
```
---
### 📂 2️⃣ Move the Folder to Server Directory
| Environment | Location |
|-------------|----------|
| XAMPP | `htdocs/` |
| WAMP | `www/` |
| LAMP | `/var/www/html/` |

---

### 🗄️ 3️⃣ Import Database

1️⃣ Open **phpMyAdmin**  
2️⃣ Create a new database named: `food_rescue_network`  
3️⃣ Click **Import** → Select `sql/food_rescue_network.sql` → Click **Go**

---

### 🔧 4️⃣ Configure Database Connection  
Edit the file: `config/db.php`

```php
$host = "localhost";
$user = "root";
$password = "";     // Default for XAMPP
$dbname = "food";
```
---
### 🌐 5️⃣ Run the Project

Once the project files are placed correctly and the database is configured:

🖥️ Open your browser and enter the following URL:
```
http://localhost/Food-Rescue-Network-System/
```
---
## ✨ Key Features
---
### 👤 Donor Module
- ✔ Donate surplus food  
- ✔ Track donation history  
- ✔ Manage donor profile  

---

### 🏥 Charity / NGO Module
- ✔ Request available food  
- ✔ Manage pickups and distribution  
- ✔ Track received donations  

---

### 🛠️ Admin Panel
- ✔ Manage donors and charities  
- ✔ Monitor food distribution  
- ✔ Generate reports and analytics  

---

## 🚀 Future Enhancements
- 🟢 Email / SMS notifications  
- 🟢 Live pickup location tracking (Google Maps API)  
- 🟢 Admin analytics dashboard  
- 🟢 Mobile-friendly responsive UI  

---

## 📬 Contact

📛 **Developer:** Rohan Atole  
📧 **Email:** atolerohan2003@gmail.com  
🌐 **GitHub:** [RohanAtole](https://github.com/RohanAtole)  
📍 **Location:** Maharashtra, India  

---

⭐ *If you like this project, please give it a star on GitHub!*



---

Let me know if you want:

🔥 README with **badges, shields, screenshots, live preview links**  
📘 Project **Documentation / Report in PDF or Word**  
🎓 Convert to **College mini/micro project format**  
🌐 Help you **host it online (000webhost / InfinityFree / Hostinger)**  

I'll do it fast 🚀
