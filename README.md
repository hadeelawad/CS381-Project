# YIC IT Support Portal
**CS381 — Web Application Development**  
Yanbu Industrial College | 2025–2026
## Demo Video
[Watch the video on Google Drive](https://drive.google.com/drive/folders/1xgk1jBG3qliVvgD3mY_gwqZMAS5nK9RM?usp=sharing)
---

## Project Description
A web-based IT support ticketing system for Yanbu Industrial College. Students can submit support tickets, track their status, and communicate with the IT team. Admins can manage all tickets, assign technicians, update status, and reply to students.

---

## Login Credentials

| Role    | Email                  | Password     |
|---------|------------------------|--------------|
| Admin   | admin@yic.edu.sa       | password123  |
| Student | sara@yic.edu.sa        | password123  |
| Student | hadeel@yic.edu.sa      | password123  |

---

## Features

### Student
- Register and login
- Submit a support ticket (category, title, description, location, priority)
- View all personal tickets with status
- View ticket detail and conversation thread
- Reply to admin messages

### Admin
- View all tickets from all students
- Assign a technician to a ticket
- Update ticket status (open / in progress / resolved)
- Reply to students

### Security
- Password hashing with `password_hash()`
- PDO prepared statements (SQL injection prevention)
- `htmlspecialchars()` on all output (XSS prevention)
- CSRF tokens on all forms
- Role-based access control on every page
- Session management with `session_destroy()` on logout

---

## Tech Stack
- **Frontend:** HTML5, CSS3, JavaScript (vanilla)
- **Backend:** PHP
- **Database:** MySQL (PDO)
- **Local Server:** Laragon (Apache)

---

## Database
- **Name:** `yic_support`
- **Tables:** users, tickets, assignments, responses

---

## Setup Instructions
1. Install [Laragon](https://laragon.org) and start Apache + MySQL
2. Clone this repository into `C:/laragon/www/webapp/`
3. Open HeidiSQL and run `app/database/schema.sql`
4. Open your browser and go to:
```
http://localhost/Project_CS381/app/login.php
```
5. Login using the credentials above

---

## Project Structure
```
app/
├── login.php
├── logout.php
├── css/
│   └── style.css
├── includes/
│   ├── db.php
│   ├── auth.php
│   └── functions.php
├── database/
│   └── schema.sql
├── student/
│   ├── dashboard.php
│   ├── submit_ticket.php
│   └── ticket_detail.php
└── admin/
    ├── dashboard.php
    └── assign_ticket.php
```

---

## Student
**Hadeel Awad** — Yanbu Industrial College
