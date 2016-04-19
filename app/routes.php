<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MillionsPokemons\Domain\Comments;
use MillionsPokemons\Domain\Articles;
use MillionsPokemons\Domain\Users;
use MillionsPokemons\Domain\Panier;
use MillionsPokemons\Form\Type\UserType;
use MillionsPokemons\Form\Type\ImageType;

/* Home page 
 * Display all categories 
 */
$app->get('/', function () use ($app) {

    $types = $app['dao.types']->findAll();

    return $app['twig']->render('home.html.twig', array('categories' => $types));

})->bind('home');

/* Category page
 * Display all articles of the category selected 
 */
$app->get('/category/{id}', function ($id) use ($app) {

    $allPokemons = $app['dao.typesPokemons']->findAllByType($id);
    $category = $app['dao.types']->find($id);

    return $app['twig']->render('pokemon_categories.html.twig', array('articles' => $allPokemons, 'category' => $category));

})->bind('category');

/* Article page
 * Display all details of a selected article 
 */
$app->get('/article/{id}', function ($id) use ($app) {

    $aPokemon = $app['dao.pokemons']->find($id);
    $pokemonTypes = $app['dao.typesPokemons']->findAllByPokemon($id);

    return $app['twig']->render('pokemon_details.html.twig', array('details' => $aPokemon, 'types' => $pokemonTypes));

})->bind('article');

/* Log in page 
 * Display an empty form for connection and a link to the register form 
 */
$app->get('/login', function (Request $request) use ($app) {

    return $app['twig']->render('user_login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),));

})->bind('login');

/* Sign up page 
 * Display an empty form for add a user in the database. 
 * Add the result in the db if there is no mistakes.
 * The default role of the user is "ROLE_USER".
 */
$app->match('/signUp', function(Request $request) use ($app) {

    $user = new Users();

    $userForm = $app['form.factory']->create(new UserType(), $user);

    $userForm->handleRequest($request);

    if ($userForm->isSubmitted() && $userForm->isValid()) {

        /* password */
        $salt = substr(md5(time()), 0, 23);  // generate a random salt value
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        $encoder = $app['security.encoder.digest']; // find the default encoder
        $password = $encoder->encodePassword($plainPassword, $user->getSalt()); // compute the encoded password
        $user->setPassword($password); 

        /* user role */
        $user->setRole('ROLE_USER'); 

        try {

            $app['dao.users']->save($user);

            /* Token for connect the new user ! */
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $app['security']->setToken($token);
            $app['session']->set('_security_main',serialize($token));

            return $app->redirect($app['url_generator']->generate('profil'));

        } catch (Exception $e) {

            $app['session']->getFlashBag()->add('problem', 'Il existe déjà un compte avec cette addresse mail !'); 

            return $app['twig']->render('user_form.html.twig', array(
                'title' => 'Inscription',
                'userForm' => $userForm->createView()));
        }
    }

    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Inscription',
        'userForm' => $userForm->createView()));

})->bind('user_add');

/* Edit User profil
* Display a completed form with the user selected.
* Update the db if there is no mistakes
*/
$app->match('/user/{id}/edit', function($id, Request $request) use ($app) {

    $user = $app['dao.users']->find($id);
    $userForm = $app['form.factory']->create(new UserType(), $user);

    $userForm->handleRequest($request);

    if ($userForm->isSubmitted() && $userForm->isValid()) {

        $plainPassword = $user->getPassword();
        $encoder = $app['security.encoder_factory']->getEncoder($user);  // find the encoder for the user
        $password = $encoder->encodePassword($plainPassword, $user->getSalt()); // compute the encoded password

        $user->setPassword($password); 

        try { 

            $app['dao.users']->save($user);
            $app['session']->getFlashBag()->add('success', 'Votre compte a bien été mis à jour !');

            /* Token for connect the "new" user ! */
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $app['security']->setToken($token);
            $app['session']->set('_security_main',serialize($token));

            return $app->redirect($app['url_generator']->generate('profil'));

        } catch (Exception $e) {

            $app['session']->getFlashBag()->add('problem', 'Il existe déjà un compte avec cette addresse mail !'); 

            return $app['twig']->render('user_form.html.twig', array(
                'title' => 'Inscription',
                'userForm' => $userForm->createView()));
        }
    }

    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Modifier mes informations ',
        'userForm' => $userForm->createView()));

})->bind('user_edit');

/* User Profil page
 * Display détails of a the connected user
 * Also add a profil image if the user click on the button
 */
