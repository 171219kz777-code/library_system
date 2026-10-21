CREATE DATABASE IF NOT EXISTS library CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE library;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('user','admin') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE genres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL UNIQUE
);

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  author VARCHAR(150) NOT NULL,
  genre_id INT NOT NULL,
  year SMALLINT,
  description TEXT,
  cover VARCHAR(255),
  copies INT NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (genre_id) REFERENCES genres(id)
);

CREATE TABLE loans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  loan_date DATE NOT NULL,
  due_date DATE NOT NULL,
  return_date DATE NULL,
  status ENUM('active','returned') NOT NULL DEFAULT 'active',
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

-- Бастапқы деректер
INSERT INTO genres (name) VALUES ('Роман'),('Поэзия'),('Ғылыми'),('Тарих'),('Балаларға'),('Бағдарламалау');

INSERT INTO books (title, author, genre_id, year, description, copies) VALUES
('Абай жолы','Мұхтар Әуезов',1,1942,'Абай Құнанбайұлының өмірін бейнелейтін эпопея.',3),
('Көшпенділер','Ілияс Есенберлин',4,1976,'Қазақ хандығының құрылуы туралы тарихи роман.',2),
('Қан мен тер','Әбдіжәміл Нұрпейісов',1,1970,'Арал теңізі жағасындағы өмір туралы.',2),
('Ұйқыдағы қыз','Ғабит Мүсірепов',1,1957,'Қазақ әдебиетінің классикалық шығармасы.',1),
('PHP және MySQL','Лук Веллинг',6,2015,'PHP мен MySQL бойынша оқулық.',2),
('Алгоритмдер','Т. Кормен',3,2009,'Алгоритмдерге кіріспе.',1);

-- Админ: admin@library.kz / admin123 (кіргеннен кейін парольді өзгерт!)
INSERT INTO users (name, email, password_hash, role) VALUES
('Әкімші','admin@library.kz','$2y$10$lMR.yBbzZGfEKBT6tMbhv.FHvfFA/0dszGZH5uUFKAx5I/80Ny.n2','admin');
