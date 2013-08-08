# Roots Theme — Superfish Example

This branch adds support for [Superfish](https://github.com/joeldbirch/superfish) by extending [Roots Theme](http://www.rootstheme.com/)'s stock [navigation walker](lib/nav.php).

## Explanation

* Extends `Roots_Nav_Walker` as a new class named `Superfish_Nav_Walker` in [custom.php](lib/custom.php).
* Modifies [header-top-navbar.php](templates/header-top-navbar.php) to use `Superfish_Nav_Walker`.
* Adds required Superfish JavaScript and CSS to [scripts.php](lib/scripts.php).

## Screenshot

![Superfish Walker Screenshot](doc/assets/img/example.png)
