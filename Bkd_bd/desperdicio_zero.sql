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
    senha_usuario VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('Admin', 'User') DEFAULT 'User',
    foto_usuario VARCHAR(255) NULL
);

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
    imagem_doacao VARCHAR(150) NOT NULL,
    id_tipo INT,
    CONSTRAINT fk_tipo FOREIGN KEY (id_tipo) REFERENCES tbtipos(id_tipo)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

 
    -- Estrutura da tabela tbtipos
   CREATE TABLE tbtipos (
    id_tipo INT AUTO_INCREMENT PRIMARY KEY,
    sigla_tipo VARCHAR(3) NOT NULL,
    rotulo_tipo VARCHAR(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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





 -- -------- VIEW --------
-- Criando a view vw_tbdoacoes
CREATE OR REPLACE VIEW vw_doacoes AS
SELECT  
    d.id_doacao,
    d.nome_doacao,
    d.nome_alimento,
    d.quantidade_doacao,
    d.validade_doacao,
    d.endereco_retirada,
    d.imagem_doacao,
    t.sigla_tipo,
    t.rotulo_tipo
FROM tbdoacoes d
LEFT JOIN tbtipos t ON d.id_tipo = t.id_tipo;
