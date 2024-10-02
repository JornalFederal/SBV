-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           8.3.0 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para db_jornal
CREATE DATABASE IF NOT EXISTS `db_jornal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_jornal`;

-- Copiando estrutura para tabela db_jornal.tb_eventos
CREATE TABLE IF NOT EXISTS `tb_eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `evento` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `data_evento` date NOT NULL DEFAULT '0000-00-00',
  `descricao` text COLLATE utf8mb4_general_ci,
  `data_criacao` timestamp NULL DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_jornal.tb_eventos: 0 rows
/*!40000 ALTER TABLE `tb_eventos` DISABLE KEYS */;
INSERT INTO `tb_eventos` (`id`, `evento`, `data_evento`, `descricao`, `data_criacao`) VALUES
	(1, 'Semana da Tecnologia', '2024-09-22', NULL, '2024-10-01 00:08:30');
/*!40000 ALTER TABLE `tb_eventos` ENABLE KEYS */;

-- Copiando estrutura para tabela db_jornal.tb_jornal
CREATE TABLE IF NOT EXISTS `tb_jornal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `data_cad` date NOT NULL,
  `conteudo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `midia` text COLLATE utf8mb4_general_ci,
  `video_duration` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_jornal.tb_jornal: ~11 rows (aproximadamente)
INSERT INTO `tb_jornal` (`id`, `titulo`, `desc`, `img`, `data_cad`, `conteudo`, `midia`, `video_duration`) VALUES
	(31, 'Nova vacina contra a gripe é aprovada', 'A vacina foi aprovada após testes rigorosos.', '', '2024-09-23', 'Uma nova vacina contra a gripe foi aprovada pelas autoridades de saúde após uma série de testes rigorosos que demonstraram sua eficácia e segurança. Espera-se que ela reduza significativamente os casos de gripe nesta temporada.', NULL, ''),
	(32, 'Mudanças climáticas afetam a agricultura', 'Estudo revela impactos severos nas colheitas.', '', '2024-09-23', 'Um novo estudo revela que as mudanças climáticas estão afetando gravemente a agricultura, resultando em colheitas menores e maior insegurança alimentar em diversas regiões do mundo. Os agricultores estão sendo incentivados a adotar práticas mais sustentáveis.', NULL, ''),
	(33, 'Tecnologia 5G chega às grandes cidades', 'A implementação da tecnologia avança rapidamente.', '', '2024-09-23', 'A tecnologia 5G finalmente chegou às grandes cidades, prometendo velocidades de internet muito mais rápidas e melhor conectividade. Isso pode revolucionar diversos setores, desde a saúde até a educação.', NULL, ''),
	(34, 'Lançamento do novo smartphone da marca X', 'O modelo promete recursos inovadores.', '', '2024-09-23', 'A marca X lançou seu novo smartphone, que promete recursos inovadores como câmera de alta resolução e bateria de longa duração. Os entusiastas da tecnologia aguardam ansiosamente as análises.', NULL, ''),
	(35, 'Reforma da previdência é aprovada no Congresso', 'A nova legislação visa melhorar a sustentabilidade do sistema.', '', '2024-09-23', 'Após intensos debates, a reforma da previdência foi aprovada no Congresso. O objetivo é garantir a sustentabilidade do sistema a longo prazo, embora a medida tenha gerado controvérsias entre a população.', NULL, ''),
	(36, 'Festival de música atrai milhares de fãs', 'O evento contou com grandes artistas nacionais.', '', '2024-09-23', 'O festival de música realizado no último fim de semana atraiu milhares de fãs, com performances de grandes artistas nacionais. O evento foi um sucesso e ajudou a movimentar a economia local.', NULL, ''),
	(37, 'Estudo revela benefícios da meditação', 'A prática pode reduzir níveis de estresse.', '', '2024-09-23', 'Um estudo recente mostra que a meditação pode ajudar a reduzir os níveis de estresse e ansiedade, melhorando a saúde mental e o bem-estar geral. Especialistas recomendam a prática regular.', NULL, ''),
	(38, 'Nova política de sustentabilidade é lançada', 'Iniciativa busca reduzir a pegada de carbono.', '', '2024-09-23', 'Uma nova política de sustentabilidade foi lançada por uma grande empresa, com o objetivo de reduzir sua pegada de carbono e promover práticas ecológicas. Essa iniciativa é um passo importante para um futuro mais sustentável.', NULL, ''),
	(39, 'Crescimento do e-commerce em tempos de pandemia', 'Setor se destaca e inovações surgem.', '', '2024-09-23', 'O e-commerce experimentou um crescimento significativo durante a pandemia, com muitas empresas se adaptando às novas demandas do mercado. Inovações tecnológicas também têm surgido para melhorar a experiência do consumidor.', NULL, ''),
	(40, 'Mudanças nas regras de trânsito entram em vigor', 'Nova legislação visa aumentar a segurança.', '', '2024-09-23', 'As novas regras de trânsito, que visam aumentar a segurança nas ruas, entram em vigor esta semana. As mudanças incluem penalidades mais severas para infrações graves e novas sinalizações nas estradas.', NULL, ''),
	(62, 'Jana flores é a melhor floricultura', 'ela é muito boa', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRj9QWjX5YDx0ySIQHQ7UfwFHL8bcNtLOw6TQ&s', '2024-09-17', 'teste conteudo(depois mudar para nulo ou fazer resumo)', 'https://www.youtube.com/embed/kC3R8s7ApME?si=bIgKM3R5raccDEi-', '1 min');

-- Copiando estrutura para tabela db_jornal.tb_sugestoes
CREATE TABLE IF NOT EXISTS `tb_sugestoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '',
  `sugestao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_envio` datetime NOT NULL DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_jornal.tb_sugestoes: 5 rows
