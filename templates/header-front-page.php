<?php
/**
 * Front page header
 * @category   JavaScript
 * @package    RootsThemeExamples
 * @author     Joel Kuzmarski <leoj3n+RootsThemeExamples@gmail.com>
 * @copyright  2013-2014 Joel Kuzmarski
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 *             GNU General Public License, Version 3
 * @link       https://github.com/leoj3n/roots/tree/example.backbone
 */
?>

<header class="banner navbar navbar-static-top" role="banner">
  <div class="container">
    <a class="navbar-brand" href="<?php echo home_url(); ?>/">
      <?php bloginfo('name'); ?>
    </a>
    <button data-target=".nav-main" data-toggle="collapse" type="button" class="navbar-toggle">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <nav class="nav-main nav-collapse collapse" role="navigation">
      <!-- Backbone Example -->
      <form class="navbar-form navbar-left" action="" role="search">
        <div class="form-group">
          <input type="text" id="new-todo" class="form-control" placeholder="What needs to be done?" autofocus>
        </div>
      </form>
    </nav>
  </div>
</header>
