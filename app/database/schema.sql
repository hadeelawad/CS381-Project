-- ============================================================
-- schema.sql — YIC IT Support Portal
-- Path: Project_CS381/app/database/schema.sql
-- ============================================================

-- إنشاء قاعدة البيانات
CREATE DATABASE IF NOT EXISTS yic_support;
USE yic_support;

-- ============================================================
-- الجداول
-- ============================================================

-- جدول المستخدمين
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'admin') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول التذاكر
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50),
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    location VARCHAR(100),
    status ENUM('open', 'progress', 'resolved') DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- جدول التعيينات
CREATE TABLE assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    technician_id INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id),
    FOREIGN KEY (technician_id) REFERENCES users(id)
);

-- جدول الردود
CREATE TABLE responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- ============================================================
-- البيانات التجريبية
-- كلمة السر لكل المستخدمين هي: password123
-- ============================================================

-- المستخدمون (3 admins + 10 students)
INSERT INTO users (name, email, password, role) VALUES
('Admin Support',  'admin@yic.edu.sa',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Khalid Rashidi', 'khalid@yic.edu.sa',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Omar Faisal',    'omar@yic.edu.sa',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Hadeel Awad',    'hadeel@yic.edu.sa',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Sara Mohammed',  'sara@yic.edu.sa',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Lina Ahmed',     'lina@yic.edu.sa',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Noura Khalid',   'noura@yic.edu.sa',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Reem Saleh',     'reem@yic.edu.sa',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Maha Tariq',     'maha@yic.edu.sa',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Dana Nasser',    'dana@yic.edu.sa',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Hind Zaid',      'hind@yic.edu.sa',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Abeer Mansour',  'abeer@yic.edu.sa',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Wafa Ibrahim',   'wafa@yic.edu.sa',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student');

-- التذاكر (13 تذكرة)
INSERT INTO tickets (user_id, title, description, category, priority, location, status) VALUES
(4,  'Cannot connect to campus WiFi',        'WiFi not working at all in Building A since this morning.',          'network',  'medium', 'Building A, Room 101',  'open'),
(5,  'Projector not working in Lab 3',       'Orange light blinks but nothing shows on screen.',                   'hardware', 'high',   'Lab 3, Building B',     'progress'),
(6,  'Need access to library system',        'Cannot login to the library portal with my student credentials.',    'account',  'low',    'Library',               'resolved'),
(7,  'Email account not syncing',            'My YIC email stopped receiving messages two days ago.',              'software', 'high',   'Building C',            'progress'),
(8,  'Printer offline in admin office',      'The printer shows offline and will not print anything.',             'hardware', 'low',    'Admin Office',          'open'),
(9,  'Laptop charger broken in room 204',    'The charger in room 204 is damaged and needs replacement.',          'hardware', 'medium', 'Room 204, Building A',  'resolved'),
(10, 'Cannot access student portal',         'Student portal gives error 403 when I try to login.',               'account',  'high',   'Online',                'open'),
(11, 'Software not installed on lab PC',     'AutoCAD is missing from Lab 5 computers.',                          'software', 'medium', 'Lab 5, Building D',     'progress'),
(12, 'Network slow in Building D',           'Internet speed in Building D is extremely slow all week.',           'network',  'low',    'Building D',            'open'),
(13, 'Cannot print assignment',              'Printer in the library keeps showing paper jam error.',              'hardware', 'medium', 'Library, Floor 2',      'resolved'),
(4,  'VPN not connecting',                   'Cannot connect to the college VPN from home.',                      'network',  'high',   'Remote',                'open'),
(5,  'Screen flickering in Lab 2',           'Monitor in Lab 2 keeps flickering every few minutes.',              'hardware', 'medium', 'Lab 2, Building B',     'progress'),
(6,  'Password reset not working',           'The password reset link in my email is expired.',                   'account',  'low',    'Online',                'resolved');

-- التعيينات (10 تعيينات)
INSERT INTO assignments (ticket_id, technician_id) VALUES
(2,  2),
(4,  3),
(6,  2),
(8,  3),
(9,  2),
(10, 3),
(11, 2),
(12, 3),
(13, 2),
(7,  3);

-- الردود (12 رد)
INSERT INTO responses (ticket_id, user_id, message) VALUES
(2,  5, 'The projector has been like this since Monday morning. We have a presentation tomorrow.'),
(2,  2, 'Thank you for reporting this. A technician will visit Lab 3 by tomorrow morning.'),
(2,  5, 'Thank you! Please make it before 10 AM as our presentation starts then.'),
(4,  7, 'My email stopped working completely two days ago, please fix this urgently.'),
(4,  3, 'We have identified the issue with the mail server. It will be resolved within 24 hours.'),
(6,  6, 'I cannot access the library system to submit my assignment.'),
(6,  2, 'Your account has been reactivated. Please try logging in again.'),
(6,  6, 'It works now, thank you very much!'),
(9,  9, 'The charger is completely broken and cannot be used at all.'),
(9,  2, 'A replacement charger has been installed in room 204.'),
(11, 11,'AutoCAD is required for our engineering project and it is missing from all Lab 5 PCs.'),
(11, 2, 'We are installing AutoCAD on all Lab 5 computers. Should be ready by tomorrow.');
