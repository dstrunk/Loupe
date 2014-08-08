<?php

  \Slim\Slim::registerAutoloader();

  $app = new \Slim\Slim(array(
    'debug'          => true,
    'templates.path' => WP_LOUPE . 'app/views/',
  ));

  $app->notFound(function() use ($app, $request) {
    $app->render('errors/404.html', array('request' => $request));
  });

  /**
   *  An example of your root route. In this example, the template 'index.html'
   *  is passed an array of posts, much like a front page displaying
   *  your latest posts would.
   *
   *  $app->get('/', function() use ($app, $wp) {
   *    $posts = $wp->getPosts();
   *    $app->render('templates/index.html', array('posts' => $posts));
   *  });
   *
   *
   *  An example of a /books/ route. In this example, /books/0 returns
   *  the first post in the category 'books'
   *
   *  $app->get('/books/:id', function ($id) use ($wp) {
   *    var_dump($wp->getPostsInCategory('books', '', $id));
   *    do_action('admin_init');
   *    wp_footer();
   *  });
   */

  $app->run();
