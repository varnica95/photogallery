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

CREATE TABLE galleries
(
    id          INT NOT NULL AUTO_INCREMENT,
    user_id     INT NOT NULL,
    title       VARCHAR(100) NOT NULL,
    description LONGTEXT DEFAULT NULL,
    image       LONGTEXT DEFAULT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES gallery.users(id) ON DELETE CASCADE
);

CREATE TABLE images
(
    id          INT NOT NULL AUTO_INCREMENT,
    gallery_id     INT NOT NULL,
    title       VARCHAR(100) NOT NULL,
    image       LONGTEXT DEFAULT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (gallery_id) REFERENCES gallery.galleries(id) ON DELETE CASCADE
);