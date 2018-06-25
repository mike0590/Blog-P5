-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 25-Jun-2018 às 01:25
-- Versão do servidor: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'PHP-Cakephp'),
(2, 'PHP-Symfony');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `visitor_username` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `dateT` datetime NOT NULL,
  `posts_id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `waiting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`id`, `visitor_username`, `content`, `dateT`, `posts_id`, `visitor_id`, `waiting`) VALUES
(17, 'Romain', 'Article très intéressant..', '2018-06-22 18:09:02', 1, 2, 0),
(18, 'Mac', 'Bon article..', '2018-06-22 18:11:07', 6, 3, 0),
(19, 'Mac', 'Symfony, c\'est top..', '2018-06-22 18:11:25', 1, 3, 0),
(20, 'Romain', 'On adore tous Symfony', '2018-06-25 00:20:41', 5, 2, 0),
(24, 'Tiago', 'Très bel article', '2018-06-25 01:34:59', 3, 1, 0),
(27, 'Joel', 'J\' aime bien cakePHP, mais je préfère Symfony..', '2018-06-25 02:18:05', 3, 6, 0),
(28, 'Joel', 'On aime tous Symfony', '2018-06-25 02:19:11', 1, 6, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `chapo` longtext NOT NULL,
  `content` longtext NOT NULL,
  `author` varchar(255) NOT NULL,
  `dateT` date NOT NULL,
  `dateUpdate` datetime NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `title`, `chapo`, `content`, `author`, `dateT`, `dateUpdate`, `category_id`) VALUES
