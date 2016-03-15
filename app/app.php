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
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
}));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new MillionsPokemons\DAO\UsersDAO($app['db']);
            }),
        ),
    ),
));
$app->register(new Silex\Provider\FormServiceProvider);
$app->register(new Silex\Provider\TranslationServiceProvider());



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
