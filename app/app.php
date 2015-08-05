<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../vendor/Tamagotchi.php";

    session_start();
    if(empty($_SESSION['state_of_tamagotchi'])) {
        $_SESSION['state_of_tamagotchi'] = array();
    }

    $app= new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('tamagotchi.html.twig');
    });

    $app->post("/tamagotchi", function() use ($app) {
        $tamagotchi = new Tamagotchi($_POST['name']);
        $tamagatchi->save();
        return $app['twig']->render('create_name.html.twig', array('newtamagotchi' => $tamagotchi));
    });

    $app->post("/kill_tamagotchi", function() use ($app) {
        Tamagotchi::deleteAll();
        return $app['twig']->render('kill_tamagotchi.html.twig');
    });

    $app->post("/feed_tamagotchi", function() use ($app) {
        Tamagotchi::setFood() = Tamagotchi::getFood() + 10;
        Tamagotchi::save();
        return $app['twig']->render('tamagotchi.html.twig');
    });

    $app->post("/play_tamagotchi", function() use ($app) {
        Tamagotchi::setPlay() = Tamagotchi::getPlay() + 10;
        Tamagotchi::save();
        return $app['twig']->render('tamagotchi.html.twig');
    });

    $app->post("/sleep_tamagotchi", function() use ($app) {
        Tamagotchi::setSleep() = Tamagotchi::getSleep() + 10;
        Tamagotchi::save();
        return $app['twig']->render('tamagotchi.html.twig');
    });

    $app->post("/skip_time", function() use ($app) {
        Tamagotchi::setFood() = Tamagotchi::getFood() - 10;
        Tamagotchi::setPlay() = Tamagotchi::getPlay() - 10;
        Tamagotchi::setSleep() = Tamagotchi::getSleep() - 10;
        Tamagotchi::save();
        return $app['twig']->render('tamagotchi.html.twig');
    });

    return $app;
?>
