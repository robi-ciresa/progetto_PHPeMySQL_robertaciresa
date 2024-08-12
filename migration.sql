CREATE DATABASE IF NOT EXISTS orizon;

USE orizon;

CREATE TABLE IF NOT EXISTS paesi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS viaggi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    posti_disponibili INT NOT NULL
);

CREATE TABLE IF NOT EXISTS viaggio_paese (
    viaggio_id INT,
    paese_id INT,
    PRIMARY KEY (viaggio_id, paese_id),
    FOREIGN KEY (viaggio_id) REFERENCES viaggi(id) ON DELETE CASCADE,
    FOREIGN KEY (paese_id) REFERENCES paesi(id) ON DELETE CASCADE
);
