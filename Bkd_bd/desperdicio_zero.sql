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

-- Estrutura da tabela DOACOES
DROP TABLE IF EXISTS tbDoacoes;