(1, 'Symfony, l’open source pour faciliter la vie des développeurs web ', 'Venez découvrir ce merveilleux monde qu\'est Symfony, un framework exceptionnel..', 'Symfony, premier framework professionnel au monde sur PHP, est une réussite française incontestable dans l’Open Source. Grâce à la communauté de développeurs qui contribue au projet, Symfony s’est adapté aux évolutions du Web et est entré de plain-pied dans le Cloud depuis ses dernières versions. Des membres de la core team seront présents au Paris Open Source Summit les 6-7 décembre.</br></br>\r\n\r\nSymfony est le framework professionnel écrit en langage PHP le plus populaire au monde chez les développeurs web. Bâtisseurs des autoroutes de l’information, les développeurs web utilisent Symfony comme socle pour les aider à construire le Web. Grâce à Symfony, pas besoin de réinventer la roue à chaque nouveau projet de développement web en PHP (85% des pages web dans le monde), les développeurs ont à leur disposition une boîte à outils prête à l’emploi.\r\n</br>\r\ntopito', 'Mike Gil', '2018-06-01', '2018-06-25 01:43:34', 2),
(2, 'Présentation du framework Cakephp 2', 'Venez découvrir ce merveilleux monde qu\'est Cakephp, un framework exceptionnel..', 'Introduction</br></br>\r\n\r\nCakephp 2 est un framework Php. La version 2.0.0 est sortie le 17 octobre 2011.\r\nLe produit est encore maintenu mais il est conseillé d\'utiliser Cakephp 3 qui contient plus de fonctionnalités, une nouvelle organisation des classes et des fichiers, une plus longue durée de vie etc ...</br></br>\r\nPourquoi l\'utiliser ?</br></br>\r\n\r\nCakephp 2 est un framework facile à apprendre (en tout cas plus facile que les 3 plus gros framework dominants en France). La documentation est traduite en français. Elle est complète et explique même avec un cas concret (concevoir un blog) comment utiliser le framework. Cakephp2 est outils à la fois souple et puissant. L\'essayer c\'est l\'adopter ;-)</br></br>\r\nVersion 2</br></br>\r\n\r\nLa version actuelle : 2.10.3 (17/07/2017).', 'Mike Gil', '2018-06-02', '2018-06-22 18:02:41', 1),
(3, 'CakePHP : ce framework PHP, c’est du gâteau !', 'Venez découvrir ce merveilleux monde qu\'est Cakephp, un framework exceptionnel..', 'CakePHP, un nom original pour un framework PHP, n’est-ce pas ? Mais terriblement bien choisi ! Cake en anglais, signifie gâteau. Et en effet, ce framework PHP, comparé à d’autres, c’est du gâteau (l’équipe de développement en fait d’ailleurs sa bannière). </br></br>\r\nCakePHP, c’est donc un framework PHP (vous l’aurez compris je pense) relativement simple à prendre en main comparé à certains autres frameworks PHP tels que Zend, Jelix, Prado ou Symfony. En seulement 4 jours, vous pouvez être capable de réaliser une application basique du style blog ou livre d’or. Pour Zend, par exemple, il m’a fallu plusieurs semaines. Et je ne l’utilise plus d’ailleurs …\r\n\r\n', 'Mike Gil', '2018-06-03', '2018-06-22 18:02:45', 1),
(4, 'Développer sous PHP/Symfony : Le profil tendance', 'Venez découvrir ce merveilleux monde qu\'est Symfony, un framework exceptionnel..', 'En France, les ingénieurs maîtrisant les langages PHP & Symfony font partie du top 5 des profils les plus recherchés. Découvrons pourquoi cette connaissance est devenue si importante pour les startups et dans quel domaine de compétences elle est souvent sollicitée…</br></br>\r\n\r\nLe baromètre des tendances de l’emploi et des salaires IT publié par le cabinet de recrutement Computer Futures indique que les développeurs web sous PHP & Symfony sont actuellement très demandés par les startups. Le marché des projets web explose en France. Des dizaines de startups naissent chaque jour et viennent renforcer les demandes de compétences spécifiques dans le secteur numérique.</br>\r\nLes ingénieurs développeurs en Symfony sont rares. Les prétendants sont peu nombreux et compliquent les recherches des recruteurs. De ce fait, le salaire brut annuel peut facilement dépasser la barre des 65 K euros pour un niveau d’expertise de 9 ans ou plus contre 59 K euros pour un développeur JavaScript senior. Vous pouvez également avoir recours à l’offshore en confiant votre projet à des agences de développement spécialisées sur Symfony.', 'Mike Gil', '2018-06-04', '2018-06-22 18:02:48', 2),
(5, 'Objectif de la pépinière Symfony : former plus de 100 personnes par an', 'Venez découvrir ce merveilleux monde qu\'est Symfony, un framework exceptionnel..', 'En collaboration avec WebForce3, SensioLabs, qui, pour information, se présente comme le leader au sein de la communauté Open Source, va fonder la première pépinière Symfony. Ce projet a pour objectif de former aux métiers de développeur-intégrateur Symfony, les personnes inscrites au Pôle emploi. Ce programme soutenu par le Pôle Emploi via son dispositif POEI (Préparation Opérationnelle à l’Emploi Individuelle) qui a déjà commencé, sera organisé en sessions pouvant accueillir entre 12 à 15 bénéficiaires. «Nous estimons à plus de 20 000 le nombre de postes de développeurs vacants en France et c’est très précisément de cette carence dont il est question aujourd’hui», analyse Grégory Pascal, co-fondateur de SensioLabs.</br></br>\r\nLa formation initiale durera 3 mois. Au cours de celle-ci, les candidats devront assister à des cours en présentiel dont le volume représente 399 heures. Par la suite, ils pourront bénéficier de modules de cours en e-learning. Une fois la phase des 3 mois de formations achevée, les élèves embauchés poursuivront une seconde formation d’une durée de 6 mois.', 'Mike Gil', '2018-06-05', '2018-06-22 18:02:51', 2),
(6, 'Pourquoi Cakephp reste si populaire?', 'Venez découvrir ce merveilleux monde qu\'est Cakephp, un framework exceptionnel..', 'Vous êtes développeur PHP et vous développez de nombreuses applications, je suis certain que vous aimerez simplifier les processus de programmation en réduisant le nombre de lignes de code écrit tout en avançant plus vite. Pourquoi réinventer en permanence ? Avec le temps et l’expérience, un développeur finit toujours par se constituer une librairie de code qu’il réutilise pour ces nouveaux projets. Il existe de nombreux frameworks PHP qui mettent de créer des applications web sur des bases techniques solides. Depuis quelques années, j’utilise Cakephp pour mes clients et pourquoi ? La réponse se trouve dans les lignes qui suivent dans le présent article.</br></br>\r\n\r\nCakephp réduit le coût de développement de projet web et aide clairement à écrire moins de ligne de code.  A l’instar des autres librairies PHP, Cakephp est open source et il est plutôt rapide. Il suit strictement le motif de programmation MVC (Modèle Vue Contrôleur) et ORM (Object Relational Mapping).</br></br>\r\n\r\nMaintenu par l’entreprise CAKEDC qui maintient le code, Cakephp est vraiment dynamique : de nouvelles versions sont régulièrement disponibles avec des nouveaux et des résolutions de bugs. On est passé donc en très peu de temps de la branche 1.2.x, à la 1.3.x puis à la branche 2.X.x. De nombreux sites annonçaient sa mort! Que nenni!', 'Olga Pereira', '2018-06-06', '2018-06-25 01:12:47', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Mike', '453064aa52b7f91266f51a9a8a2cbfb7f6bff308'),
(2, 'Olga', '453064aa52b7f91266f51a9a8a2cbfb7f6bff308');

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `visitor`
--

INSERT INTO `visitor` (`id`, `username`, `password`) VALUES
(1, 'Tiago', '453064aa52b7f91266f51a9a8a2cbfb7f6bff308'),
(2, 'Romain', '453064aa52b7f91266f51a9a8a2cbfb7f6bff308'),
(3, 'Mac', '453064aa52b7f91266f51a9a8a2cbfb7f6bff308'),
(4, 'Marc', '453064aa52b7f91266f51a9a8a2cbfb7f6bff308'),
(5, 'Franc', '453064aa52b7f91266f51a9a8a2cbfb7f6bff308'),
(6, 'Joel', '453064aa52b7f91266f51a9a8a2cbfb7f6bff308');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
