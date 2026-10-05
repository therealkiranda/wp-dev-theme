<?php if(!defined('ABSPATH')) exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>><head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content">Skip to content</a>
<header class="site-header" id="site-header">
  <div class="container header-inner">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Kiran Khadka home">
      <span class="brand-mark" aria-hidden="true">KK</span><span class="brand-name">Kiran Khadka</span>
    </a>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu" aria-label="Open menu">
      <span class="menu-icon"><i></i><i></i></span><span class="screen-reader-text">Menu</span>
    </button>
  </div>
</header>
<div class="nav-backdrop" data-menu-close></div>
<nav class="main-nav" id="primary-menu" aria-label="Primary Navigation" aria-hidden="true">
  <div class="nav-drawer-head">
    <span class="nav-label">Navigation</span>
    <button class="nav-close" type="button" data-menu-close aria-label="Close menu">×</button>
  </div>
  <div class="nav-drawer-links">
  <?php
  if (has_nav_menu('primary')) {
    wp_nav_menu(['theme_location'=>'primary','container'=>false,'fallback_cb'=>false,'items_wrap'=>'%3$s']);
  } else {
    $links = [
      'Home' => home_url('/'),
      'About' => kk_page_url('about', home_url('/#about')),
      'Experience' => kk_page_url('experience', home_url('/#experience')),
      'Expertise' => kk_page_url('expertise', home_url('/#capabilities')),
      'Work' => get_post_type_archive_link('kk_project') ?: home_url('/#work'),
      'Blog' => kk_page_url('blog', home_url('/#writing')),
      'Resume' => kk_page_url('resume', home_url('/#experience')),
      'Contact' => kk_page_url('contact', home_url('/#contact')),
    ];
    foreach($links as $label=>$url) echo '<a href="'.esc_url($url).'">'.esc_html($label).'</a>';
  }
  ?>
  </div>
  <div class="nav-drawer-foot"><span><?php echo esc_html(kk_get('kk_location') ?: 'Kathmandu, Nepal'); ?></span><a href="mailto:<?php echo antispambot(sanitize_email(kk_get('kk_email'))); ?>">Email ↗</a></div>
</nav>
