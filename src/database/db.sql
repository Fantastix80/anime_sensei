CREATE DATABASE anime_sensei;
USE anime_sensei;

CREATE TABLE roles(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30)
);

CREATE TABLE users(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(60),
    password CHAR(128),
    id_role INTEGER REFERENCES roles(id)
);

CREATE TABLE tags(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50)
);

CREATE TABLE days(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50)
);

CREATE TABLE animes(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    original_name VARCHAR(50),
    english_name VARCHAR(50),
    description TEXT,
    in_progress BOOLEAN,
    release_day INTEGER REFERENCES days(id),
    release_time TIME,
    image VARCHAR(255)
);

CREATE TABLE animes_tags(
    id_anime INTEGER REFERENCES animes(id),
    id_tag INTEGER REFERENCES tags(id),
    PRIMARY KEY(id_anime, id_tag)
);

CREATE TABLE watchlist(
    id_user INTEGER REFERENCES users(id),
    id_anime INTEGER REFERENCES animes(id),
    date_start_watching DATE,
    date_end_watching DATE,
    note INTEGER,
    opinion TEXT,
    PRIMARY KEY(id_user, id_anime)
);

INSERT INTO roles(name) VALUES
("admin"),
("utilisateur");

INSERT INTO days(name) VALUES
("lundi"),
("mardi"),
("mercredi"),
("jeudi"),
("vendredi"),
("samedi"),
("dimanche");

INSERT INTO tags(name) VALUES
("Action"),
("Aventure"),
("Drame"),
("Fantasy"),
("Historique"),
("Surnaturel"),
("Comédie"),
("Isekai"),
("Romance"),
("School-Life"),
("Jeux"),
("Magie"),
("Réincarnation"),
("Ecchi"),
("Shônen"),
("Animaux"),
("Mystère"),
("Seinen"),
("Harem"),
("Slice-Of-Life"),
("Elfe"),
("Crime"),
("Enquête"),
("Médecine");

