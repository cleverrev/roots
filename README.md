# Roots Theme — Templating

This branch uses simple examples to illustrate [Roots](https://github.com/retlehs/roots/) templating *in general*.

## Normal Template Hierarchy (Bad)

By defualt in WordPress, both layout and content are expected to exist in a single template file (violating [DRY](http://en.wikipedia.org/wiki/Don't_repeat_yourself)).

![WordPress Template Hierarchy — from wordpress.org](http://codex.wordpress.org/images/1/18/Template_Hierarchy.png "WordPress Template Hierarchy")

## Roots Template Hierarchy (Better)

However in Roots, the [theme wrapper](http://scribu.net/wordpress/theme-wrappers.html) breaks out layout and content into multiple files (enabling [DRY](http://en.wikipedia.org/wiki/Don't_repeat_yourself)).

    [] = default behavior — sometimes it may make sense to override this pattern.

    Least common denominator;
    Rarely need to create;        Create as needed;
    Defaults to base.php          See normal hierarchy
           \                               /                   End of the line;
            +---[roots_template_path()]---+                    Reusable parts
            |                             |                            /
            |                             +---[get_template_part()]---+
            |                             |                           |
    Site Front Page                       |                           |
      base-front-page.php            front-page.php            [templates/*.php]
      base-home.php                  home.php                  [templates/*.php]
            |                             |                           |
    Single Post Display                   |                           |
      base-single-{post_type}.php    single-{post_type}.php    [templates/*.php]
      base-single.php                single.php                [templates/*.php]
            |                             |                           |
    Page Display                          |                           |
      base-page-{slug}.php           page-{slug}.php           [templates/*.php]
      base-page-{id}.php             page-{id}.php             [templates/*.php]
      base-page.php                  page.php                  [templates/*.php]
            |                             |                           |
    Category Display                      |                           |
      base-category-{slug}.php       category-{slug}.php       [templates/*.php]
      base-category-{id}.php         category-{id}.php         [templates/*.php]
      base-category.php              category.php              [templates/*.php]
            |                             |                           |
    Tag Display                           |                           |
      base-tag-{slug}.php            tag-{slug}.php            [templates/*.php]
      base-tag-{id}.php              tag-{id}.php              [templates/*.php]
      base-tag.php                   tag.php                   [templates/*.php]

    ...and so on:

    Custom Taxonomies Display           Search Result Display
      taxonomy-{taxonomy}-{term}.php      search.php
      base-taxonomy-{taxonomy}.php
      taxonomy.php                      404 (Not Found) Display
                                          404.php
    Custom Post Types Display
      archive-{post_type}.php           Attachment Display
                                          MIME_type.php
    Author Display
      author-{nicename}.php             Date Display
      author-{id}.php                     date.php
      author.php
      
Default use of roots_template_path() and get_template_part(): [base.php](base.php) and [page.php](page.php) or [single.php](single.php).

Custom template examples: [base-front-page.php](base-front-page.php), [front-page.php](front-page.php), [category.php](category.php), [category-radio.php](category-radio.php), and [archive-movie_review.php](archive-movie_review.php). Note: examples untested; report any issues.
