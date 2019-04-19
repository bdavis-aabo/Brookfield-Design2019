<?php if($_GET['community']): $_community = $_GET['community']; endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
  <?php
  	if(function_exists('is_tag') && is_tag()) {
      	echo 'Tag Archive for &quot;' . $tag . '&quot; - ';
  	} elseif(is_archive()) {
      	wp_title(''); echo ' Archive - ';
  	} elseif(is_search()) {
      	echo 'Search for &quot;' . wp_specialchars($s) . '&quot; - ';
  	} elseif(!(is_404()) && (is_single()) || (is_page()) && !(is_front_page())) {
      	wp_title('');
  	} elseif(is_404()) {
      	echo 'Page Not Found - ';
  	} elseif(is_front_page()){
      	bloginfo('name');
  	} elseif(is_home()){
      	echo 'Latest News - '; bloginfo('name');
  	}
  ?>
  </title>

  <?php //seo plugin grabs page title ?>

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="shortcut icon" href="<?php bloginfo('template_directory') ?>/assets/images/favicon.png" type="image/x-icon" />

  <?php /* Load CSS in functions.php */ ?>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <?php wp_head() ?>
</head>
<body <?php body_class(); ?> <?php echo esc_html(get_page_template_slug($post->ID)) ?>>

  <header class="sidebar-header collapsed">
    <div class="navbtn-container">
      <button class="nav-btn">
        <span class="nav-iconbar"></span>
        <span class="nav-iconbar"></span>
        <span class="nav-iconbar"></span>
        <span class="nav-iconbar"></span>
      </button>
      <span class="legend">menu</span>
    </div>

    <nav class="nav icon-nav">
      <?php if(!is_front_page || !is_page('community-map')): ?>
        <a href="<?php bloginfo('url') ?>" title="<?php bloginfo('name') ?>">
          <img src="<?php bloginfo('template_directory') ?>/assets/images/location-icon@2x.png" alt="" />
          Location Map
        </a>
      <?php endif; ?>
      <?php if($_community): ?>
        <a href="<?php bloginfo('url'); echo '/'.$_GET['community'] ?>">
          <img src="<?php bloginfo('template_directory') ?>/assets/images/community-icon@2x.png" alt="" />
          <?php echo str_replace('-',' ', $_community) ?>
        </a>
      <?php elseif(is_page_template('page-templates/page-community.php')): ?>
        <a href="<?php the_permalink(); ?>">
          <img src="<?php bloginfo('template_directory') ?>/assets/images/community-icon@2x.png" alt="" />
          <?php the_title(); ?>
        </a>
      <?php endif; ?>

    </nav>


    <img src="<?php bloginfo('template_directory') ?>/assets/images/designstudio-logo_vert.png" srcset="<?php bloginfo('template_directory') ?>/assets/images/designstudio-logo_vert@2x.png 1024w" alt="<?php bloginfo('name') ?>" class="brand-logo collapsed" />

    <img src="<?php bloginfo('template_directory') ?>/assets/images/designstudio-logo.jpg" srcset="<?php bloginfo('template_directory') ?>/assets/images/designstudio-logo@2x.jpg 1024w" alt="<?php bloginfo('name') ?>" class="brand-logo expanded" />
  </header>
