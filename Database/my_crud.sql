-- ============================================
-- Banco de dados: my_crud
-- Tema: Loja de Eletrônicos
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

-- ============================================
-- Tabela de usuários
-- ============================================
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id`        int(11)      NOT NULL AUTO_INCREMENT,
  `nome`      varchar(100) NOT NULL,
  `email`     varchar(100) NOT NULL,
  `senha`     varchar(255) NOT NULL,
  `criado_em` timestamp    NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Tabela de produtos (eletrônicos)
-- ============================================
CREATE TABLE IF NOT EXISTS `produtos` (
  `id`          int(11)      NOT NULL AUTO_INCREMENT,
  `nome`        varchar(100) NOT NULL,
  `categoria`   varchar(50)  DEFAULT NULL,
  `marca`       varchar(50)  DEFAULT NULL,
  `quantidade`  int(11)      DEFAULT 0,
  `preco`       decimal(10,2) DEFAULT NULL,
  `descricao`   text         DEFAULT NULL,
  `usuario_id`  int(11)      DEFAULT NULL,
  `criado_em`   timestamp    NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;
