-- Ti 19
-- Backup Geral do banco de dados desperdicio_zero
-- Excluir o usuário desperdicio_zero caso ele exista
DROP USER IF EXISTS 'desperdicio_zero'@'localhost';

-- Criar o usuário desperdicio_zero se ele não existir
CREATE USER IF NOT EXISTS 'desperdicio_zero'@'localhost'
    IDENTIFIED BY 'desperdicio_zero';
GRANT ALL PRIVILEGES ON *.* TO 'desperdicio_zero'@'localhost'
    WITH GRANT OPTION;
    FLUSH PRIVILEGES;

-- Excluir o banco de dados desperdicio_zero caso ele exista
DROP DATABASE IF EXISTS desperdicio_zero;

-- Criar o banco de dados desperdicio_zero se ele não existir
CREATE DATABASE IF NOT EXISTS desperdicio_zero
    DEFAULT CHARACTER SET utf8
    COLLATE utf8_general_ci;

-- Usamos o banco de dados desperdicio_zero
USE desperdicio_zero;

-- Tabela de doadores
CREATE TABLE doadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    tipo ENUM('Pessoa Física', 'Empresa') NOT NULL,
    cpf_cnpj VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL,
    whatsapp VARCHAR(20),
    endereco VARCHAR(255),
    senha VARCHAR(255) NOT NULL,  -- senha deve ser criptografada no PHP usando password_hash
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 
INSERT INTO doadores (nome, tipo, cpf_cnpj, email, whatsapp, endereco, senha) VALUES
('Mercadinho Bom Preço', 'Empresa', '12.345.678/0001-90', 'contato@bompreco.com', '(11) 95555-1234', 'Rua das Flores, 120 - Centro', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2'),
('Padaria Pão Doce', 'Empresa', '98.765.432/0001-11', 'padaria@paodoce.com', '(11) 97777-8888', 'Av. Principal, 450 - Jardim Alto', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2'),
('João da Silva', 'Pessoa Física', '123.456.789-01', 'joao@gmail.com', '(11) 94444-2222', 'Rua Nova Esperança, 88', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2'),
('Maria Oliveira', 'Pessoa Física', '987.654.321-00', 'maria.oliveira@yahoo.com', '(11) 93333-1111', 'Travessa da Paz, 15', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2');
 

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,   -- use password_hash no PHP
    tipo ENUM('Admin', 'User') DEFAULT 'User'
);
 
INSERT INTO usuarios (nome, email, senha, tipo) VALUES
('Administrador', 'admin@site.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'Admin'),
('Gustavo Henrick', 'gustavo@example.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'User'),
('Maria Silva', 'maria@gmail.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'User');
 

-- Tabela de doações
CREATE TABLE doacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_alimento VARCHAR(150) NOT NULL,
    quantidade VARCHAR(50) NOT NULL,
    validade DATE,
    descricao TEXT,
    data_doacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 
INSERT INTO doacoes (nome_alimento, quantidade, validade, descricao)
VALUES
('Arroz', '10 kg', '2025-05-10', 'Pacotes novos, ótima condição'),
('Feijão', '5 kg', '2025-04-22', 'Produto fechado, pronto para uso'),
('Maçãs', '15 unidades', '2025-03-14', 'Frutas frescas'),
('Pão francês', '20 unidades', '2025-02-10', 'Pães feitos hoje'),
('Leite', '6 caixas', '2025-06-01', 'Validade longa');
 