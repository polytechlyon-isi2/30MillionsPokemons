# 30MillionsPokemons

## Installation 

- Télécharger le projet et l'enregistrer dans un répertoire web (www pour Wamp, htdocs pour Xamp, etc...) 
- Executer les scripts sql présents dans le répertoir db dans l'interface phpMyAdmin du serveur web
- Télécharger <a href="https://getcomposer.org/"> Composer </a>
- Executer <code>composer update</code> dans le repertoire web (i.e : l'endroit où se trouve le fichier composer.json)

## Notes de Développement

Un article est un Pokemon. Une Catégorie est un "Type" de Pokemon (Feu, eau, etc...). Un pokemon peut ainsi avoir plusieurs type.

### Particularités et Fonctionnalités développées en plus

- Chaque Pokemon possède une "quantité en stock". Lorsqu'un client ajoute un article au panier, cette quantité est réduite de 1. Si le client supprime un article de son panier, la quantité disponible du Pokemon est augmenté de 1.
- Lorsqu'un nouveau client s'inscrit, il est automatiquement connecté avec son nouveau compte. 
- Lorsqu'un nouveau client s'inscrit, il a la possibilité de choisir une image de profil. Celle-ci est automatiquement upload sur le serveur dans le repertoire /web/images/users/[idUser].jpeg. 
- Un Bouton "retour en arrière" est présent sur les pages des catégories et de détail des articles.

