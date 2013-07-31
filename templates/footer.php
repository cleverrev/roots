<?php tha_footer_before(); ?>
<footer class="content-info container" role="contentinfo">
  <?php tha_footer_top(); ?>
  <div class="row">
    <div class="col-lg-12">
      <?php dynamic_sidebar('sidebar-footer'); ?>
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    </div>
    <?php tha_footer_bottom(); ?>
  </div>
</footer>
<?php tha_footer_after(); ?>

<?php wp_footer(); ?>
