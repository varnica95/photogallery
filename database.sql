CREATE DATABASE gallery;
USE gallery;

CREATE TABLE users
(
    id         INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL,
    username   VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL,
    password   VARCHAR(100) NOT NULL,

    PRIMARY KEY (id)
);