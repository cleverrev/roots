<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->
  
  <?php tha_header_before(); ?>
  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>
  <?php tha_header_after(); ?>

  <div class="wrap container" role="document">
    <div class="content row">
      <?php tha_content_before(); ?>
      <div class="main <?php echo roots_main_class(); ?>" role="main">
        <?php tha_content_top(); ?>
        <?php include roots_template_path(); ?>
        <?php tha_content_bottom(); ?>
      </div><!-- /.main -->
      <?php tha_content_after(); ?>
      <?php if (roots_display_sidebar()) : ?>
      <?php tha_sidebars_before(); ?>
      <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
        <?php tha_sidebar_top(); ?>
        <?php include roots_sidebar_path(); ?>
        <?php tha_sidebar_bottom(); ?>
      </aside><!-- /.sidebar -->
      <?php tha_sidebars_after(); ?>
      <?php endif; ?>
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

</body>
</html>
