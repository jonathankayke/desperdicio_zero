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
 
INSERT INTO tbusuarios (nome_usuario, email_usuario, senha_usuario, tipo_usuario) VALUES
('Administrador', 'admin@site.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'Admin'),
('Gustavo Henrick', 'gustavo@example.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'User'),
('Maria Silva', 'maria@gmail.com', '$2y$10$Z7d71rxeFA2CjqxJcw8oHeHqFQkQJJ0rNWIGQqfYTLsAECA30rFO2', 'User');
 

-- Tabela de tbdoações
CREATE TABLE tbdoacoes (
    id_doacao INT AUTO_INCREMENT PRIMARY KEY,
    nome_doacao VARCHAR(150) NOT NULL,
    tipo_instituicao VARCHAR(150) NOT NULL,
    endereco_empresa VARCHAR(150) NOT NULL,
    contato_doacao VARCHAR(150) NOT NULL,
    cpf_cnpj_doacao VARCHAR(150) NOT NULL,
    email_doacao VARCHAR(150) NOT NULL,
    tipo_alimento VARCHAR(150) NOT NULL,
    nome_alimento VARCHAR(150) NOT NULL,
    quantidade_doacao VARCHAR(50) NOT NULL,
    validade_doacao DATE,
    endereco_retirada VARCHAR(150) NOT NULL,
    imagem_doacao VARCHAR(150) NOT NULL
);
 
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