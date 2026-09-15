-- Estrutura do banco de dados do Pulcherrima.
-- Rode este arquivo uma vez no seu MySQL/MariaDB antes de usar o site
-- (ex: `mysql -u root -p < schema.sql`).

CREATE DATABASE IF NOT EXISTS pulcherrima_bd CHARACTER SET utf8mb4;
USE pulcherrima_bd;

CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(150) NOT NULL,
    data_nascimento DATE NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    senha_cripto VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
