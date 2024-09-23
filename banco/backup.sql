-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
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
CREATE DATABASE IF NOT EXISTS `db_jornal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_jornal`;

-- Copiando estrutura para tabela db_jornal.tb_jornal
CREATE TABLE IF NOT EXISTS `tb_jornal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `desc` varchar(300) NOT NULL,
  `img` varchar(150) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  `conteudo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_jornal.tb_jornal: ~10 rows (aproximadamente)
INSERT INTO `tb_jornal` (`id`, `titulo`, `desc`, `img`, `data_cad`, `conteudo`) VALUES
	(31, 'Nova vacina contra a gripe é aprovada', 'A vacina foi aprovada após testes rigorosos.', '', '2024-09-23 08:56:11', 'Uma nova vacina contra a gripe foi aprovada pelas autoridades de saúde após uma série de testes rigorosos que demonstraram sua eficácia e segurança. Espera-se que ela reduza significativamente os casos de gripe nesta temporada.'),
	(32, 'Mudanças climáticas afetam a agricultura', 'Estudo revela impactos severos nas colheitas.', '', '2024-09-23 08:56:11', 'Um novo estudo revela que as mudanças climáticas estão afetando gravemente a agricultura, resultando em colheitas menores e maior insegurança alimentar em diversas regiões do mundo. Os agricultores estão sendo incentivados a adotar práticas mais sustentáveis.'),
	(33, 'Tecnologia 5G chega às grandes cidades', 'A implementação da tecnologia avança rapidamente.', '', '2024-09-23 08:56:11', 'A tecnologia 5G finalmente chegou às grandes cidades, prometendo velocidades de internet muito mais rápidas e melhor conectividade. Isso pode revolucionar diversos setores, desde a saúde até a educação.'),
	(34, 'Lançamento do novo smartphone da marca X', 'O modelo promete recursos inovadores.', '', '2024-09-23 08:56:11', 'A marca X lançou seu novo smartphone, que promete recursos inovadores como câmera de alta resolução e bateria de longa duração. Os entusiastas da tecnologia aguardam ansiosamente as análises.'),
	(35, 'Reforma da previdência é aprovada no Congresso', 'A nova legislação visa melhorar a sustentabilidade do sistema.', '', '2024-09-23 08:56:11', 'Após intensos debates, a reforma da previdência foi aprovada no Congresso. O objetivo é garantir a sustentabilidade do sistema a longo prazo, embora a medida tenha gerado controvérsias entre a população.'),
	(36, 'Festival de música atrai milhares de fãs', 'O evento contou com grandes artistas nacionais.', '', '2024-09-23 08:56:11', 'O festival de música realizado no último fim de semana atraiu milhares de fãs, com performances de grandes artistas nacionais. O evento foi um sucesso e ajudou a movimentar a economia local.'),
	(37, 'Estudo revela benefícios da meditação', 'A prática pode reduzir níveis de estresse.', '', '2024-09-23 08:56:11', 'Um estudo recente mostra que a meditação pode ajudar a reduzir os níveis de estresse e ansiedade, melhorando a saúde mental e o bem-estar geral. Especialistas recomendam a prática regular.'),
	(38, 'Nova política de sustentabilidade é lançada', 'Iniciativa busca reduzir a pegada de carbono.', '', '2024-09-23 08:56:11', 'Uma nova política de sustentabilidade foi lançada por uma grande empresa, com o objetivo de reduzir sua pegada de carbono e promover práticas ecológicas. Essa iniciativa é um passo importante para um futuro mais sustentável.'),
	(39, 'Crescimento do e-commerce em tempos de pandemia', 'Setor se destaca e inovações surgem.', '', '2024-09-23 08:56:11', 'O e-commerce experimentou um crescimento significativo durante a pandemia, com muitas empresas se adaptando às novas demandas do mercado. Inovações tecnológicas também têm surgido para melhorar a experiência do consumidor.'),
	(40, 'Mudanças nas regras de trânsito entram em vigor', 'Nova legislação visa aumentar a segurança.', '', '2024-09-23 08:56:11', 'As novas regras de trânsito, que visam aumentar a segurança nas ruas, entram em vigor esta semana. As mudanças incluem penalidades mais severas para infrações graves e novas sinalizações nas estradas.');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
