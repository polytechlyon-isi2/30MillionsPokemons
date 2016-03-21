<?php

use Symfony\Component\HttpFoundation\Request;
use MillionsPokemons\Domain\Comments;
use MillionsPokemons\Domain\Articles;
use MillionsPokemons\Domain\Users;
use MillionsPokemons\Form\Type\UserType;

/* Home page 
 * Display all categories 
 */
$app->get('/', function () use ($app) {
    $types = $app['dao.types']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $types));
})->bind('home');

/* Category page
 * Display all articles of the category selected 
 */
$app->get('/category/{id}', function ($id) use ($app) {
    $allPokemons = $app['dao.typesPokemons']->findAllByType($id);
    $category = $app['dao.types']->find($id);
    return $app['twig']->render('category.html.twig', array('articles' => $allPokemons, 'category' => $category));
})->bind('category');

/* Article page
 * Display all details of a selected article 
 */
$app->get('/article/{id}', function ($id) use ($app) {
    $aPokemon = $app['dao.pokemons']->find($id);
    $pokemonTypes = $app['dao.typesPokemons']->findAllByPokemon($id);
    return $app['twig']->render('article.html.twig', array('details' => $aPokemon, 'types' => $pokemonTypes));
})->bind('article');

/* Log in page 
 * Display an empty form for connection and a link to the register form 
 */
$app->get('/login', function (Request $request) use ($app) {
    return $app['twig']->render('connection.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),));
})->bind('login');

/* Sign up page 
 * Display an empty form for add a user in the database. 
 * The default role of the user is "ROLE_USER".
 */
$app->match('/signUp', function(Request $request) use ($app) {
    $user = new Users();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $user->setRole('ROLE_USER'); // setup the role as user 
        
        /*To remove ASAP !
          try {
            $app['dao.users']->find($user->getId());
            $app['dao.users']->save($user);
            $app['session']->getFlashBag()->add('success', 'Votre compte a été créé ! :)'); 
        } catch (Exception $e) {
            return $app['twig']->render('user_form.html.twig', array(
                'title' => 'Inscription',
                'error' => $e->getMessage(),
                'userForm' => $userForm->createView()));
        }*/
        
        $app['dao.users']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Inscription',
        'userForm' => $userForm->createView()));
})->bind('user_add');