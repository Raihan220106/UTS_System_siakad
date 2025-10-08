
-- ------------------------------------------------------------
-- SIAKAD (Sistem Informasi Akademik) - MySQL Schema
-- Target: MySQL 8.x / MariaDB 10.4+ (adjust ENUMs if needed)
-- Charset/Collation: utf8mb4
-- ------------------------------------------------------------

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;

-- Create database (optional). Uncomment if you want to create it.
-- CREATE DATABASE IF NOT EXISTS siakad CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE siakad;

-- ------------------------------------------------------------
-- Core / Auth
-- ------------------------------------------------------------
CREATE TABLE roles (
  id          BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  name        VARCHAR(50) NOT NULL UNIQUE, -- admin, dosen, mahasiswa
  description VARCHAR(200) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE users (
  id             BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  name           VARCHAR(100) NOT NULL,
  email          VARCHAR(150) NOT NULL UNIQUE,
  password_hash  VARCHAR(255) NOT NULL, -- store bcrypt/argon2 hash
  role_id        BIGINT UNSIGNED NOT NULL,
  status         ENUM('active','inactive','suspended') NOT NULL DEFAULT 'active',
  last_login_at  DATETIME NULL,
  created_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_users_role FOREIGN KEY (role_id) REFERENCES roles(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: remember-me tokens if you enable the checkbox flow
CREATE TABLE auth_tokens (
  id           BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  user_id      BIGINT UNSIGNED NOT NULL,
  selector     CHAR(24) NOT NULL UNIQUE,
  validator    CHAR(64) NOT NULL, -- store as SHA-256 hex of random token
  expires_at   DATETIME NOT NULL,
  created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_auth_tokens_user FOREIGN KEY (user_id) REFERENCES users(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  INDEX (user_id),
  INDEX (expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Master Data
-- ------------------------------------------------------------
CREATE TABLE faculties (
  id     BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  code   VARCHAR(10) NOT NULL UNIQUE,
  name   VARCHAR(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE programs (
  id          BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  faculty_id  BIGINT UNSIGNED NOT NULL,
  code        VARCHAR(10) NOT NULL,
  name        VARCHAR(150) NOT NULL,
  degree      ENUM('D3','D4','S1','S2','S3') NOT NULL DEFAULT 'S1',
  UNIQUE KEY uq_program (faculty_id, code),
  CONSTRAINT fk_program_faculty FOREIGN KEY (faculty_id) REFERENCES faculties(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE rooms (
  id        BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  code      VARCHAR(20) NOT NULL UNIQUE,
  name      VARCHAR(100) NOT NULL,
  building  VARCHAR(100) NULL,
  capacity  INT UNSIGNED NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE academic_years (
  id          BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  year_start  SMALLINT NOT NULL, -- e.g., 2025
  year_end    SMALLINT NOT NULL, -- e.g., 2026
  label       VARCHAR(30) NOT NULL, -- e.g., 2025/2026
  is_active   TINYINT(1) NOT NULL DEFAULT 0,
  UNIQUE KEY uq_academic_year (year_start, year_end)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- People
-- ------------------------------------------------------------
CREATE TABLE lecturers (
  id           BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  user_id      BIGINT UNSIGNED NOT NULL,
  nidn         VARCHAR(30) NOT NULL UNIQUE,
  full_name    VARCHAR(120) NOT NULL,
  phone        VARCHAR(30) NULL,
  created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_lecturer_user FOREIGN KEY (user_id) REFERENCES users(id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE students (
  id           BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  user_id      BIGINT UNSIGNED NOT NULL,
  npm          VARCHAR(30) NOT NULL UNIQUE, -- student number
  full_name    VARCHAR(120) NOT NULL,
  gender       ENUM('M','F') NULL,
  birth_place  VARCHAR(100) NULL,
  birth_date   DATE NULL,
  address      VARCHAR(255) NULL,
  phone        VARCHAR(30) NULL,
  program_id   BIGINT UNSIGNED NOT NULL,
  angkatan     SMALLINT NOT NULL, -- cohort year
  status       ENUM('active','leave','graduated','dropout') NOT NULL DEFAULT 'active',
  created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_student_user FOREIGN KEY (user_id) REFERENCES users(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_student_program FOREIGN KEY (program_id) REFERENCES programs(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Curriculum
-- ------------------------------------------------------------
CREATE TABLE courses (
  id            BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  program_id    BIGINT UNSIGNED NOT NULL,
  code          VARCHAR(20) NOT NULL,
  name          VARCHAR(150) NOT NULL,
  sks           TINYINT UNSIGNED NOT NULL, -- credits
  semester_plan TINYINT UNSIGNED NULL,     -- recommended semester number
  UNIQUE KEY uq_course_code (program_id, code),
  CONSTRAINT fk_course_program FOREIGN KEY (program_id) REFERENCES programs(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE class_groups (
  id               BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  course_id        BIGINT UNSIGNED NOT NULL,
  lecturer_id      BIGINT UNSIGNED NOT NULL,
  academic_year_id BIGINT UNSIGNED NOT NULL,
  semester         ENUM('Ganjil','Genap','Pendek') NOT NULL,
  class_code       VARCHAR(10) NOT NULL, -- e.g., A, B, C
  capacity         INT UNSIGNED NULL,
  room_id          BIGINT UNSIGNED NULL,
  UNIQUE KEY uq_class (course_id, lecturer_id, academic_year_id, semester, class_code),
  CONSTRAINT fk_class_course   FOREIGN KEY (course_id) REFERENCES courses(id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_class_lecturer FOREIGN KEY (lecturer_id) REFERENCES lecturers(id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_class_ay       FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_class_room     FOREIGN KEY (room_id) REFERENCES rooms(id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE schedules (
  id              BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  class_group_id  BIGINT UNSIGNED NOT NULL,
  day_of_week     TINYINT UNSIGNED NOT NULL, -- 1=Mon ... 7=Sun
  start_time      TIME NOT NULL,
  end_time        TIME NOT NULL,
  CONSTRAINT fk_schedule_class FOREIGN KEY (class_group_id) REFERENCES class_groups(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  INDEX (class_group_id, day_of_week, start_time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- KRS / Enrollment & Grades
-- ------------------------------------------------------------
CREATE TABLE enrollments (
  id             BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  student_id     BIGINT UNSIGNED NOT NULL,
  class_group_id BIGINT UNSIGNED NOT NULL,
  enrolled_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status         ENUM('enrolled','dropped','completed') NOT NULL DEFAULT 'enrolled',
  UNIQUE KEY uq_enrollment (student_id, class_group_id),
  CONSTRAINT fk_enroll_student FOREIGN KEY (student_id) REFERENCES students(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_enroll_class   FOREIGN KEY (class_group_id) REFERENCES class_groups(id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE grades (
  id              BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  enrollment_id   BIGINT UNSIGNED NOT NULL,
  grade_letter    ENUM('A','AB','B','BC','C','D','E','T') NULL,
  grade_point     DECIMAL(3,2) NULL, -- e.g., 4.00, 3.50
  score_numeric   DECIMAL(5,2) NULL, -- raw numeric score (optional)
  graded_at       DATETIME NULL,
  CONSTRAINT fk_grade_enrollment FOREIGN KEY (enrollment_id) REFERENCES enrollments(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  UNIQUE KEY uq_grade_enrollment (enrollment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Announcements (Pengumuman)
-- ------------------------------------------------------------
CREATE TABLE announcements (
  id            BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  title         VARCHAR(200) NOT NULL,
  body          TEXT NOT NULL,
  audience      ENUM('all','students','lecturers') NOT NULL DEFAULT 'all',
  published_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_by    BIGINT UNSIGNED NULL,  -- Boleh NULL agar ON DELETE SET NULL jalan
  CONSTRAINT fk_announce_user
    FOREIGN KEY (created_by) REFERENCES users(id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Convenience Views
-- ------------------------------------------------------------
CREATE OR REPLACE VIEW v_khs AS
SELECT
  s.id            AS student_id,
  s.npm,
  s.full_name     AS student_name,
  ay.label        AS tahun_akademik,
  cg.semester,
  c.code          AS kode_mk,
  c.name          AS nama_mk,
  c.sks,
  g.grade_letter,
  g.grade_point
FROM students s
JOIN enrollments e      ON e.student_id = s.id
JOIN class_groups cg    ON cg.id = e.class_group_id
JOIN courses c          ON c.id = cg.course_id
JOIN academic_years ay  ON ay.id = cg.academic_year_id
LEFT JOIN grades g      ON g.enrollment_id = e.id;

-- ------------------------------------------------------------
-- Seed (optional)
-- NOTE: Replace password_hash values with real bcrypt/argon2 hashes!
-- ------------------------------------------------------------
INSERT INTO roles (name, description) VALUES
('admin', 'Administrator system'),
('dosen', 'Tenaga pengajar'),
('mahasiswa', 'Mahasiswa');

-- Example admin user (password hash must be a real hash value)
INSERT INTO users (name, email, password_hash, role_id, status)
VALUES ('Administrator', 'admin@example.com', '$2y$10$REPLACE_WITH_BCRYPT_HASH', 1, 'active');

-- Example faculty & program
INSERT INTO faculties (code, name) VALUES ('FT', 'Fakultas Teknik');
INSERT INTO programs (faculty_id, code, name, degree) VALUES (1, 'TI', 'Teknik Informatika', 'S1');

-- Example academic year
INSERT INTO academic_years (year_start, year_end, label, is_active) VALUES (2025, 2026, '2025/2026', 1);

-- Example lecturer & student (link to users)
INSERT INTO users (name, email, password_hash, role_id) VALUES
('Budi Dosen', 'budi.dosen@univ.ac.id', '$2y$10$REPLACE_WITH_BCRYPT_HASH', 2),
('Ani Mahasiswa', 'ani.mahasiswa@univ.ac.id', '$2y$10$REPLACE_WITH_BCRYPT_HASH', 3);

INSERT INTO lecturers (user_id, nidn, full_name, phone) VALUES (LAST_INSERT_ID()-1, '1234567890', 'Budi Dosen', '081234567890');
INSERT INTO students (user_id, npm, full_name, gender, program_id, angkatan, status)
VALUES (LAST_INSERT_ID(), '202512345', 'Ani Mahasiswa', 'F', 1, 2025, 'active');

-- Example course, class, schedule, enrollment, grade
INSERT INTO courses (program_id, code, name, sks, semester_plan) VALUES (1, 'IF101', 'Pemrograman Dasar', 3, 1);
INSERT INTO rooms (code, name, capacity, building) VALUES ('R101', 'Ruang 101', 40, 'Gedung A');
INSERT INTO class_groups (course_id, lecturer_id, academic_year_id, semester, class_code, capacity, room_id)
VALUES (1, 1, 1, 'Ganjil', 'A', 40, 1);
INSERT INTO schedules (class_group_id, day_of_week, start_time, end_time) VALUES (1, 2, '09:00:00', '10:40:00'); -- 2=Tue

-- Ani takes IF101-A
INSERT INTO enrollments (student_id, class_group_id) VALUES (1, 1);
INSERT INTO grades (enrollment_id, grade_letter, grade_point, score_numeric, graded_at)
VALUES (1, 'A', 4.00, 92.50, NOW());

SET foreign_key_checks = 1;
