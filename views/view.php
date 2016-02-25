<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />

        <link href="pokemon.css" rel="stylesheet" />
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

        <title>30 Millions de Pokemons - Home</title>
    </head>

    <body>

        <div class="container">

            <header>
                <h1>30 Millions de Pokemons</h1>
            </header>

            <div class="col-sm-12">
                <br>
                <ul class="list-group">

                    <?php foreach ($articles as $article): ?>
                    <li class="list-group-item">
                        <article>
                            <h2><?php echo $article['nom_pkm'] ?></h2>
                            <p><?php echo $article['description'] ?></p>
                        </article>
                    </li>
                    <?php endforeach ?>

                </ul>
            </div>

        </div>

        <footer class="footer">
            TODO : include footer here ! 
        </footer>

    </body>
</html>