/*!40000 ALTER TABLE `tb_sugestoes` DISABLE KEYS */;
INSERT INTO `tb_sugestoes` (`id`, `nome`, `sugestao`, `data_envio`) VALUES
	(5, 'Joana D\'arc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae elit purus. Nam laoreet, lorem at dignissim aliquam, felis orci mollis sapien, vitae pulvinar ligula diam a risus. Praesent suscipit ante et elit tempus condimentum. Aenean ac nunc id tellus interdum viverra non eget augue. Sed efficitur, felis nec aliquam euismod, urna libero mollis ipsum, ac lobortis velit nibh a mi. Nullam eu rhoncus nibh. Maecenas a tincidunt justo. Morbi massa orci, varius nec quam eget, consequat vehicula dui. Phasellus nibh quam, finibus nec luctus eu, posuere sit amet massa. Mauris sed pulvinar velit. Integer ultricies eu urna nec posuere. Sed gravida justo et turpis placerat auctor. Maecenas ultrices elit eget nibh facilisis, ut luctus sem ornare. Etiam ipsum dui, dictum eu tellus non, egestas gravida lectus.\r\n\r\nEtiam augue nisl, dictum a iaculis sit amet, rutrum accumsan diam. Sed mauris lacus, varius vel volutpat a, tempor vel turpis. Ut et libero pellentesque turpis tempus bibendum non in eros. Phasellus rhoncus ut eros vel sollicitudin. Maecenas sit amet tempor sapien, eget scelerisque magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque dapibus rhoncus tellus id aliquet. Duis id dolor ultricies dolor vestibulum facilisis ac nec justo.', '2024-09-30 20:07:16'),
	(2, 'a', 'b', '2024-09-29 19:50:33'),
	(6, 'Joana D\'arc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae elit purus. Nam laoreet, lorem at dignissim aliquam, felis orci mollis sapien, vitae pulvinar ligula diam a risus. Praesent suscipit ante et elit tempus condimentum. Aenean ac nunc id tellus interdum viverra non eget augue. Sed efficitur, felis nec aliquam euismod, urna libero mollis ipsum, ac lobortis velit nibh a mi. Nullam eu rhoncus nibh. Maecenas a tincidunt justo. Morbi massa orci, varius nec quam eget, consequat vehicula dui. Phasellus nibh quam, finibus nec luctus eu, posuere sit amet massa. Mauris sed pulvinar velit. Integer ultricies eu urna nec posuere. Sed gravida justo et turpis placerat auctor. Maecenas ultrices elit eget nibh facilisis, ut luctus sem ornare. Etiam ipsum dui, dictum eu tellus non, egestas gravida lectus.\r\n\r\nEtiam augue nisl, dictum a iaculis sit amet, rutrum accumsan diam. Sed mauris lacus, varius vel volutpat a, tempor vel turpis. Ut et libero pellentesque turpis tempus bibendum non in eros. Phasellus rhoncus ut eros vel sollicitudin. Maecenas sit amet tempor sapien, eget scelerisque magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque dapibus rhoncus tellus id aliquet. Duis id dolor ultricies dolor vestibulum facilisis ac nec justo.', '2024-09-30 20:07:19'),
	(7, 'Joana D\'arca', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae elit purus. Nam laoreet, lorem at dignissim aliquam, felis orci mollis sapien, vitae pulvinar ligula diam a risus. Praesent suscipit ante et elit tempus condimentum. Aenean ac nunc id tellus interdum viverra non eget augue. Sed efficitur, felis nec aliquam euismod, urna libero mollis ipsum, ac lobortis velit nibh a mi. Nullam eu rhoncus nibh. Maecenas a tincidunt justo. Morbi massa orci, varius nec quam eget, consequat vehicula dui. Phasellus nibh quam, finibus nec luctus eu, posuere sit amet massa. Mauris sed pulvinar velit. Integer ultricies eu urna nec posuere. Sed gravida justo et turpis placerat auctor. Maecenas ultrices elit eget nibh facilisis, ut luctus sem ornare. Etiam ipsum dui, dictum eu tellus non, egestas gravida lectus.\r\n\r\nEtiam augue nisl, dictum a iaculis sit amet, rutrum accumsan diam. Sed mauris lacus, varius vel volutpat a, tempor vel turpis. Ut et libero pellentesque turpis tempus bibendum non in eros. Phasellus rhoncus ut eros vel sollicitudin. Maecenas sit amet tempor sapien, eget scelerisque magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque dapibus rhoncus tellus id aliquet. Duis id dolor ultricies dolor vestibulum facilisis ac nec justo.', '2024-09-30 20:07:34'),
	(8, 'Joana D\'arca2', 'http://localhost/SBV/sugestoes.php', '2024-09-30 20:10:10');
/*!40000 ALTER TABLE `tb_sugestoes` ENABLE KEYS */;

-- Copiando estrutura para tabela db_jornal.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_bin NOT NULL COMMENT 'Armazena a senha criptografada',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Copiando dados para a tabela db_jornal.usuarios: ~0 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `usuario`, `senha`) VALUES
	(1, 'Gabriel', '$2y$10$pUIqMdubMN1u00cKsBN2COHEwHYC3L19s3EhWRWjoiaT.fNRXmBG2'),
	(2, 'admin', '$2y$10$g61reboGdpT/ZzDB4mxUJ.0B.32LlVg.dpf2eBKoq42.p.bZtEWsS');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
