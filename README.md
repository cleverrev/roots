# Parent version of Roots Theme

This is a parent version of [Roots Theme](http://www.rootstheme.com/).

# Example Code

Here I'll give some example code for your child's functions.php

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
    
# Tips

- Copy `lib/config.php` to `lib/config.php` in the root of your child theme. Now you have full control over sidebar display, generated classes and other configurations from the child.
- This version of roots adds a "sidebar wrapper"; base.php wraps the sidebar include allowing auto-inclusion of template files like `templates/sidebar-page.php` or `templates/sidebar-taxonomy-my_tax.php`.
- If permalinks/rewrites are working and being used, assets in the child will successfully override parent assets. If rewrites aren't activated, the child assets must be explicitly registered, and the parents unregistered. To test the override, create `assets/js/main.js` or `assets/css/app.css` in the child; it should get included instead of the parent version of the same file.