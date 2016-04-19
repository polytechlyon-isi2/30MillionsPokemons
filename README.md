# 30MillionsPokemons

## Installation 

- Télécharger le projet et l'enregistrer dans un répertoire web (www pour Wamp, htdocs pour Xamp, etc...) 
- Executer les scripts sql présents dans le répertoir db dans l'interface phpMyAdmin du serveur web
- Télécharger <a href="https://getcomposer.org/"> Composer </a>
- Executer <code>composer update</code> dans le repertoire web (i.e : l'endroit où se trouve le fichier composer.json)

## Notes de Développement

- Un Article est un Pokemon. 
- Une Catégorie est un "Type" de Pokemon (Feu, Eau, Poison, etc...). Un pokemon peut ainsi avoir plusieurs types (2 max).
- Une distinction entre un Utilisateur classique et un Administrateur est prévue mais il n'y a pas de différences pour le moment. 
- La vue layout.html.twig correspond à l'entête et au template de twig. Il existe également backButton.html.twig, qui rajoute un bouton retour en arrière lorsque l'utilisateur se balade sur le site ; Et error.html.twig qui permet d'afficher des erreurs sur certaines pages. Pour le moment, c'est trois pages sont héritées par les pages classiques selon le schéma suivant : layout -> backButton -> error -> [...] .  

### Particularités et Fonctionnalités développées en plus

- Chaque Pokemon possède une "quantité en stock". Lorsqu'un client ajoute un article au panier, cette quantité est réduite de 1. Si le client supprime un article de son panier, la quantité disponible du Pokemon est augmenté de 1.
- Lorsqu'un nouveau client s'inscrit, il est automatiquement connecté avec son nouveau compte. 
- Sur son profil, le client a la possibilité de choisir une image de profil. Celle-ci est automatiquement upload sur le serveur dans le repertoire /web/images/users/[idUser].jpeg. 

