-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18-Jun-2024 às 03:31
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `compras`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista`
--

DROP TABLE IF EXISTS `lista`;
CREATE TABLE IF NOT EXISTS `lista` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `produto` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `quantidade` int NOT NULL,
  `valor` float NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `categoria` varchar(1) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `lista`
--

INSERT INTO `lista` (`id_produto`, `produto`, `quantidade`, `valor`, `imagem`, `categoria`) VALUES
(29, 'Limão Siciliano', 4, 2, '1718679517_limao.jpeg', '1'),
(30, 'Detergente', 1, 6, '1718680060_baixados.jpeg', '4'),
(31, 'cenoura', 5, 4, '1718680343_1718679416_cenouras.jpg', '5'),
(32, 'Carne', 5, 4, '1718680444_carne.png', '3'),
(34, 'bolinho', 10, 8, '1718681445_doces.png', '2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
