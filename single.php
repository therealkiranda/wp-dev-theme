<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<header class="page-hero"><div class="narrow"><div class="eyebrow"><?php echo esc_html(get_post_type() === 'kk_project' ? 'Selected Project' : 'Journal'); ?> · <?php echo esc_html(get_the_date('M d, Y')); ?></div><h1><?php the_title(); ?></h1></div></header>
<main id="content" class="article"><div class="narrow article-grid">
<aside class="article-meta">
<?php if (get_post_type() === 'kk_project') : ?>
<?php $stack = get_post_meta(get_the_ID(), '_kk_stack', true); if ($stack) : echo esc_html($stack); endif; ?>
<?php $url = get_post_meta(get_the_ID(), '_kk_url', true); if ($url) : ?><br><br><a class="text-link" target="_blank" rel="noopener" href="<?php echo esc_url($url); ?>">Live site</a><?php endif; ?>
<?php $github = get_post_meta(get_the_ID(), '_kk_github', true); if ($github) : ?><br><br><a class="text-link" target="_blank" rel="noopener" href="<?php echo esc_url($github); ?>">GitHub</a><?php endif; ?>
<?php else : ?>
By Kiran Khadka<br><?php echo esc_html(get_the_date('M d, Y')); ?>
<?php endif; ?>
</aside>
<article class="article-content"><?php if (has_post_thumbnail()) { the_post_thumbnail('large'); } the_content(); ?></article>
</div></main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
