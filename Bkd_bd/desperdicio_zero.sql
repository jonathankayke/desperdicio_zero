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
 