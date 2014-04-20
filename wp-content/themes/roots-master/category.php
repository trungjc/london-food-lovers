

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
<div class="panel">
  <article class="panel-body">
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="head-container">
	<p class="published" datetime="<?php echo get_the_time('c'); ?>">
	<?php echo get_the_date(); ?></p>
	</div>

  </header>

      <?php 
if ( has_post_thumbnail() ) { 
  the_post_thumbnail(medium);
} 
?>
  <div class="entry-summary">



<?php

$content = strip_tags(nl2br(get_the_content('')),"<img><b><strong><i><em><a>");
$trimmed_content = wp_trim_words( $content, 80, '<a href="'. get_permalink() .'"> ...Read More</a>' );
echo $trimmed_content;

?>
  </div>
</article>
</div>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
