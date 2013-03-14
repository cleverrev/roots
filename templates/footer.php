<?php tha_footer_before(); ?>
<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php tha_footer_top(); ?>
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    <?php tha_footer_bottom(); ?>
  </div>
</footer>
<?php tha_footer_after(); ?>

<?php wp_footer(); ?>
