<?php /* Template Name: Page - Main Screen */ ?>

<?php
  /*
    -get subpages of home
    -get community-buttons and place on page
  */
  $_children = new WP_Query();
  $_args = array(
    'post_type'       => 'page',
    'post_status'     => 'publish',
    'posts_per_page'  => -1,
    'post_parent'     =>  $post->ID,
    'order'           => 'ASC',
    'orderby'         => 'title'
  );
  $_children->query($_args);
?>


<?php get_header() ?>

  <section class="mainpage-section">
    <?php while($_children->have_posts()): $_children->the_post(); $_button = get_field('community_button'); ?>
      <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="<?php echo $post->post_name.'-button' ?> community-button">
        <img src="<?php echo $_button['url'] ?>" class="community-button-image" alt="<?php the_title() ?>" />
      </a>
    <?php endwhile; ?>
  </section>

<?php get_footer() ?>
