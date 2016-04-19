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
INSERT INTO Pokemons (nom_pkm, prix, qteStock, description) VALUES ('Pikachu', 2500000, 0 , 'Il lui arrive de remettre d''aplomb un Pikachu allié en lui envoyant une décharge électrique.');

/* ADD USERS */
/* raw password is 'john' */
insert into Users values
(1, 'JohnDoe@mail.com', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'Doe', 'John', '53 Rue des coquelicots, chateauneuf du rhône', '26780','YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */
insert into Users values
(2, 'JaneDoe@mail.com', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'Doe', 'Jane', '53 Rue des coquelicots, chateauneuf du rhône', '26780','dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');

/* ADD SHOP CART */
INSERT INTO Panier VALUES (1, 1, 1);
INSERT INTO Panier VALUES (1, 2, 1);
INSERT INTO Panier VALUES (2, 2, 1); 

/* ADD TYPES */
INSERT INTO Types VALUES ('ACIER','acier');
INSERT INTO Types VALUES ('CBT','combat');
INSERT INTO Types VALUES ('DRG','dragon');
INSERT INTO Types VALUES ('EAU','eau'); 
INSERT INTO Types VALUES ('EKT','electrique'); 
INSERT INTO Types VALUES ('FEE','fee');
INSERT INTO Types VALUES ('FEU','feu');
INSERT INTO Types VALUES ('GLC','glace');
INSERT INTO Types VALUES ('INSCT','insecte');
INSERT INTO Types VALUES ('NRML','normal');
INSERT INTO Types VALUES ('PLT','plante');
INSERT INTO Types VALUES ('PSN','poison');
INSERT INTO Types VALUES ('PSY','psy');
INSERT INTO Types VALUES ('RCH','roche');
INSERT INTO Types VALUES ('SOL','sol');
INSERT INTO Types VALUES ('SPCTR','spectre');
INSERT INTO Types VALUES ('TNBRE','tenebre');
INSERT INTO Types VALUES ('VOL','vol');

/* ADD Types for Pokemons */
INSERT INTO TypesPokemons VALUES (1, 'PLT');
INSERT INTO TypesPokemons VALUES (1, 'PSN');
INSERT INTO TypesPokemons VALUES (2, 'FEU');
INSERT INTO TypesPokemons VALUES (3, 'FEU');
INSERT INTO TypesPokemons VALUES (4, 'EAU');
INSERT INTO TypesPokemons VALUES (5, 'PSY');
INSERT INTO TypesPokemons VALUES (6, 'EAU');
INSERT INTO TypesPokemons VALUES (7, 'TNBRE');
INSERT INTO TypesPokemons VALUES (8, 'PSN');
INSERT INTO TypesPokemons VALUES (9, 'VOL');
INSERT INTO TypesPokemons VALUES (9, 'NRML');
INSERT INTO TypesPokemons VALUES (10, 'EKT');