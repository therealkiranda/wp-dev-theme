<?php get_header(); ?>
<header class="page-hero"><div class="narrow"><div class="eyebrow">Work / Public archive</div><h1>Selected<br><em>work.</em></h1></div></header>
<main id="content" class="article"><div class="narrow"><div class="work-list light-work">
<?php if(have_posts()): $i=1; while(have_posts()):the_post(); $stack=get_post_meta(get_the_ID(),'_kk_stack',true); ?>
<article class="work-item light-item"><div class="work-index">0<?php echo esc_html($i++); ?></div><div class="work-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div><div class="work-stack"><?php echo esc_html($stack); ?></div><a class="work-link" href="<?php the_permalink(); ?>">View project</a></article>
<?php endwhile; else: ?><div class="placeholder-note"><span>Public work</span><p>No public projects have been added yet. Add one from WordPress → Projects.</p></div><?php endif; ?>
</div></div></main><?php get_footer(); ?>
