# 🎓 UniSched – University Timetable Management System

UniSched is a web-based university timetable management system designed to simplify, automate, and manage academic scheduling efficiently.

The system helps administrators create and manage class schedules while reducing timetable conflicts involving teachers, rooms, courses, sections, and time slots.

---

## 📌 Project Overview

UniSched provides a centralized platform for managing university academic schedules.

It helps reduce the time and effort required for manual timetable preparation and provides students, teachers, and administrators with organized access to timetable information.

---

## ✨ Key Features

### 👨‍💼 Admin

* Secure admin login
* Admin dashboard
* Manage departments
* Manage teachers
* Manage students
* Manage courses
* Manage subjects
* Manage classrooms
* Manage sections
* Manage time slots
* Create and manage timetables
* Detect scheduling conflicts
* Update timetable information

### 👨‍🏫 Teacher

* Secure teacher login
* View personal timetable
* View assigned subjects
* View assigned classes
* View classroom information
* Check teaching schedule

### 👨‍🎓 Student

* Secure student login
* Student dashboard
* View personal timetable
* View class schedules
* View course information
* View classroom and time information

---

## 🧩 Main Modules

* Authentication & Authorization
* Admin Management
* Student Management
* Teacher Management
* Department Management
* Course Management
* Subject Management
* Classroom Management
* Section Management
* Time Slot Management
* Timetable Management
* Conflict Detection
* Schedule Viewing

---

## 🔐 Security

UniSched uses role-based access control to ensure that each user can only access the features and information permitted for their role.

### Security Features

* Secure authentication
* Role-based authorization
* Protected routes
* Input validation
* Secure database operations
* User access control
* Protected administrative functions

---

## 👥 User Roles

| Role    | Main Responsibilities                             |
| ------- | ------------------------------------------------- |
| Admin   | Complete timetable and system management          |
| Teacher | View teaching schedule and assigned classes       |
| Student | View personal class timetable and course schedule |

---

## 🏗️ System Architecture

```text
                    ┌─────────────────────┐
                    │       Users         │
                    │ Admin / Teacher     │
                    │      / Student      │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │      Frontend       │
                    │   Web Interface     │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │      Backend        │
                    │ Application Logic   │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │      Database       │
                    │       MySQL         │
                    └─────────────────────┘
```

---

## 🛠️ Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap

### Backend

* PHP
* Laravel

### Database

* MySQL

### Development Tools

* XAMPP
* Composer
* Git
* GitHub
* Visual Studio Code

---

## 📂 Main Modules

```text
UniSched
│
├── Authentication
├── Admin Management
├── Student Management
├── Teacher Management
├── Department Management
├── Course Management
├── Subject Management
├── Classroom Management
├── Section Management
├── Time Slot Management
├── Timetable Management
└── Conflict Detection
```

---

## 🔄 Timetable Generation Flow

```text
Admin
  │
  ▼
Manage Departments
  │
  ▼
Manage Teachers & Subjects
  │
  ▼
Manage Classrooms & Sections
  │
  ▼
Define Time Slots
  │
  ▼
Create Timetable
  │
  ▼
Check Scheduling Conflicts
  │
  ▼
Final Timetable
  │
  ├──► Student Schedule
  │
  └──► Teacher Schedule
```

---

## ⚠️ Conflict Management

UniSched is designed to reduce common scheduling conflicts such as:

* Teacher assigned to multiple classes at the same time
* Classroom assigned to multiple classes at the same time
* Section assigned to multiple classes at the same time
* Duplicate timetable entries
* Invalid time-slot assignments

---

## 🎯 Project Objectives

* Automate university timetable management
* Reduce manual scheduling work
* Minimize timetable conflicts
* Efficiently manage classrooms and resources
* Provide organized schedules for students and teachers
* Improve academic scheduling efficiency
* Centralize timetable-related information
* Reduce human errors during timetable preparation

---

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/rajmukut791/UniSched.git
```

### 2. Navigate to the Project

```bash
cd UniSched
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Configure Environment

Create a `.env` file:

```bash
cp .env.example .env
```

Configure the database:

```env
DB_DATABASE=unisched
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migration

```bash
php artisan migrate
```

### 7. Start the Application

```bash
php artisan serve
```

---

## 📸 Screenshots

```markdown
![Welcome Page](screenshots/welcome.png)

![Admin Dashboard](screenshots/admin-dashboard.png)

![Student Dashboard](screenshots/student-dashboard.png)

![Teacher Dashboard](screenshots/teacher-dashboard.png)

![Timetable](screenshots/timetable.png)

![Course Management](screenshots/courses.png)
```

---

## 🔮 Future Improvements

* Automatic timetable generation
* Advanced conflict-resolution algorithms
* AI-assisted timetable scheduling
* Drag-and-drop timetable editing
* PDF timetable export
* Excel timetable export
* Email notifications
* Mobile application
* Real-time notifications
* Advanced scheduling analytics

---

## 📚 Academic Project

**Project Name:** UniSched
**Project Type:** University Timetable Management System
**Field:** Computer Science & Engineering

---

## 👨‍💻 Developer

**Raj Mukut**

Computer Science & Engineering
Northern University Bangladesh

### Connect

* GitHub: https://github.com/rajmukut791
* Facebook: https://facebook.com/rajmukut791
* Email: [rajmukut791@gmail.com](mailto:rajmukut791@gmail.com)

---

## 📄 License

This project was developed for academic and educational purposes.

© 2026 Raj Mukut. All Rights Reserved.