$app->match('/profil', function (Request $request) use ($app) {

    $imageForm = $userForm = $app['form.factory']->create(new ImageType());
    $imageForm->handleRequest($request);

    //Upload the file selected
    if ($imageForm->isSubmitted() && $imageForm->isValid()) {

        $files = $request->files->get($imageForm->getName());
        $path = __DIR__.'/../web/images/users/';

        //Check if the user has already an image
        if($app['dao.fileSystem']->exists($path . $app['user']->getId() . ".jpeg")) {

            //delete the old one before upload the new one 
            $app['dao.fileSystem']->remove($path .  $app['user']->getId() . ".jpeg");
        } 

        $filename = $files['fileUpload']->getClientOriginalName();
        $files['fileUpload']->move($path,$filename);

        //Use File System to rename the file. It will be easier to display it in the application
        $app['dao.fileSystem']->rename($path . $filename, $path .  $app['user']->getId() . ".jpeg");

        return $app->redirect($app['url_generator']->generate('profil'));
    }

    return $app['twig']->render('user_profil.html.twig', array(
        'form' => $imageForm->createView()
    ));

})->bind('profil');

/* Shop Cart page
 * Display détails of the shop cart for the connected user
 */
$app->get('/shop_cart/{id}', function ($id, Request $request) use ($app) {

    $allCartsLine = $app['dao.shop_cart']->findAllByUser($id);
    $total = 0;    

    foreach($allCartsLine as $line) {
        $total += $line->getPkm()->getPrice() * $line->getQte();
    }    

    return $app['twig']->render('shop_cart.html.twig', array(
        'title' => 'Mon panier',
        'cartsLine' => $allCartsLine, 
        'total' => $total));

})->bind('shop_cart');

/* Add the selected article in the user shop cart if there is no mistakes.
 * Then display the shop_cart view for the selected user.
 */
$app->match('/shop_cart/add/{iduser}/{idpkm}', function($iduser, $idpkm, Request $request) use ($app) {

    $pokemon = $app['dao.pokemons']->find($idpkm);
    $user = $app['dao.users']->find($iduser);

    $line = new Panier();
    $line->setUser($user);
    $line->setPkm($pokemon);
    $line->setQte(1);

    try {

        $app['dao.shop_cart']->save($line);

        /* Reduce the quantity available in the pokemon table */
        $pokemon->setStock($pokemon->getStock() - 1);
        $app['dao.pokemons']->update($pokemon);

    }  catch (Exception $e) {

        $app['session']->getFlashBag()->add('problem', 'Problème lors l\'ajout dans le panier !');        
        return $app->redirect($app['url_generator']->generate('shop_cart', array('id' => $iduser)));   
    }

    return $app->redirect($app['url_generator']->generate('shop_cart', array('id' => $iduser)));   

})->bind('add_shop_cart');

/* Remove the selected article in the user shop cart (just one).
 * Then display the shop_cart view for the selected user.
 * This controller is NEVER used FOR PURCHASE !
 */
$app->match('/shop_cart/remove/{iduser}{idpkm}', function($iduser, $idpkm, Request $request) use ($app) {

    $pokemon = $app['dao.pokemons']->find($idpkm);
    $user = $app['dao.users']->find($iduser);

    $line = $app['dao.shop_cart']->find($user->getId(), $pokemon->getId());

    if($line) {

        $app['dao.shop_cart']->remove($line);

        //Update the quantity available in the pokemon table
        $pokemon->setStock($pokemon->getStock() + 1);
        $app['dao.pokemons']->update($pokemon);

    } else {

        $app['session']->getFlashBag()->add('problem', 'Problème lors de la suppression dans le panier !');   
    }

    return $app->redirect($app['url_generator']->generate('shop_cart', array('id' => $iduser)));  

})->bind('remove_shop_cart');

/* Remove all articles in the shop cart of the user.
 * Then display the shop_cart view for the selected user.
 * This controller is used ONLY FOR PURCHASE ! 
 */
$app->match('/shop_cart/removeAll/{iduser}', function($iduser, Request $request) use ($app) {

    $user = $app['dao.users']->find($iduser);
    $allCartsLine = $app['dao.shop_cart']->findAllByUser($iduser);

    foreach($allCartsLine as $line) {
        $app['dao.shop_cart']->remove($line);
    }

    $app['session']->getFlashBag()->add('success', 'Merci pour votre commande ! Et à très vite !');   
    return $app->redirect($app['url_generator']->generate('shop_cart', array('id' => $iduser)));  

})->bind('removeAll_shop_cart');