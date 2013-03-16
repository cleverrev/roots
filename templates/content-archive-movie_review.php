<?php if (!have_posts()) : ?>
  <div class="alert">
    <?php _e('Sorry, no movie reviews... YET!', 'roots'); ?>
  </div>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-summary">
      Movie Review: <?php the_excerpt(); ?> <a href="<?php the_permalink(); ?>">Read more...</a>
    </div>
  </article>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <?php if (get_next_posts_link()) : ?>
        <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <?php endif; ?>
      <?php if (get_previous_posts_link()) : ?>
        <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
      <?php endif; ?>
    </ul>
  </nav>
<?php endif; ?>
