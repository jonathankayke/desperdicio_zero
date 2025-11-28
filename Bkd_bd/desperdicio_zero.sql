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

-- Tabela de usuários
CREATE TABLE tbusuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(150) NOT NULL,
    email_usuario VARCHAR(120) NOT NULL UNIQUE,
    senha_usuario VARCHAR(255) NOT NULL,   -- use password_hash no PHP
    tipo_usuario ENUM('Admin', 'User') DEFAULT 'User',
    foto_usuario
);
 
INSERT INTO usuarios (nome_usuario, email_usuario, senha_usuario, tipo_usuario) VALUES
('Administrador', 'admin@site.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'Admin'),
('Gustavo Henrick', 'gustavo@example.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'User'),
('Maria Silva', 'maria@gmail.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'User');
 

-- Tabela de doações
CREATE TABLE tbdoacoes (
    id_doacao INT AUTO_INCREMENT PRIMARY KEY,
    tipo_alimento VARCHAR(150) NOT NULL,
    quantidade_doacao VARCHAR(50) NOT NULL,
    validade_doacao DATE,
    descricao_doacao TEXT,
    data_doacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 
INSERT INTO doacoes (tipo_alimento, quantidade_doacao, validade_doacao, descricao_doacao)
VALUES
('Arroz', '10 kg', '2025-05-10', 'Pacotes novos, ótima condição'),
('Feijão', '5 kg', '2025-04-22', 'Produto fechado, pronto para uso'),
('Maçãs', '15 unidades', '2025-03-14', 'Frutas frescas'),
('Pão francês', '20 unidades', '2025-02-10', 'Pães feitos hoje'),
('Leite', '6 caixas', '2025-06-01', 'Validade longa');

    -- Estrutura da tabela tbtipos
    CREATE TABLE tbtipos(
        id_tipo INT(11) NOT NULL,
        sigla_tipo VARCHAR(3) NOT NULL,
        rotulo_tipo VARCHAR(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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