<?php

  \Slim\Slim::registerAutoloader();

  $app = new \Slim\Slim(array(
    'debug'          => true,
    'templates.path' => WP_LOUPE . 'app/views/',
  ));

  $app->notFound(function() use ($app, $request) {
    $app->render('errors/404.html', array('request' => $request));
  });

  $app->get('/', function() use ($app, $wp) {
    $posts = $wp->getPosts();
    $app->render('templates/index.html', array('posts' => $posts));
  });

  $app->get('/books/:id', function ($id) use ($wp) {
    var_dump($wp->getPostsInCategory('uncategorized', '', $id));
    do_action('admin_init');
    wp_footer();
  });

  $app->run();
