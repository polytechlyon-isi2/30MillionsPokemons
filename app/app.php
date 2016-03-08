<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;




// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();




// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());




// Register services.
$app['dao.pokemons'] = $app->share(function ($app) {
    return new MillionsPokemons\DAO\PokemonsDAO($app['db']);
});

$app['dao.users'] = $app->share(function ($app) {
    return new MillionsPokemons\DAO\UsersDAO($app['db']);
});

$app['dao.types'] = $app->share(function ($app) {
    return new MillionsPokemons\DAO\TypesDAO($app['db']);
});

$app['dao.typesPokemons'] = $app->share(function ($app) {
    $typesPokemonsDAO = new MillionsPokemons\DAO\TypesPokemonsDAO($app['db']);
    $typesPokemonsDAO->setTypeDAO($app['dao.types']);
    $typesPokemonsDAO->setPokemonsDAO($app['dao.pokemons']);
    return $typesPokemonsDAO;
});

$app['dao.historiques'] = $app->share(function ($app) {
    return new MillionsPokemons\DAO\HistoriquesDAO($app['db']);
});
