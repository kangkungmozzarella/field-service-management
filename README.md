# Field Service Management (FSM) – Technical Test

## 📌 Overview

This project is a **Field Service Management Dashboard** built with **Laravel 10** and **Livewire** as part of a technical test.

The main goal of this application is to display an aggregated **Work Order Dashboard** that efficiently summarizes operational data at scale.

The focus of this test is **backend logic, database design, and query optimization**, not UI styling.

---

## 🛠 Tech Stack

* **PHP 8.2**
* **Laravel 10**
* **Livewire** (Page Component)
* **MySQL**
* **Laravel Debugbar** (Performance analysis)
* **Vite** (default Laravel setup, not required for core logic)

---

## 🗂 Database Design

The database is structured to support scalable reporting and historical tracking:

* `regions`
* `technicians`
* `work_orders`
* `tickets`
* `ticket_assignments`
* `ticket_logs`
* `work_order_progresses`

### Design Considerations

* Proper indexing for reporting queries
* Separation of progress & log tables for historical data
* Aggregation handled at database level (not PHP loops)
* Designed to scale with large datasets (10,000+ records)

---

## 📊 Dashboard Logic

The dashboard data is generated using:

* **Query Object pattern** (`app/Queries/WorkOrderDashboardQuery.php`)
* SQL aggregations: `COUNT`, `SUM`, `DISTINCT`
* Subquery to fetch the **latest work order status**
* Pagination to handle large datasets efficiently

### Output Columns

* Work Code
* Region
* Last Status
* Total Tickets
* Open Tickets
* Total Progress Records
* Total Assigned Technicians

This approach ensures:

* No N+1 query issues
* Minimal query count
* High performance on large datasets
* Clean separation of concerns

---

## 🐞 Debug & Performance

Laravel Debugbar is used to analyze performance on the dashboard page.

Key observations:

* Total queries are kept minimal
* The heaviest query is the dashboard aggregation query
* Execution time is acceptable even with large datasets
* Optimization is achieved through indexed columns and SQL-level aggregation

A screenshot of Debugbar (showing total queries, execution time, and the heaviest query) is provided as part of the technical test submission.

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

## 📝 Notes

* UI is intentionally kept minimal to emphasize backend logic.
* Asset bundling (Vite) is intentionally not required, as the focus of this test is backend logic and query performance.
* The project structure is designed to be easily extensible.

---

## ✅ Conclusion

This project demonstrates:

* Strong understanding of Laravel architecture
* Efficient SQL and data aggregation
* Scalable backend design
* Performance awareness and optimization
* Clean and maintainable code structure

Thank you for reviewing this technical test.
