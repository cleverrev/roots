# Roots Theme — Parent

Proof of concept using [Roots Theme](http://www.rootstheme.com/) as a [parent theme](http://codex.wordpress.org/Child_Themes) without removing theme support for `root-relative-urls` or `rewrites`. Also implements [Theme Hook Alliance](https://github.com/zamoose/themehookalliance).

## Theme Hook Alliance

You must initialize the submodule: `git submodule init && git submodule update`.

## Example Code

Example code for your child's `functions.php`

Common enqueues/dequeues:

    add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts', 101 );
    function my_enqueue_scripts() {
      // dequeue style.css
      wp_dequeue_style( 'roots_child' );

      // enqueue child_plugins.js
      wp_enqueue_script( 'my_child_plugins',
        trailingslashit( get_stylesheet_directory_uri() ) . 'assets/js/child_plugins.js', array(), false );

      // enqueue main.js with custom dependencies
      wp_dequeue_script( 'roots_main' );
      wp_enqueue_script( 'my_main',
        trailingslashit( get_stylesheet_directory_uri() ) . 'assets/js/main.js', array( 'jquery', 'my_child_plugins' ), false );
    }

## Tips

- Copy `lib/config.php` to `lib/config.php` in the root of your child theme. Now you have full control over sidebar display, generated classes and other configurations from the child.
- If permalinks/rewrites are working and being used, assets in the child will successfully override parent assets. If rewrites aren't activated, the child assets must be explicitly registered, and the parents unregistered. To test the override, create `assets/js/main.js` or `assets/css/app.css` in the child; it should get included instead of the parent version of the same file.

## Reference

This is what your `.htaccess` would look like using [roots-simple-child](https://github.com/leoj3n/roots-simple-child):

```

# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{DOCUMENT_ROOT}/app/themes/roots-simple-child/$1 -f
RewriteRule ^(.*[^/])/?$ /app/themes/roots-simple-child/$1 [QSA,L]
RewriteCond %{DOCUMENT_ROOT}/app/themes/roots/$1 -f
RewriteRule ^(.*[^/])/?$ /app/themes/roots/$1 [QSA,L]
RewriteRule ^plugins/(.*) /app/plugins/$1 [QSA,L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>

# END WordPress

```
