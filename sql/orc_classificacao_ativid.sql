-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 23/02/2012 às 02h45min
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `sistema_elfi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `orc_classificacao_ativid`
--

CREATE TABLE IF NOT EXISTS `orc_classificacao_ativid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classificacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `orc_classificacao_ativid`
--

INSERT INTO `orc_classificacao_ativid` (`id`, `classificacao`, `quantidade`) VALUES
(	2	,'	tester	',	0 ),
(	3	,'	HIPOT	',	0 ),
(	4	,'	Transformador	',	0 ),
(	5	,'	Disjuntor	',	0 ),
(	6	,'	Iluminação	',	0 ),
(	7	,'	SPDA	',	0 ),
(	8	,'	Termovisão	',	0 ),
(	9	,'	Aterramento	',	0 ),
(	10	,'	Gerador	',	0 ),
(	11	,'	Banco de Capacitores	',	0 ),
(	12	,'	Fornecimento	',	0 ),
(	13	,'	Insdustrial	',	0 ),
(	14	,'	Equipamento Subestação	',	0 ),
(	15	,'	Relé	',	0 ),
(	16	,'	Balanceamento Cargas	',	0 ),
(	17	,'	Equipamentos Elétricos	',	0 ),
(	18	,'	Subestação	',	0 ),
(	19	,'	Podagem	',	0 ),
(	20	,'	Plantonista	',	0 ),
(	21	,'	Rede Aérea	',	0 );



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
