<?php /* Template Name: Page - Community */ ?>

<?php get_header() ?>

  <?php while(have_posts()): the_post(); $_heroImage = get_field('community_hero_image'); ?>
  <?php
    $_portfolios = new WP_Query();
    $_args = array(
      'post_type' => 'portfolios',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'order' => 'ASC',
      'orderby' => 'title',
      'community' =>  $post->post_name,
    );
    $_portfolios->query($_args);

    $_current = $post->post_name;
  ?>
  <section class="community-section <?php echo $post->post_name.'-section' ?>" style="background: url('<?php echo $_heroImage['url'] ?>') no-repeat left top; background-size: cover;">
    <div class="portfolio-container closed">
      <button class="expand-portfolios">
        View Portfolios
        <div class="spin"><img src="<?php bloginfo('template_directory') ?>/assets/images/chevron-down-solid.svg"/></div>
      </button>
      <?php if($_portfolios->have_posts()): while($_portfolios->have_posts()): $_portfolios->the_post(); ?>
        <div class="portfolio-links">
          <a href="/porfolio/<?php echo $post->post_name.'?community='.$_current ?>" class="portfolio-logo">insert logo</a>
        </div>
        <?php the_title() ?>
      <?php endwhile; endif; wp_reset_query(); ?>
    </div>
  </section>
  <?php endwhile; ?>

<?php get_footer() ?>
