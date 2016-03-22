<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        
        $salt = substr(md5(time()), 0, 23);  // generate a random salt value
        
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        
        $encoder = $app['security.encoder.digest']; // find the default encoder
        $password = $encoder->encodePassword($plainPassword, $user->getSalt()); // compute the encoded password
        
        $user->setPassword($password); 
        $user->setRole('ROLE_USER'); // setup the role as user
        
        try {
            
            $app['dao.users']->save($user);
            $app['session']->getFlashBag()->add('success', 'Votre compte a été créé ! :)'); 
            
            /* Token for connect the new user ! */
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $app['security']->setToken($token);
            $app['session']->set('_security_main',serialize($token));
            
            return $app->redirect($app['url_generator']->generate('home'));
            
        } catch (Exception $e) {
            
            $app['session']->getFlashBag()->add('problem', $e->getMessage()); 
            
            return $app['twig']->render('user_form.html.twig', array(
                'title' => 'Inscription',
                'error' => $e->getMessage(),
                'userForm' => $userForm->createView()));
        }
    }
    
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Inscription',
        'userForm' => $userForm->createView()));
    
})->bind('user_add');