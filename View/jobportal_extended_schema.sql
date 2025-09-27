-- Extended schema for Job Portal (adds jobs, applications, resumes, profiles, interviews, notifications)
USE jobportal;

-- Add approved column to users if not exists
ALTER TABLE users ADD COLUMN IF NOT EXISTS approved TINYINT(1) DEFAULT 0;

CREATE TABLE IF NOT EXISTS jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  employer_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  company VARCHAR(255) DEFAULT NULL,
  location VARCHAR(255) DEFAULT NULL,
  category VARCHAR(100) DEFAULT NULL,
  description TEXT,
  requirements TEXT,
  salary VARCHAR(100) DEFAULT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status ENUM('open','closed') DEFAULT 'open',
  FOREIGN KEY (employer_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  job_id INT NOT NULL,
  applicant_id INT NOT NULL,
  resume_path VARCHAR(255) DEFAULT NULL,
  cover_letter TEXT,
  status ENUM('applied','shortlisted','interview','offered','rejected') DEFAULT 'applied',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
  FOREIGN KEY (applicant_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS resumes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  filename VARCHAR(255),
  filepath VARCHAR(255),
  uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS profiles (
  user_id INT PRIMARY KEY,
  full_name VARCHAR(255),
  phone VARCHAR(50),
  summary TEXT,
  skills TEXT,
  education TEXT,
  experience TEXT,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS interviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  employer_id INT NOT NULL,
  scheduled_at DATETIME NOT NULL,
  location VARCHAR(255),
  status ENUM('scheduled','completed','cancelled') DEFAULT 'scheduled',
  notes TEXT,
  FOREIGN KEY (application_id) REFERENCES applications(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(255),
  body TEXT,
  is_read TINYINT(1) DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
