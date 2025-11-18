-- Ti 19
-- Backup Geral do banco de dados iwanez83_ti19
-- Excluir o usuário iwanez83_ti19 caso ele exista
DROP USER IF EXISTS 'desperdicio_zero'@'localhost';

-- Criar o usuário iwanez83_ti19 se ele não existir
CREATE USER IF NOT EXISTS 'desperdicio_zero'@'localhost'
    IDENTIFIED BY 'desperdicio_zero';
GRANT ALL PRIVILEGES ON *.* TO 'desperdicio_zero'@'localhost'
    WITH GRANT OPTION;
    FLUSH PRIVILEGES;

-- Excluir o banco de dados iwanez83_ti19 caso ele exista
DROP DATABASE IF EXISTS desperdicio_zero;

-- Criar o banco de dados iwanez83_ti19 se ele não existir
CREATE DATABASE IF NOT EXISTS desperdicio_zero
    DEFAULT CHARACTER SET utf8
    COLLATE utf8_general_ci;

-- Usamos o banco de dados iwanez83_ti19
USE desperdicio_zero;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('doador','admin') DEFAULT 'doador'
);

-- Tabela de doações
CREATE TABLE doacoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    nome_doador VARCHAR(100),
    tipo_alimento VARCHAR(100),
    quantidade VARCHAR(50),
    validade DATE,
    endereco VARCHAR(200),
    contato VARCHAR(100),
    status ENUM('disponível','entregue') DEFAULT 'disponível',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);