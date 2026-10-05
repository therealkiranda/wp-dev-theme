<?php get_header(); while(have_posts()):the_post(); ?>
<header class="page-hero"><div class="narrow"><div class="eyebrow">Page</div><h1><?php the_title(); ?></h1></div></header>
<main id="content" class="article"><div class="narrow"><article class="article-content"><?php the_content(); ?></article></div></main>
<?php endwhile; get_footer(); ?>
