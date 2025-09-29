# Multi-Tenant Flat & Bill Management System

A Laravel-based system to manage **buildings, flats, tenants, and bills** with **multi-tenant isolation**.  
- **Admin (Super Admin):** Manage house owners & tenants.  
- **House Owners:** Manage their own building, flats, and bills.  
- **Tenants:** Assigned by Admin to a flat.  

---

## 🚀 Tech Stack
- **Backend:** Laravel (latest stable version)  
- **Frontend:** Bootstrap 
- **Database:** MySQL 

---

## ⚙️ Setup Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/dawoodulislam/multi-tenant-flat-bill-system.git
   cd multi-tenant-bill-system
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` and update your credentials:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database in `.env`:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=multi_tenant_system
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Run migrations & seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

---

## 🌍 URLs List
- **Panel Login:** [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/login)  
- **Dashboard:** [http://127.0.0.1:8000/owner](http://127.0.0.1:8000/dashboard)  
- **House Owner List:** [http://127.0.0.1:8000/owner](http://127.0.0.1:8000/admin/houseowners)
- **Building List:** [http://127.0.0.1:8000/owner](http://127.0.0.1:8000/admin/houseowners)
- **Tenants List:** [http://127.0.0.1:8000/owner](http://127.0.0.1:8000/admin/tenants) 
- **Flats List:** [http://127.0.0.1:8000/owner](http://127.0.0.1:8000/owner/flats) 
- **Bills List:** [http://127.0.0.1:8000/owner](http://127.0.0.1:8000/owner/bills) 

---

## User Credentials
- Super Admin
- - Email: admin@example.com
- - Password: password

- House Owner
- - Email: owner1@example.com
- - Password: password

## 📧 Email Configuration
Update `.env` with your email testing credentials (e.g., **Mailtrap**):

Emails are sent when:  
- A new bill is created.  
- A bill is paid.  

---

## 🏢 Multi-Tenant Implementation
- **Tenant Identification:** Column-based (House Owner ID).  
- **Data Isolation:** Enforced at query & middleware level.  
- **Access Control:** Owners can only access their own building, flats, and bills.  

---

## 📂 Database Setup
- Run `php artisan migrate --seed` to create tables and insert sample data.  
- SQL dump file is included: `multi_tenant_system.sql`.  

---

## 📌 Notes
- UI kept minimal (forms, tables).  
- Queries optimized for performance.  
- Clean, maintainable code structure.  
- Fully functional email notifications.  

---

👨‍💻 **Developed for multi-tenant building & bill management using Laravel.**
