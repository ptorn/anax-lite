--
-- Anax-Lite SQL
-- Av: peto16, Peder Tornberg
--
SET NAMES 'utf8';
CREATE DATABASE IF NOT EXISTS peto16;
USE peto16;

DROP TABLE IF EXISTS Users;
CREATE TABLE Users
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) DEFAULT NULL,
    firstname VARCHAR(40) DEFAULT NULL,
    lastname VARCHAR(40) DEFAULT NULL,
    level INT DEFAULT 1,
    administrator BOOLEAN DEFAULT False,
    enabled BOOLEAN DEFAULT True
);

INSERT INTO
    Users(username, password, email, firstname, lastname, administrator, enabled)
VALUES
    ('admin', '$2y$10$bV/btm035m/Hv87RYB04JuTFN7opVra1zlBcvdKJHxTzBISmQeHSy', 'admin@example.com', 'Peder', 'Tornberg', True, True),
    ('user', '$2y$10$bV/btm035m/Hv87RYB04JuTFN7opVra1zlBcvdKJHxTzBISmQeHSy', 'user@example.com', 'John', 'Doe', False, True),
    ('bob', '$2y$10$bV/btm035m/Hv87RYB04JuTFN7opVra1zlBcvdKJHxTzBISmQeHSy', 'bob@example.com', 'Bob', 'Builder', False, False),
    ('disabled', '$2y$10$bV/btm035m/Hv87RYB04JuTFN7opVra1zlBcvdKJHxTzBISmQeHSy', 'disabled@example.com', 'Pink', 'Panther', False, False);
