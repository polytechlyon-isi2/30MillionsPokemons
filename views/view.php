<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="pokemon.css" rel="stylesheet" />
        <title>30 Millions de Pokemons - Home</title>
    </head>
    <body>
        <header>
            <h1>30 Millions de Pokemons</h1>
        </header>

        <?php foreach ($articles as $article): ?>
        <article>
            <h2><?php echo $article['nom_pkm'] ?></h2>
            <p><?php echo $article['description'] ?></p>
        </article>
        <?php endforeach ?>

        <footer class="footer">
            TODO : include footer here ! 
        </footer>
    </body>
</html>