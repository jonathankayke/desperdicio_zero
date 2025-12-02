-- Criar tabela tbtipos primeiro
CREATE TABLE IF NOT EXISTS tbtipos (
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

-- Agora sim criar tbdoacoes
CREATE TABLE IF NOT EXISTS tbdoacoes (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Inserir dados
INSERT INTO tbdoacoes (
    nome_doacao,
    tipo_instituicao,
    endereco_empresa,
    contato_doacao,
    cpf_cnpj_doacao,
    email_doacao,
    tipo_alimento,
    nome_alimento,
    quantidade_doacao,
    validade_doacao,
    endereco_retirada,
    imagem_doacao,
    id_tipo
) VALUES
('Doação de Frutas', 'ONG Alimenta', 'Rua A, 123', '1111-1111', '12345678901', 'contato@ongalimenta.com', 'F', 'Maçã', '10 kg', '2025-12-15', 'Rua A, 123', 'maca.jpg', 1),
('Doação de Verduras', 'Associação Verde', 'Rua B, 456', '2222-2222', '98765432100', 'verde@associacao.com', 'V', 'Alface', '5 kg', '2025-12-12', 'Rua B, 456', 'alface.jpg', 2),
('Doação de Grãos', 'Banco de Alimentos', 'Rua C, 789', '3333-3333', '11223344556', 'contato@bancoalimentos.com', 'G', 'Feijão', '20 kg', '2026-01-05', 'Rua C, 789', 'feijao.jpg', 3);

-- Criar a view
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