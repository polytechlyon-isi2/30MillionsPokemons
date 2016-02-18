/* ADD POKEMONS */
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Bulbizarre', 100, 5, 'Au matin de sa vie, la graine sur son dos lui fournit les éléments dont il a besoin pour grandir.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Hericendre', 100, 5, 'Ce Pokémon est un grand timide. Les flammes sur son dos s''intensifient lorsqu''il prend peur.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Salamèche', 400, 4 , 'La flamme qui brûle au bout de sa queue indique l''humeur de ce Pokémon. Elle vacille lorsque Salamèche est content. En revanche, lorsqu''il s''énerve, la flamme prend de l''importance et brûle plus ardemment.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Lokhlass', 1300, 1 , 'Il aime naviguer en portant des humains et des Pokémon sur son dos. Il comprend le langage humain.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Alakazam', 6500, 5 , 'On dit que les cuillères qu''il tient en permanence ont été créées par la puissance de son esprit.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Poissirène', 10, 18 , 'Malgré son élégance quand il nage, ses coups de corne sont redoutables.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Ténéfix', 300, 2 , 'À force de manger des gemmes, les yeux de ce Pokémon des grottes obscures sont devenus des joyaux.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Arbok', 200, 4 , 'Il utilise la marque sur son ventre pour intimider l''ennemi. Il étouffe l''ennemi pétrifié par la peur.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Nirondelle', 200, 6 , 'Ce Pokémon téméraire n''a pas peur d''affronter des ennemis puissants. Il vole en quête de climats chauds.');
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Pikachu', 2500000, 5 , 'Il lui arrive de remettre d''aplomb un Pikachu allié en lui envoyant une décharge électrique.');

/* ADD USERS */
INSERT INTO Users VALUES ('Sachouw', '123', 'Lhopital', 'Sacha', 'sacha@yopmail.com', 'adresse', 1);
INSERT INTO Users VALUES ('bPesquet', '123', 'Pesquet', 'Baptiste', 'pesquet@yopmail.com', 'adresse', 1);
INSERT INTO Users VALUES ('Yoyolan', '123', 'Lafaye', 'Yoan', 'yoan@yopmail.com', 'adresse', 0);
INSERT INTO Users VALUES ('Mélan', '123', 'Dubreuil', 'Mélanie', 'mel@yopmail.com', 'adresse', 0);
INSERT INTO Users VALUES ('infoRPZ', '123', 'Vivies', 'Alexandre', 'info@yopmail.com', 'adresse', 0);

/* ADD HISTORIQUE */
INSERT INTO Historiques VALUES ('Sachouw', 10, '22/10/2015', 1);
INSERT INTO Historiques VALUES ('Sachouw', 1, '22/10/2015', 1);