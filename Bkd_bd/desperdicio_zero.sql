-- --------------------------------------------------------
-- SCRIPT CORRIGIDO - DESPERDICIO ZERO
-- --------------------------------------------------------

-- 1. Configuração de Usuário e Banco
DROP USER IF EXISTS 'desperdicio_zero'@'localhost';
CREATE USER IF NOT EXISTS 'desperdicio_zero'@'localhost' IDENTIFIED BY 'senacti19';
GRANT ALL PRIVILEGES ON *.* TO 'desperdicio_zero'@'localhost' WITH GRANT OPTION;

DROP DATABASE IF EXISTS desperdicio_zero;
CREATE DATABASE IF NOT EXISTS desperdicio_zero DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE desperdicio_zero;

-- --------------------------------------------------------
-- 2. Criação das Tabelas
-- --------------------------------------------------------

-- Tabela de tipos (precisa ser criada antes de doações por causa da chave estrangeira)
CREATE TABLE tbtipos (
    id_tipo INT(11) NOT NULL AUTO_INCREMENT,
    sigla_tipo VARCHAR(3) NOT NULL,
    rotulo_tipo VARCHAR(15) NOT NULL,
    PRIMARY KEY (id_tipo)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Inserção dos tipos
INSERT INTO tbtipos (sigla_tipo, rotulo_tipo) VALUES
    ('F', 'Fruta'),
    ('V', 'Verdura'),
    ('G', 'Grão'),
    ('P', 'Proteína'),
    ('L', 'Laticínio'),
    ('B', 'Bebida'),
    ('C', 'Conserva'),
    ('S', 'Suco'),
    ('O', 'Outros');

-- Tabela de usuários
CREATE TABLE tbusuarios (
    id_usuario INT(11) NOT NULL AUTO_INCREMENT,
    login_usuario VARCHAR(150) NOT NULL,
    nome_usuario VARCHAR(150) NOT NULL,
    email_usuario VARCHAR(120) NOT NULL UNIQUE,
    senha_usuario VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('Admin', 'User') DEFAULT 'User',
    foto_usuario VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabela de doações
CREATE TABLE tbdoacoes (
    id_doacao INT(11) NOT NULL AUTO_INCREMENT,
    id_doacao_tipo INT(11) NOT NULL,
    nome_empresa VARCHAR(150) NOT NULL,
    tipo_instituicao VARCHAR(150) NOT NULL,
    contato_doacao VARCHAR(150) NOT NULL,
    tipo_alimento VARCHAR(150) NOT NULL,
    nome_alimento VARCHAR(150) NOT NULL,
    quantidade_doacao VARCHAR(50) NOT NULL,
    validade_doacao DATE,
    endereco_retirada VARCHAR(150) NOT NULL,
    imagem_doacao VARCHAR(150) NOT NULL,
    PRIMARY KEY (id_doacao),
    KEY id_doacao_tipo_fk (id_doacao_tipo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 3. Inserção de Dados de Teste (Doações)
-- --------------------------------------------------------
INSERT INTO tbdoacoes (id_doacao_tipo, nome_empresa, tipo_instituicao, contato_doacao, tipo_alimento, nome_alimento, quantidade_doacao, validade_doacao, endereco_retirada, imagem_doacao) VALUES 
(1, 'Doação de Frutas', 'ONG Alimenta', '1111-1111', 'F', 'Maçã', '10 kg', '2025-12-15', 'Rua A, 123', 'sem_imagem.jpg'),
(2, 'Doação de Verduras', 'Associação Verde', '2222-2222', 'V', 'Alface', '5 kg', '2025-12-12', 'Rua B, 456', 'sem_imagem.jpg'),
(3, 'Doação de Grãos', 'Banco de Alimentos', '3333-3333', 'G', 'Feijão', '20 kg', '2026-01-05', 'Rua C, 789', 'sem_imagem.jpg'),
(4, 'Doação de Proteína', 'ONG Solidariedade', '4444-4444', 'P', 'Frango', '15 kg', '2025-12-20', 'Rua D, 101', 'sem_imagem.jpg'),
(5, 'Doação de Laticínios', 'Associação Bem', '5555-5555', 'L', 'Leite', '30 litros', '2025-12-18', 'Rua E, 202', 'sem_imagem.jpg'),
(6, 'Doação de Bebidas', 'ONG Hidrate', '6666-6666', 'B', 'Suco de Laranja', '25 litros', '2025-12-22', 'Rua F, 303', 'sem_imagem.jpg'),
(7, 'Doação de Conservas', 'Banco de Alimentos', '3333-3333', 'C', 'Milho enlatado', '50 unidades', '2026-01-10', 'Rua C, 789', 'sem_imagem.jpg');

-- --------------------------------------------------------
-- 4. Chaves Estrangeiras (Constraint)
-- --------------------------------------------------------
ALTER TABLE tbdoacoes
    ADD CONSTRAINT id_doacao_tipo_fk FOREIGN KEY (id_doacao_tipo)
    REFERENCES tbtipos (id_tipo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

-- --------------------------------------------------------
-- 5. Views
-- --------------------------------------------------------
CREATE VIEW vw_doacoes AS
SELECT  d.id_doacao,
        d.nome_empresa,
        d.tipo_instituicao,
        d.nome_alimento,
        d.quantidade_doacao,
        d.validade_doacao,
        d.endereco_retirada,
        d.imagem_doacao,
        t.sigla_tipo,
        t.rotulo_tipo
FROM    tbdoacoes d 
LEFT JOIN tbtipos t ON d.id_doacao_tipo = t.id_tipo;