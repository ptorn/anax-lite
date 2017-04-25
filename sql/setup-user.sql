--
-- Anax-Lite SQL
-- Av: peto16, Peder Tornberg
--
SET NAMES 'utf8';
CREATE DATABASE IF NOT EXISTS peto16;
USE peto16;

DROP TABLE IF EXISTS anaxlite_users;
CREATE TABLE anaxlite_users
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
    anaxlite_users(username, password, email, firstname, lastname, administrator, enabled)
VALUES
    ('admin', '$2y$10$vaqfYKE2TfIzo7EQMxd8fOg3AvnPBZPTtV4l98aN4Ep6TkmjA2/Cm', 'admin@example.com', 'Peder', 'Tornberg', True, True),
    ('doe', '$2y$10$dYBys9cIIKEsdtQoiIiELOVkuRbcyfMZt7L8Pinw7JHDpZEol7UN6', 'user@example.com', 'John', 'Doe', False, True),
    ('bob', '$2y$10$bV/btm035m/Hv87RYB04JuTFN7opVra1zlBcvdKJHxTzBISmQeHSy', 'bob@example.com', 'Bob', 'Builder', False, False),
    ('disabled', '$2y$10$bV/btm035m/Hv87RYB04JuTFN7opVra1zlBcvdKJHxTzBISmQeHSy', 'disabled@example.com', 'Pink', 'Panther', False, False);
