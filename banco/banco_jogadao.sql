-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2026 at 02:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco_jogadao`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela de login da administração';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nome`, `senha`, `email`, `ativo`) VALUES
(8, 'Tomas', '$2y$10$CYZkzfYk.3NYIJDxaw9V0uB7XMwYQ6Uhmh.dIpTd8JbwJvBAOoJ4O', 'Tomas@gmail.com', 1),
(10, 'Alex', '$2y$10$.XkUuxIiG2dxrjezw3c4ruWA1u0mYGfRQ0TfA0vKLskG/XXFhx9h2', 'Alex@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jogos`
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
-- Dumping data for table `jogos`
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
(11, 'Minecraft', 'Minecraft é um popular jogo sandbox de sobrevivência e construção 3D, famoso por seu mundo infinito composto por blocos. Os jogadores exploram, mineram recursos, criam ferramentas e constroem estruturas livremente, enfrentando criaturas noturnas no modo Sobrevivência ou criando sem limites no modo Criativo.', 99.99, 'jogo_69e81a1437cb4.jpg', 'https://youtu.be/MmB9b5njVbA?si=7CPktA0O5weZ8MH1', 'Sobrevivência', 'Simulação'),
(12, 'Hollow Knight', 'Hollow Knight é um aclamado jogo indie de ação-aventura estilo Metroidvania 2D, destacado por sua atmosfera sombria, arte desenhada à mão e combate fluido. O jogador controla um cavaleiro inseto explorando o vasto e arruinado reino subterrâneo de Hallownest, enfrentando chefes desafiadores e descobrindo segredos, com forte foco em exploração, plataforma e backtracking para liberar novas áreas.', 46.99, 'jogo_69e93115d936c.png', 'https://youtu.be/UAO2urG23S4?si=BO-Yj6NwTc_Ys6vo', '2D', 'RPG'),
(13, 'Counter Strike 2', 'O Counter-Strike (CS) é uma das franquias de tiro tático em primeira pessoa (FPS) mais populares e competitivas do mundo, focada em confrontos de equipe baseados em objetivos, como plantar/desarmar bombas.', 0.00, 'jogo_69e955ffaeee8.png', 'https://youtu.be/7UGpvNl_UnE?si=p7VCnpq9k-vgrC4O', 'FPS', 'Online'),
(14, 'Valorant', 'Valorant é um FPS tático 5x5 gratuito da Riot Games, focado em precisão técnica e habilidades únicas de agentes.', 0.00, 'jogo_69e9573d097f1.png', 'https://youtu.be/e_E9W2vsRbQ?si=_wMmWZN_bgVwhcA_', 'FPS', 'Online'),
(121, 'Outer Wilds', 'Outer Wilds é um jogo de exploração espacial e mistério em que o sistema solar vive em loop de 22 minutos eternos. Sem tutorial, o jogador descobre os segredos de uma civilização extinta explorando planetas distintos com fenômenos físicos únicos. Uma obra-prima narrativa.', 74.90, 'jogo_69e968f942b4e.jpg', 'https://youtu.be/d6egPNVNkaQ', '2D', 'Simulação'),
(122, 'Undertale', 'Undertale é um RPG indie revolucionário de Toby Fox. Uma criança cai no Submundo habitado por monstros e pode completar o jogo sem matar ninguém. Com sistema de batalha único, personagens inesquecíveis, múltiplos finais e meta-narrativa brilhante, é um clássico instantâneo.', 19.90, 'jogo_69e968923cae3.png', 'https://youtu.be/SqjY_-beWi0?si=p8zpVvfHaohHSBpj', 'RPG', '2D'),
(123, 'Deltarune', 'Deltarune é o sucessor espiritual de Undertale, também de Toby Fox. Kris e amigos exploram o Dark World em uma aventura mais longa e ambiciosa que expande o universo. Gratuito nos dois primeiros capítulos, com os demais ainda em desenvolvimento pelo criador.', 0.00, 'jogo_69e9686063656.png', 'https://www.youtube.com/watch?v=SqjY_-beWi0', 'RPG', '2D'),
(124, 'Inscryption', 'Inscryption é um deckbuilder roguelite misterioso e perturbador da Devolver Digital. O que começa como um simples jogo de cartas em uma cabana sinistra se transforma em algo completamente diferente e meta. Um dos jogos mais criativos e surpreendentes dos últimos anos.', 44.90, 'jogo_69e96829e86b0.jpg', 'https://www.youtube.com/watch?v=BRlnP67TAf4', 'RPG', ''),
(125, 'Halo Infinite', 'Halo Infinite é o capítulo mais recente da saga Master Chief da 343 Industries. Com campanha de mundo semi-aberto no anel Zeta Halo e multiplayer gratuito renovado, o jogo buscou retornar às raízes do que fez a série ser amada na era do Xbox original.', 149.90, 'jogo_69e968045a198.png', 'https://www.youtube.com/watch?v=CpVm4Mvecbk', 'FPS', 'Online'),
(126, 'Monster Hunter: World', 'Monster Hunter: World revolucionou a série trazendo o gênero para o mainstream mundial. Caçadores exploram ecossistemas vivos, rastreiam e enfrentam monstros colossais coletando materiais para criar equipamentos cada vez mais poderosos. Co-op para 4 e centenas de horas de conteúdo.', 99.90, 'jogo_69e967d2b5975.jpg', 'https://youtu.be/Ro6r15wzp2o?si=Z_151wxP6Qu5oA3g', 'RPG', 'Ação'),
(127, 'Monster Hunter Rise', 'Monster Hunter Rise é a versão portátil e ágil da série, originalmente para Switch. Com o sistema Palamute e Fio de Seda que transformam a movimentação, e a expansão Sunbreak adicionando nova história e monstros, é uma das melhores entradas da franquia.', 149.90, 'jogo_69e9676b3c782.png', 'https://youtu.be/yI8fvL1B50o?si=Np285wnqKu_eU6eq', 'RPG', 'Ação'),
(128, 'Deathloop', 'Deathloop é um FPS de imersão da Arkane Studios onde o assassino Colt está preso em um loop temporal na ilha de Blackreef. Para escapar, ele precisa eliminar oito alvos em um único dia, usando furtividade, poderes sobrenaturais e armas experimentais.', 149.90, 'jogo_69e967415829a.png', 'https://www.youtube.com/watch?v=XOl_9ssjvwc', 'FPS', 'Ação'),
(129, 'Bloodborne', 'Bloodborne é um action RPG da FromSoftware ambientado em Yharnam, uma cidade vitoriana infestada por bestas e horrores lovecraftianos. Com combate mais agressivo que Dark Souls, visual sombrio e atmosfera de pesadelo, é considerado um dos melhores jogos do PlayStation 4.', 99.90, 'jogo_69e9670aa6602.png', 'https://www.youtube.com/watch?v=EU1U5IZBxeo', 'RPG', 'Terror'),
(130, 'Bayonetta 3', 'Bayonetta 3 é o capítulo mais grandioso da bruxa de cabelos mágicos da PlatinumGames. Bayonetta enfrenta um invasor dimensional multiplanar, acumulando versões alternativas de si mesma em batalhas caóticas e espetaculares com novos Demônios Mascarados controláveis.', 299.90, 'jogo_69e966cbd63fa.jpg', 'https://www.youtube.com/watch?v=xPu5UIIjdCQ', 'Ação', ''),
(131, 'Crash Bandicoot 4', 'Crash Bandicoot 4: It\'s About Time é a sequência direta do terceiro jogo da Naughty Dog. Com as Máscaras Quânticas que permitem manipular o mundo, fases longas e desafiadoras e a adição de Coco e outros personagens, é o mais ambicioso da franquia.', 149.90, 'jogo_69e9669b57b9f.jpg', 'https://www.youtube.com/watch?v=oBbS4qzLSH8', '2D', 'Ação'),
(132, 'Sonic Frontiers', 'Sonic Frontiers levou o ouriço azul ao seu primeiro mundo aberto, as Ilhas Starfall. Com combate expandido, plataformas verticais e uma narrativa surpreendentemente emocional sobre amizade e sacrifício, foi aclamado como o melhor Sonic 3D em muitos anos.', 199.90, 'jogo_69e966628fcb7.png', 'https://www.youtube.com/watch?v=vx2THi542j8', 'Ação', ''),
(133, 'Starfield', 'Starfield é o RPG espacial da Bethesda Game Studios, o primeiro novo universo da empresa em 25 anos. Em 2330, o jogador explora mais de 1.000 planetas, comanda naves espaciais e se une a facções em uma galáxia repleta de histórias e segredos a descobrir.', 199.90, 'jogo_69e9663ebfaf3.png', 'https://www.youtube.com/watch?v=TY1HlqizUBs', 'RPG', 'FPS'),
(134, 'Path of Exile 2', 'Path of Exile 2 é o sucessor do aclamado ARPG gratuito da Grinding Gear Games. Com seis novas classes, campanha completa separada, sistema de gemas reestruturado e visual moderno, é a nova referência do gênero hack-and-slash para jogadores que buscam profundidade extrema.', 129.99, 'jogo_69e96619b3a5e.jpg', 'https://www.youtube.com/watch?v=DSLL8IIDkWY', 'RPG', 'Online'),
(135, 'Assassin\'s Creed Shadows', 'Assassin\'s Creed Shadows é o capítulo mais aguardado da série da Ubisoft, ambientado no Japão feudal. Com dois protagonistas — a shinobi Naoe e o samurai africano Yasuke — o jogo alterna entre furtividade e combate aberto em um Japão deslumbrante recriado com riqueza de detalhes.', 299.90, 'jogo_69e965adc7e2b.png', 'https://www.youtube.com/watch?v=296gfUiuyhs', 'Ação', ''),
(136, 'Indiana Jones: Great Circle', 'Indiana Jones and the Great Circle é uma aventura em primeira pessoa da MachineGames. O icônico arqueólogo investiga uma conspira ligando os maiores monumentos do mundo em 1937. Com combate criativo usando o ambiente, puzzles e exploração, é a melhor adaptação do personagem em games.', 249.90, 'jogo_69e9658778850.png', 'https://www.youtube.com/watch?v=jK0Kfd4mRhg', '2D', 'Ação'),
(137, 'Metaphor: ReFantazio', 'Metaphor: ReFantazio é o novo RPG do diretor de Persona da Atlus. Em um reino de fantasia com eleições, magia e monstros, o jovem herói busca quebrar uma maldição real. Com o DNA de Persona aplicado a um mundo completamente original, é considerado o melhor RPG de 2024.', 249.90, 'jogo_69e964eba70d0.png', 'https://www.youtube.com/watch?v=SjbgJaYi4NE', 'RPG', ''),
(138, 'Silent Hill 2 Remake', 'Silent Hill 2 Remake é a reimaginação do clássico terror psicológico de 2001 pela Bloober Team. James Sunderland retorna a Silent Hill após receber uma carta da esposa morta. Com gráficos modernos, câmera na terceira pessoa e respeito ao material original, surpreendeu positivamente.', 249.90, 'jogo_69e9642a2eff1.png', 'https://www.youtube.com/watch?v=CMvrMTmuJuA&rco=1', 'Terror', ''),
(139, 'Prince of Persia: Lost Crown', 'Prince of Persia: The Lost Crown é um metroidvania 2D da Ubisoft com o guerreiro imortal Sargon. Com habilidades de manipulação temporal, combate fluido e level design de alta qualidade, trouxe de volta a série de forma surpreendente e foi um dos melhores lançamentos do início de 2024.', 149.90, 'jogo_69e95f36444df.png', 'https://www.youtube.com/watch?v=MmX7a_e65uU', '2D', 'Ação');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