INSERT INTO animes(original_name, english_name, description, in_progress, release_day, release_time, image) VALUES
("Kimetsu No Yaiba", "Demon Slayer", "Depuis les temps anciens, il existe des rumeurs concernant des démons mangeurs d'hommes qui se cachent dans les bois. Pour cette raison, les citadins locaux ne s'y aventurent jamais la nuit. La légende raconte aussi qu'un tueur de démons déambule la nuit, chassant ces démons assoiffés de sang. Pour le jeune Tanjirô, ces rumeurs vont bientôt devenir sa dure réalité ...</br></br>Depuis la mort de son père, Tanjirô a pris sur lui pour subvenir aux besoins de sa famille. Malgré cette tragédie, ils réussissent à trouver un peu de bonheur au quotidien.</br></br>Cependant, ce peu de bonheur se retrouve détruit le jour où Tanjirô découvre que sa famille s'est fait massacrer et que la seule survivante, sa sœur Nezuko, est devenue un démon. À sa grande surprise, Nezuko montre encore des signes d'émotion et de pensées humaines. Ainsi, commence la dure tâche de Tanjirô, celle de combatstre les démons et de faire redevenir sa sœur humaine.", 0, NULL, NULL, "demon_slayer.jpg"),
("Solo Leveling", "Only I Level Up", "Dix ans auparavant, des portails ont commencé à apparaître un peu partout dans le monde. Ces portails ont la particularité de connecter le monde à d'autres dimensions, donjons ou mondes parallèles. En même temps, certaines personnes ont développé des capacités afin de pouvoir chasser ces portails. On appelle ceux qui reçoivent un Éveil, des Chasseurs.</br></br>Sung Jin Woo est considéré comme le plus faible des Chasseurs de rang E... Autrement dit le plus faible parmi les faibles. Il est tellement faible qu'il est surnommé par ses confrères, le « Faible ». Avec une équipe de Chasseurs, il se rend dans un donjon de rang D. Malheureusement, l'équipe se retrouve piégée dans une salle avec des monstres qui ne sont pas du tout du niveau du donjon... S'en suit un massacre... Et Sung Jin Woo, aux portes de la mort arrive à acquérir une capacité pour le moins étrange...</br></br>Sung Jin Woo va-t-il réussir à devenir le plus puissant des Chasseurs tout en surmontant les épreuves et conspirations ?", 1, 6, "19:00:00", "solo_levelling.jpg"),
("Tsukimichi Moonlit Fantasy", NULL, "Misumi Makoto, un banal lycéen, se retrouve dans un autre monde après avoir été invoqué par le dieu Tsukuyomi dans le but de devenir un héros. Cependant, une certaine déesse ne semble pas vouloir de Makoto comme héros dans son monde et décide de le propulser dans les confins de celui-ci avec seulement la capacité de comprendre les langues des êtres non-humains. Tsukuyomi va donc intervenir et lui donner une partie de ses pouvoirs. Avant de disparaître, le dieu déclare que Makoto est à présent libre de trouver son propre chemin.</br></br>Désormais libéré de toute contrainte, il va devoir se faire une place dans ce monde totalement inconnu.", 1, 1, "18:15:00", "tsukimichi_moonlit_fantasy.jpe"),
("Akuyaku Reijou Level 99 : Watashi wa Ura-Boss desu ga Maou dewa Arimasen", "Villainess level 99", "Une étudiante japonaise discrète est réincarnée dans le corps d'Eumiella Dolkness, une super méchante cachée de son otome game préféré. Dans ce monde médiéval imaginaire qu'elle croyait connaître par coeur, elle se retrouve en première ligne face à une aristocratie impitoyable qui va tout faire pour la démasquer. Que la partie commence !!!", 1, 2, "18:45:00", "villainess-level-99.jpg"),
("Demon Slave", NULL, "Sur Mato, une cité venue d'une dimension démoniaque, existe un fruit appelé Pêche. Une ressource spéciale qui a la particularité de donner des super-pouvoirs à celles qui les mangent. Ces femmes sont des membres des escadrons antidémons. Le jeune Yûki Wakura se retrouve plongé dans la dimension de Mato. Acculé par une horde de monstres, il est sauvé de justesse par une jeune femme capable de le transformer en une créature surpuissante. Mais l'activation de ce pouvoir comporte une condition : il doit devenir son esclave...", 1, 4, "16:30:00", "demon-slave.jpg"),
("Sokushi Cheat Ga Saikyou Sugite", "My Instant Death Ability Is So Overpowered.jpg", "Yogiri Takatou était en train de dormir dans le bus pendant une sortie scolaire, lorsqu'il se réveilla devant un terrifiant dragon en train d'attaquer le bus. À l'intérieur, il ne restait plus que lui et Tomochika Dannoura, une camarade de classe, et ils se trouvaient à présent dans un monde parallèle. Elle lui dit que pendant qu'il dormait, une Sage du nom de Sion est arrivé et a donné des pouvoirs à tous les élèves, sauf à eux, ce qui a permis aux autres de s'enfuir. Considérés comme des incapables, les deux adolescents délaissés n'y ont pas eu droit. Mais ce que cette Sion ne savait pas, c'est qu'ils ont en réalité été dotés d'un pouvoir dépassant toutes les limites de ce monde.", 1, 4, "18:00:00", "my-instant-death-ability-is-so-overpowered.jpg"),
("Sasaki To P-Chan", "Sasaki And Peeps", "L'adorable oiseau que Sasaki a acheté dans une animalerie, nommé P-chan, était en réalité un sage réincarné d'un autre monde. Ayant la possibilité de traverser les mondes et étant le détenteur d'une puissante magie, Sasaki apporte des biens modernes dans cet autre monde et lance une entreprise. Tout en voyageant entre les mondes, gagnant de l'argent, s'entraînant à la magie et mangeant des plats délicieux, il vise à vivre une vie tranquille et lente, mais un jour, en rentrant du travail, il rencontre une personne aux capacités inhabituelles. Il utilise la magie de sa marque de sage pour s'en sortir, mais ses capacités sont ainsi reconnues et il est repéré par le 'Bureau des Contre-Mesures aux Phénomènes Surnaturels', et on lui propose alors un poste de fonctionnaire national...", 1, 5, "17:30:00", "sasaki-to-p-chan.jpg"),
("Nozomanu Fushi No Boukensha", "The Unwanted Undead Adventurer", "Cela fait maintenant dix ans que Lent veut devenir aventurier, mais celui-ci stagne au rang inférieur. Un jour, il se rend dans le Donjon de la Lune d'Eau afin de s'y entraîner et d'y trouver des ressources à revendre. Mais il tombe nez à nez avec un Dragon, créature démoniaque qui ne fréquente normalement jamais ce donjon classé débutant. Paralysé par sa puissance, il se fait dévorer et meurt. Pourtant, il se réveille sous la forme d'un démon Squelette. Désorienté, il réussit finalement à bénéficier de l''évolution substantielle', une capacité que seuls les monstres possèdent, et décide de tout faire pour redevenir humain. Commence alors une lutte sans merci contre les monstres du donjon !", 1, 5, "17:30:00", "the-unwanted-undead-adventurer.jpg"),
("Sousou No Frieren", "Frieren", "Le jeune héros Himmel et ses compagnons, l'elfe Frieren, le nain Eisen et le prêtre Heiter, rentrent victorieux de leur combats contre le roi des démons. Au bout de dix années d'efforts, ils ont ramené la paix dans le royaume. Il est temps pour eux de retrouver une vie normale... Difficile à imaginer après tant d'aventures en commun ! Frieren, elle, ne semble guère touchée par la séparation. Pour la magicienne à la longévité exceptionnelle, une décennie ne pèse pas lourd. Elle reprend la route en solo et promet de retrouver ses camarades un demi-siècle plus tard. Elle tient parole... mais ces retrouvailles sont aussi les derniers instants passés avec Himmel, devenu un vieillard qui s'éteint paisiblement sous ses yeux. Frieren est sous le choc... La vie des humains est si courte ! L'elfe a beau être experte en magie, il lui reste encore un long chemin à parcourir pour comprendre la race humaine... Son nouvel objectif : s'initier aux arcanes du cœur !", 1, 5, "17:30:00", "frieren0.jpg"),
("Chiyu Mahou no Machigatta Tsukaikata: Senjou wo Kakeru Kaifuku Youin", "The Wrong Way To Use Magic Healing", "Par une rude journée pluvieuse, Usato Ken, un lycéen sans talent particulier, s'est retrouvé invoqué dans un autre autre monde avec deux autres personnes : un beau garçon et une belle fille, avec lesquels il a étrangement commencé à sympathiser aujourd'hui même. En tant qu'individu particulièrement dépourvu de talent et plutôt effacé, il pensait qu'il serait traité comme une personne inutile. Cependant, ils ont étonnamment été gentils. Usato, qui a retrouvé l'espoir dans cet autre monde, pensait ainsi. Cependant, il semblerait que la réalité soit différente. En effet, à cause d'un certain talent magique caché en lui, il a été forcé de sombrer en enfer au nom de son 'apprentissage'.", 1, 5, "18:30:00", "the-wrong-way-to-use-healing-magic.jpg"),
("One Piece", NULL, "Il fut un temps où Gold Roger était le plus grand de tous les pirates, le 'Roi des Pirates' était son surnom. A sa mort, son trésor d'une valeur inestimable connu sous le nom de 'One Piece' fut caché quelque part sur 'Grand Line'. De nombreux pirates sont partis à la recherche de ce trésor mais tous sont morts avant même de l'atteindre. Monkey D. Luffy rêve de retrouver ce trésor légendaire et de devenir le nouveau 'Roi des Pirates'. Après avoir mangé un fruit du démon, il possède un pouvoir lui permettant de réaliser son rêve. Il lui faut maintenant trouver un équipage pour partir à l'aventure !", 1, 7, "09:30:00", "one-piece.jpg"),
("Shangri-La- Frontier", NULL, "Sunraku est un passionné de jeux vidéo un peu particulier, qui voue sa vie à s'essayer aux pires 'bouses' : scénario bancal, bugs dans tous les sens... il se délecte à déjouer tous ces pièges !
Mais lorsqu'il décide pour une fois de s'attaquer au MMORPG Shangri-La Frontier, un 'Greatest Of All Times' aux trente millions de membres inscrits, il ne se doute pas qu'il va devoir faire preuve de tous ses talents pour venir à bout d'une épreuve encore plus corsée...", 1, 7, "12:00:00", "shangri-la-frontier.jpg"),
("Ragna Crimson", NULL, "Dans un monde où les dragons gouvernent le ciel, la mer et la terre, ceux qui veulent les combattre et gagner doivent dépasser les limites de la force humaine. Parti pour la victoire, Ragna, un chasseur de dragon, se joint au mystérieux Crimson. Cependant, les motivations de ce dernier peuvent paraître obscures. Mais ils possèdent le même objectif, qui consiste à détruire les monarques dragons.", 1, 6, "17:30:00", "ragna-crimson.jpg"),
("Bucchigiri?!", NULL, "L'histoire débute quand Arajin Tomobishi retrouve un de ses anciens amis dans un lycée un peu particulier...", 1, 6, "18:00:00", "bucchigiri.jpg"),
("Mashle", "Mashle Magic And Muscles", "Dans un monde où la magie fait loi, il était une fois Mash Burnedead ! Élevé au fin fond de la forêt, le jeune garçon passe ses journées entre séances de musculation et dégustations de choux à la crème.</br>Mais un jour, un agent de police découvre son secret : il est né sans pouvoirs magiques, ce qui est puni de mort ! Pour survivre, il va devoir postuler à Easton, une prestigieuse académie de magie, et en devenir le meilleur élève...</br>La magie n'a plus qu'à bien se tenir : avec sa musculature affûtée et sa force hors du commun, Mash compte bien pulvériser tous les sorts et briser les codes de cette société !", 1, 6, "18:40:00", "mashle.jpg"),
("Kusuriya no Hitorigoto", "The Apothecary Diaries", "À l'Est se trouve une terre gouvernée par un empereur, dont les épouses et les femmes au service de l'Etat vivent dans un vaste complexe appelé hougong, le palais arrière. Maomao, une fille modeste élevée par son père apothicaire, n'avait jamais imaginé que l'arrière-palais aurait quelque chose à voir avec elle jusqu'à ce qu'elle soit kidnappée et vendue pour y travailler comme servante.</br></br>Bien qu'elle ait l'air ordinaire, Maomao a l'esprit vif, aiguisé et possède une connaissance approfondie de la médecine. C'est son secret, jusqu'à ce qu'elle rencontre Jinshi, un résident du palais au moins aussi perspicace qu'elle. Il voit à travers la façade de Maomao et fait d'elle goûteuse personnelle d'une des favorites de l'empereur pour qu'elle puisse goûter la nourriture de la dame à la recherche d'un poison !", 1, 6, "20:15:00", "les-carnets-de-lapothicaire0.jpg"),
("Naruto", NULL, "Dans le village de Konoha vit Naruto, un jeune garçon détesté et craint des villageois du fait qu'il détienne en lui Kyuubi (démon renard à neuf queues) d'une incroyable force, qui a tué un grand nombre de personnes. Le ninja le plus puissant de Konoha à l'époque, le quatrième Hokage, Minato Namikaze, réussit à sceller ce démon dans le corps de Naruto.</br>Malheureusement il y laissa la vie.</br></br>C'est ainsi que douze ans plus tard, Naruto rêve de devenir le plus grand Hokage de Konoha afin que tous le reconnaissent à sa juste valeur. Mais la route pour devenir Hokage est très longue et Naruto sera confronté à un bon nombre d'épreuves et devra affronter de nombreux ennemis pour atteindre son but !", 0, NULL, NULL, "naruto.jpg"),
("Naruto Shippuden", NULL, "L'histoire de Naruto Shippuden se déroule deux ans et demie après le départ de Naruto à Konoha. On y retrouve tous les personnages plus mûrs et plus âgés.</br></br>L'intrigue tourne autour des aventures de Naruto et Sakura à la recherche de Sasuke, parti de Konoha pour acquérir de nouveaux pouvoirs, mais on y découvre aussi les objectifs de l'Akatsuki.", 0, NULL, NULL, "naruto-shippuden.jpg");

INSERT INTO animes_tags(id_anime, id_tag) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 4),
(3, 1),
(3, 2),
(3, 7),
(3, 3),
(3, 4),
(3, 8),
(4, 4),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(5, 1),
(5, 2),
(5, 3),
(5, 14),
(5, 4),
(5, 9),
(5, 15),
(5, 12),
(6, 1),
(6, 2),
(6, 7),
(6, 4),
(6, 8),
(6, 12),
(7, 1),
(7, 4),
(7, 7),
(7, 9),
(7, 8),
(7, 16),
(7, 12),
(8, 1),
(8, 2),
(8, 4),
(8, 17),
(8, 18),
(8, 8),
(8, 19),
(9, 15),
(9, 2),
(9, 3),
(9, 4),
(9, 12),
(9, 20),
(9, 21),
(10, 1),
(10, 2),
(10, 7),
(10, 4),
(10, 9),
(10, 8),
(10, 12),
(11, 1),
(11, 2),
(11, 7),
(11, 3),
(12, 1),
(12, 2),
(12, 4),
(12, 15),
(13, 1),
(13, 3),
(13, 4),
(14, 1),
(14, 10),
(15, 1),
(15, 2),
(15, 7),
(15, 12),
(15, 10),
(16, 3),
(16, 5),
(16, 17),
(16, 18),
(16, 20),
(16, 22),
(16, 23),
(16, 24),
(17, 1),
(17, 2),
(17, 7),
(17, 3),
(17, 4),
(17, 15),
(18, 1),
(18, 2),
(18, 7),
(18, 3),
(18, 4),
(18, 15);