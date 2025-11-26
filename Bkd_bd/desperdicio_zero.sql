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
    id_doador INT AUTO_INCREMENT PRIMARY KEY,
    nome_doador VARCHAR(150) NOT NULL,
    tipo_doador ENUM('Pessoa Física', 'Empresa') NOT NULL,
    cpf_cnpj VARCHAR(20) NOT NULL UNIQUE,
    email_doador VARCHAR(120) NOT NULL,
    whatsapp_doador VARCHAR(20),
    endereco_doador VARCHAR(255),
    senha_doador VARCHAR(255) NOT NULL,  -- senha deve ser criptografada no PHP usando password_hash
    criado_em_doador TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 
INSERT INTO doadores (nome_doador, tipo_doador, cpf_cnpj, email_doador, whatsapp_doador, endereco_doador, senha_doador) VALUES
('Mercadinho Bom Preço', 'Empresa', '12.345.678/0001-90', 'contato@bompreco.com', '(11) 95555-1234', 'Rua das Flores, 120 - Centro', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2'),
('Padaria Pão Doce', 'Empresa', '98.765.432/0001-11', 'padaria@paodoce.com', '(11) 97777-8888', 'Av. Principal, 450 - Jardim Alto', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2'),
('João da Silva', 'Pessoa Física', '123.456.789-01', 'joao@gmail.com', '(11) 94444-2222', 'Rua Nova Esperança, 88', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2'),
('Maria Oliveira', 'Pessoa Física', '987.654.321-00', 'maria.oliveira@yahoo.com', '(11) 93333-1111', 'Travessa da Paz, 15', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2');
 

-- Tabela de usuários
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(150) NOT NULL,
    email_usuario VARCHAR(120) NOT NULL UNIQUE,
    senha_usuario VARCHAR(255) NOT NULL,   -- use password_hash no PHP
    tipo_usuario ENUM('Admin', 'User') DEFAULT 'User'
);
 
INSERT INTO usuarios (nome_usuario, email_usuario, senha_usuario, tipo_usuario) VALUES
('Administrador', 'admin@site.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'Admin'),
('Gustavo Henrick', 'gustavo@example.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'User'),
('Maria Silva', 'maria@gmail.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'User');
 

-- Tabela de doações
CREATE TABLE doacoes (
    id_doacao INT AUTO_INCREMENT PRIMARY KEY,
    nome_alimento VARCHAR(150) NOT NULL,
    quantidade_doacao VARCHAR(50) NOT NULL,
    validade_doacao DATE,
    descricao_doacao TEXT,
    data_doacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 
INSERT INTO doacoes (nome_alimento, quantidade_doacao, validade_doacao, descricao_doacao)
VALUES
('Arroz', '10 kg', '2025-05-10', 'Pacotes novos, ótima condição'),
('Feijão', '5 kg', '2025-04-22', 'Produto fechado, pronto para uso'),
('Maçãs', '15 unidades', '2025-03-14', 'Frutas frescas'),
('Pão francês', '20 unidades', '2025-02-10', 'Pães feitos hoje'),
('Leite', '6 caixas', '2025-06-01', 'Validade longa');
    

 -- -------- VIEW --------
-- Criando a view vw_tbprodutos
CREATE VIEW vw_doacoes as
    SELECT  p.id_doacao,
            p.nome_alimento,
            t.nome_doador,
            t.tipo_doador,
            p.quantidade_doacao,
            p.validade_doacao,
            p.descricao_doacao,
            p.data_doacao,
    FROM    doacoes p JOIN doadores t
    WHERE   p.nome_alimento=t.id_doacao;