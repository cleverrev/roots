<?php tha_entry_before(); ?>
<article <?php post_class(); ?>>
  <?php tha_entry_top(); ?>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
  <?php tha_entry_bottom(); ?>
</article>
<?php tha_entry_after(); ?>
