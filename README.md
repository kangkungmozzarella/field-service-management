# Field Service Management (FSM) – Technical Test

## 📌 Overview

This project is a **Field Service Management Dashboard** built with **Laravel 10** and **Livewire** as part of a technical test.

The main goal of this application is to display an aggregated **Work Order Dashboard** that efficiently summarizes:

* Work Orders
* Regions
* Tickets & Open Tickets
* Latest Work Order Status
* Progress history
* Assigned Technicians

The focus of this test is **backend logic, database design, and query optimization**, not UI styling.

---

## 🛠 Tech Stack

* **PHP 8.2**
* **Laravel 10**
* **Livewire** (Page Component)
* **MySQL**
* **Vite** (default Laravel setup)

---

## 🗂 Database Design

The database is structured to support scalable reporting:

* `regions`
* `technicians`
* `work_orders`
* `tickets`
* `ticket_assignments`
* `ticket_logs`
* `work_order_progresses`

Key design considerations:

* Proper indexing for reporting queries
* Separation of progress & log tables for historical tracking
* Aggregation handled at database level (not PHP loops)

---

## 📊 Dashboard Logic

The dashboard data is generated using:

* **Query Object pattern** (`app/Queries/WorkOrderDashboardQuery.php`)
* SQL aggregations: `COUNT`, `SUM`, `DISTINCT`
* Subquery to fetch **latest work order status**
* Pagination for large datasets (tested with 10,000+ records)

This ensures:

* No N+1 query problems
* High performance on large datasets
* Clean separation of concerns

---

## 🚀 How to Run the Project

### 1️⃣ Clone Repository

```bash
git clone <repository-url>
cd fsm
```

### 2️⃣ Install PHP Dependencies

```bash
composer install
```

### 3️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update database credentials in `.env`.

### 4️⃣ Run Migrations & Seeders

```bash
php artisan migrate --seed
```

### 5️⃣ Start Application

```bash
php artisan serve
```

Access dashboard:

```
http://127.0.0.1:8000/dashboard
```

---

## 🧪 Sample Output

The dashboard displays:

* Work Code
* Region
* Last Status
* Total Tickets
* Open Tickets
* Total Progress Records
* Total Technicians

Pagination is enabled to handle large volumes of data efficiently.

---

## 📝 Notes

* UI is intentionally kept minimal to emphasize backend logic.
* Asset bundling (Vite) is not required for the core functionality of this test.
* The project structure is designed to be easily extensible.

---

## ✅ Conclusion

This project demonstrates:

* Strong understanding of Laravel architecture
* Efficient SQL and data aggregation
* Scalable backend design
* Clean and maintainable code structure

Thank you for reviewing this technical test.
