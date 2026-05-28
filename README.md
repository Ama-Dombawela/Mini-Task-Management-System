# Mini Task Management System

Simple task manager built for the web developer Intern Practical Test.

---

## Requirements

- PHP 7.4+ with mysqli extension
- MySQL 5.7+ (or MariaDB)
- XAMPP or WAMP (or any local Apache/PHP server)
- Bootstrap is included locally in the `assets/` folder (no internet needed)

---

## Setup

1. Copy the project folder into your document root:
   - XAMPP (Windows): `C:/xampp/htdocs/Mini_Task_Management_System/`
   - WAMP  (Windows): `C:/wamp64/www/Mini_Task_Management_System/`
   - XAMPP (Mac):     `/Applications/XAMPP/htdocs/Mini_Task_Management_System/`

2. Start **Apache** and **MySQL** from your XAMPP or WAMP control panel.

3. Import the database:

   **Option A — phpMyAdmin:**
   - Open `http://localhost/phpmyadmin`
   - Click **Import**, select `database.sql`, click **Go**

   **Option B — MySQL CLI:**
```sql
   mysql -u root -p < database.sql
```
   > One sample task is already inserted so the table is not empty on first load.

4. Check your database credentials in `includes/db.php`:
   - Host: `localhost`
   - User: `root`
   - Password: *(empty by default in XAMPP/WAMP)*
   - Database: `intern_task_system`

5. Open in your browser:

http://localhost/Mini_Task_Management_System/

6. Use the **search box in the navbar** to search tasks by title.

---

## Folder Structure

---

## Features

- Sticky navbar with search bar and fixed footer
- Responsive layout using Bootstrap 5
- View all tasks in a table, latest first
- Add tasks with title, description, priority, and a cancel button
- Toggle task status between Pending and Completed
- Delete tasks with a confirmation alert
- Search tasks by title from the navbar — results page shows the searched query
- Frontend form validation (empty fields, minimum title length)
- UI loading indicator on form submit and actions
- Priority color badges (High / Medium / Low)
- Status badges (Pending / Completed)

---

## Database

- **Database name:** `intern_task_system`
- **Table:** `tasks`

| Field       | Type                          |
|-------------|-------------------------------|
| id          | INT AUTO_INCREMENT PRIMARY KEY|
| title       | VARCHAR(255) NOT NULL         |
| description | TEXT                          |
| priority    | ENUM('Low','Medium','High')   |
| status      | ENUM('Pending','Completed')   |
| created_at  | TIMESTAMP DEFAULT NOW()       |

---

## Notes

- No internet connection required — Bootstrap is served from the `assets/` folder.
- All database queries use prepared statements to prevent SQL injection.
- Credentials are stored only in `includes/db.php`.