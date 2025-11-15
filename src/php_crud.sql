CREATE DATABASE basic_crud CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE basic_crud;
CREATE TABLE tb_user(
    id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;