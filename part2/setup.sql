-- run this in phpmyadmin (SQL tab) to set up the database for the contact form

CREATE DATABASE IF NOT EXISTS comp4621
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE comp4621;

DROP TABLE IF EXISTS contacts;

-- using MyISAM because InnoDB kept giving me error #1932 on xampp
CREATE TABLE contacts (
    id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name         VARCHAR(100) NOT NULL,
    email        VARCHAR(150) NOT NULL,
    subject      VARCHAR(150) NOT NULL,
    message      TEXT         NOT NULL,
    submitted_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=MyISAM;
