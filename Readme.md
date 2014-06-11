The WordPress Loupe
---

After reading SI Digital's blog post concerning [Disconnecting your frontend from WordPress](http://sidigital.co/blog/disconnect-your-frontend-from-wordpress), I decided to make a more fully-baked solution for integrating their solution for decoupling the WordPress admin side from the front-end.

The Loupe file structure is similar to other opinionated frameworks (Rails and Django are heavy influences).

Usage
---

Using the Loupe is pretty easy (if only a little scary):

1. First, open the root directory of your WordPress installation.
2. Next, replace the `index.php` file present with Loupe's (I'd suggest backing this file up first).

That's all for installation. Now comes routing, templating, and the loupe istelf.

Loupe
---

The Loupe is a WordPress model built to extract WordPress information without using the traditional WordPress Loop. This allows for greater control over the output of information, and allows you to create a more tailored frontend experience for users.

An instance of the loupe has been initialized for you; to use any of its functions, simply call `$wp->function_here()`. So, say you need to list all published blog posts:

```php
$wp->getPosts();
```

This will return an array of objects that you can then loop through, extracting out information and returning results as you see fit.

Routes
---

Routes are handled via the [Slim framework](http://www.slimframework.com/). Slim is a micro framework that handles REST routes for you. There are several routes to get you started in `config/routes.php`, but we'll go over one now.

```php
$app = new \Slim\Slim();

// /books/0 returns the first uncategorized post
$app->get('/books/:id', function ($id) use ($wp) {
  var_dump($wp->getPostsInCategory('uncategorized', '', $id));
  do_action('admin_init');
  wp_footer();
});
```

In this example, we initialize Slim through the variable `$app`. We then tell Slim to look for GET request at `/books/:id`. Our anonymous function then calls `$id` as a parameter, uses the `$wp` instance of the Loupe, and displays the contents of uncategorized posts with the integer passed through `$id`.

Templates
---

Templates, or Views, are located in `app/views`. It is suggested that you add subfolders and name files appropriately for any RESTful routes (e.g. A book index should be located in `app/views/books/index.php`, a single book entry is represented by `app/views/books/show.php`, etc.). But these are just suggestions; the loupe isn't *totally* picky. As long as your view is located within the `app/views` folder, and is referenced correctly in your routes, everything should Just Work&tm;.

Real-world viability
---

SI Digital's post regarding this technique is a cool alternative to getting data out of WordPress, that's for sure. However, before immediately adopting WordPress Loupe, try to consider future use-cases. If your site will grow in the future, or will require some sort of integration with other technologies, it *might* not be for you. I'd suggest installing the [JSON REST API](https://wordpress.org/plugins/json-rest-api/) and manipulating data this way. However, if you're looking to create a minimalist "app" similar to something [Ruby Sinatra](http://www.sinatrarb.com/intro.html) might be used for, give **The WP Loupe** a shot.
