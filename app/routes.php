<?php

use Symfony\Component\HttpFoundation\Request;
use MillionsPokemons\Domain\Comments;
use MillionsPokemons\Domain\Articles;
use MillionsPokemons\Domain\Users;
use MillionsPokemons\Form\Type\UserType;

/* Home page 
 * Display all categories */
$app->get('/', function () use ($app) {
    $types = $app['dao.types']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $types));
})->bind('home');

/* Category details 
 * Display all articles of the category selected */
$app->get('/category/{id}', function ($id) use ($app) {
    $allPokemons = $app['dao.typesPokemons']->findAllByType($id);
    return $app['twig']->render('category.html.twig', array('articles' => $allPokemons));
})->bind('category');

/* Connection page for users with an account
 * Display an empty form for connection and a link to the register form */
$app->get('/login', function (Request $request) use ($app) {
    return $app['twig']->render('connection.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),));
})->bind('login');

/* Add a new user in database */
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
        $user->setRole('ROLE_USER');
        $app['dao.users']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Inscription',
        'userForm' => $userForm->createView()));
})->bind('user_add');

/*  TODO : edit user and delete one ! 
$app->match('/admin/user/{id}/edit', function($id, Request $request) use ($app) {
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Edit user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', function($id, Request $request) use ($app) {
    // Delete all associated comments
    $app['dao.comment']->deleteAllByUser($id);
    // Delete the user
    $app['dao.user']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_user_delete'); */ 