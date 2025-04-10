CREATE DATABASE cleaning_service;

USE cleaning_service;

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  carpet_or_duvet VARCHAR(50),
  size VARCHAR(50),
  type_of_carpet VARCHAR(100),
  name VARCHAR(100),
  email VARCHAR(100),
  phone1 VARCHAR(20),
  phone2 VARCHAR(20),
  size_number FLOAT,
  status ENUM('Open', 'In-Progress', 'Completed') DEFAULT 'Open'
);


INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES (NULL, '', ''), ('Admin', 'admin', 'admin@123')