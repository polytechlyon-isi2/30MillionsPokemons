<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => '30MillionsPokemons',
    'user'     => 'pokemons_user',
    'password' => 'secret',
);