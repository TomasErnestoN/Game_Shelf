-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/04/2026 às 11:52
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco_jogadao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela de login da administração';

--
-- Despejando dados para a tabela `admin`
--

INSERT INTO `admin` (`id`, `nome`, `senha`, `email`) VALUES
(8, 'Tomas', '$2y$10$CYZkzfYk.3NYIJDxaw9V0uB7XMwYQ6Uhmh.dIpTd8JbwJvBAOoJ4O', 'Tomas@gmail.com'),
(9, 'Kaio', '$2y$10$uJfA/eqIC9RZ9UyT8wxXi.YQSjwjmkUjNO8T.qGLmnufEOEQ96Zzy', 'Kaio@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos`
--

CREATE TABLE `jogos` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `preço` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `categoria1` varchar(45) NOT NULL,
  `categoria2` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Todos os jogos do site :)';

--
-- Despejando dados para a tabela `jogos`
--

INSERT INTO `jogos` (`id`, `nome`, `descricao`, `preço`, `imagem`, `trailer`, `categoria1`, `categoria2`) VALUES
(2, 'Cuphead', 'Cuphead é um aclamado jogo indie de ação \"run and gun\" (correr e atirar) e plataformas 2D, focado em intensas batalhas de chefes. Com estilo artístico único inspirado nos desenhos animados dos anos 1930, apresenta visuais feitos à mão e trilha sonora de jazz. A jogabilidade é conhecida pela dificuldade elevada e punitiva, exigindo paciência e memorização.', 36.99, 'jogo_69e81d7b65b3d.png', 'https://youtu.be/NN-9SQXoi50?si=MIZ_o3NNCvQ8Wv4a', '2D', 'Ação'),
(3, 'Super Mario World', 'Super Mario World (1990) é um aclamado jogo de plataforma 2D para SNES, onde Mario e Luigi exploram a \"Terra dos Dinossauros\" para salvar a Princesa Peach e os Yoshis de Bowser. Introduziu o dinossauro Yoshi, a capa que permite voar e um mapa interativo com 96 saídas, sendo um marco na precisão de controles e level design.', 149.99, 'jogo_69e81cbd7f46b.png', 'https://youtu.be/oWyMk-2aH9E?si=WDqMDXP8aGDgqw4O', '2D', 'Ação'),
(4, 'Brawl Stars', 'Brawl Stars é um jogo de tiro multiplayer 3v3 e battle royale rápido, desenvolvido pela Supercell para dispositivos móveis. Lançado em 2018, oferece partidas de menos de três minutos em diversos modos. Os jogadores escolhem personagens (\"Brawlers\") com habilidades únicas, ataques especiais (Super), gadgets e Star Powers para competir em arenas.', 0.00, 'jogo_69e813a3442ab.png', 'https://youtu.be/CaryjOdYFa0?si=LqVyhr0X8uLhmIRz', 'Online', 'Ação'),
(5, 'Pokémon Heart Gold', 'Pokémon HeartGold é um remake aprimorado para Nintendo DS (lançado em 2009) dos clássicos Gold/Silver, situado nas regiões de Johto e Kanto. O jogador assume o papel de um treinador que explora o mundo, captura Pokémon, obtém 8 insígnias e enfrenta a Elite 4, com o lendário Ho-Oh como destaque da capa.', 2399.99, 'jogo_69e81d51d1364.png', 'https://youtu.be/M3zpC6Zfqh8?si=xBR2pSMvw3NeK8Pp', 'Simulação', '2D'),
(6, 'Doom Eternal', 'DOOM Eternal é um jogo de tiro em primeira pessoa (FPS) frenético e violento, desenvolvido pela id Software. É a sequência direta de DOOM (2016), onde o Doom Slayer retorna para salvar a Terra de uma invasão demoníaca, explorando diversos mundos com jogabilidade rápida, vertical e cheia de ação.', 149.99, 'jogo_69e81dcabb04a.png', 'https://youtu.be/7TJ061KOpp4?si=mOvweth4S2DxQqf7', 'FPS', 'Ação'),
(7, 'Persona 5 Royal', 'Persona 5 Royal é a versão definitiva do aclamado JRPG, apresentando uma narrativa expandida sobre estudantes de Tóquio que agem como \"Phantom Thieves\" para mudar corações corruptos.', 249.99, 'jogo_69e8169038332.png', 'https://youtu.be/SKpSpvFCZRw?si=f_TmBfHIeVb3TUFr', 'RPG', ''),
(8, 'Rayman Origins', 'Rayman Origins é um aclamado jogo de plataforma 2D de rolagem lateral, lançado pela Ubisoft em 2011, que marca o retorno da série às suas raízes com um estilo artístico vibrante desenhado à mão.', 59.99, 'jogo_69e81808854c1.png', 'https://youtu.be/PevoXzPJSJ4?si=5_-H8pxCZPhX4tf0', '2D', ''),
(9, 'Castle Crashers', 'Castle Crashers é um jogo de ação e aventura 2D estilo beat \'em up com elementos de RPG, desenvolvido pela The Behemoth. Até quatro amigos podem jogar cooperativamente, localmente ou online, para resgatar princesas, defender o reino e invadir castelos. O jogo é conhecido pelo seu humor, arte desenhada à mão e jogabilidade frenética.', 24.99, 'jogo_69e818f091d5a.png', 'https://youtu.be/_JcmxKOC4R0?si=4pqiJ4uK463kRgAX', '2D', 'Ação'),
(10, 'Left 4 Dead 2', 'Left 4 Dead 2 (L4D2) é um jogo de tiro em primeira pessoa cooperativo de survival horror, desenvolvido pela Valve, lançado em 2009. Focado na ação multiplayer, quatro sobreviventes tentam escapar de um apocalipse zumbi no sul dos EUA, enfrentando hordas intensas e infectados especiais usando armas de fogo e corpo a corpo. ', 32.99, 'jogo_69e819aace613.png', 'https://youtu.be/fVtbLVPgGH4?si=alClcAK7fX_kmIcX', 'FPS', 'Terror'),
(11, 'Minecraft', 'Minecraft é um popular jogo sandbox de sobrevivência e construção 3D, famoso por seu mundo infinito composto por blocos. Os jogadores exploram, mineram recursos, criam ferramentas e constroem estruturas livremente, enfrentando criaturas noturnas no modo Sobrevivência ou criando sem limites no modo Criativo.', 99.99, 'jogo_69e81a1437cb4.jpg', 'https://youtu.be/MmB9b5njVbA?si=7CPktA0O5weZ8MH1', 'Sobrevivência', 'Simulação');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
