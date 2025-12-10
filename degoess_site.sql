SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `degoess_site` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `degoess_site`;

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `orcamento_id` int(11) NOT NULL,
  `mensagem` text DEFAULT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contatos` (`id`, `nome`, `email`, `servico_id`, `orcamento_id`, `mensagem`, `data_envio`) VALUES
(1, 'Paulo', 'paulopontalaranja@gmail.com', 7, 2, 'Teste', '2025-10-28 14:10:44');

CREATE TABLE `orcamentos` (
  `id` int(11) NOT NULL,
  `faixa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orcamentos` (`id`, `faixa`) VALUES
(4, 'Acima de R$ 10.000'),
(1, 'Até R$ 1.000'),
(2, 'R$ 1.000 – R$ 5.000'),
(3, 'R$ 5.000 – R$ 10.000');

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `servicos` (`id`, `nome`) VALUES
(6, 'Apresentação Comercial'),
(5, 'Automação (n8n/IA)'),
(1, 'Branding'),
(7, 'Consultoria'),
(2, 'Criação de Site/Landing'),
(4, 'Gestão de Redes Sociais'),
(3, 'Tráfego Pago (Google/Meta)');


ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servico_id` (`servico_id`),
  ADD KEY `orcamento_id` (`orcamento_id`);

ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_orcamentos_faixa` (`faixa`);

ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_servicos_nome` (`nome`);


ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `orcamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `contatos`
  ADD CONSTRAINT `contatos_ibfk_1` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contatos_ibfk_2` FOREIGN KEY (`orcamento_id`) REFERENCES `orcamentos` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
