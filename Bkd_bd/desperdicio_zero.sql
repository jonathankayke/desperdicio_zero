-- Ti 19 
-- Backup Geral do banco de dados desperdicio_zero 
-- Excluir o usuário desperdicio_zero caso ele exista 
DROP USER IF EXISTS 'desperdicio_zero'@'localhost';

-- Criar o usuário desperdicio_zero se ele não existir 
CREATE USER IF NOT EXISTS 'desperdicio_zero'@'localhost' 
    IDENTIFIED BY 'senacti19';
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
    id_usuario INT NOT NULL,
    nome_usuario VARCHAR(150) NOT NULL,
    email_usuario VARCHAR(120) NOT NULL UNIQUE,
    senha_usuario VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('Admin', 'User') DEFAULT 'User',
    foto_usuario VARCHAR(255) NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabela de tbdoações 
CREATE TABLE tbdoacoes (
    id_doacao INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_doacao_tipo INT (11) NOT NULL,
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
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO
    tbdoacoes (id_doacao_tipo,nome_doacao,tipo_instituicao,endereco_empresa,contato_doacao,cpf_cnpj_doacao,email_doacao,tipo_alimento,nome_alimento,quantidade_doacao,validade_doacao,endereco_retirada,imagem_doacao) VALUES
    (1,'Doação de Frutas','ONG Alimenta','Rua A, 123','1111-1111','12345678901','contato@ongalimenta.com','F','Maçã','10 kg','2025-12-15','Rua A, 123','maca.jpg'),
    (2,'Doação de Verduras','Associação Verde','Rua B, 456','2222-2222','98765432100','verde@associacao.com','V','Alface','5 kg','2025-12-12','Rua B, 456','alface.jpg'),
    (3,'Doação de Grãos','Banco de Alimentos','Rua C, 789','3333-3333','11223344556','contato@bancoalimentos.com','G', 'Feijão','20 kg','2026-01-05','Rua C, 789','feijao.jpg'),
    (4,'Doação de Proteína','ONG Solidariedade','Rua D, 101','4444-4444','55443322110','solidariedade@ong.com','P','Frango','15 kg','2025-12-20','Rua D, 101','frango.jpg'),
    (5,'Doação de Laticínios','Associação Bem','Rua E, 202','5555-5555','66778899001','bem@associacao.com','L','Leite','30 litros','2025-12-18','Rua E, 202','leite.jpg'),
    (6,'Doação de Bebidas','ONG Hidrate','Rua F, 303','6666-6666','99887766554','hidrate@ong.com','B','Suco de Laranja','25 litros','2025-12-22','Rua F, 303','suco.jpg'),
    (7,'Doação de Conservas','Banco de Alimentos','Rua C, 789','3333-3333','11223344556','contato@bancoalimentos.com','C','Milho enlatado','50 unidades','2026-01-10','Rua C, 789','milho.jpg');

-- Estrutura da tabela tbtipos    
CREATE TABLE tbtipos (
    id_tipo INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sigla_tipo VARCHAR(3) NOT NULL,
    rotulo_tipo VARCHAR(15) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO
    tbtipos (sigla_tipo, rotulo_tipo)
VALUES
    ('F', 'Fruta'),
    ('V', 'Verdura'),
    ('G', 'Grão'),
    ('P', 'Proteína'),
    ('L', 'Laticínio'),
    ('B', 'Bebida'),
    ('C', 'Conserva'),
    ('S', 'Suco'),
    ('O', 'Outros');


-- ------ CHAVES ------
ALTER TABLE tbdoacoes
    ADD KEY id_doacao_tipo_fk(id_doacao_tipo);

-- Chaves da tabela tbusuarios
ALTER TABLE tbusuarios
    ADD PRIMARY KEY (id_usuario),
    ADD UNIQUE KEY email_usuario_uniq(email_usuario);

-- ----- AUTO INCREMENTS -----
ALTER TABLE tbdoacoes
    MODIFY id_doacao INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;


-- ------ CHAVES ESTRANGEIRAS / LIMITADORES ------

ALTER TABLE tbdoacoes
    ADD CONSTRAINT id_doacao_tipo_fk FOREIGN KEY(id_doacao_tipo)
    REFERENCES tbtipos(id_tipo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;


-- -------- VIEW -------- -- Criando a view vw_tbdoacoes 
CREATE VIEW vw_doacoes AS
SELECT  d.id_doacao,
        d.nome_doacao,
        d.nome_alimento,
        d.quantidade_doacao,
        d.validade_doacao,
        d.endereco_retirada,
        d.imagem_doacao,
        t.sigla_tipo,
        t.rotulo_tipo
FROM    tbdoacoes d LEFT JOIN tbtipos t ON d.id_doacao_tipo = t.id_tipo;