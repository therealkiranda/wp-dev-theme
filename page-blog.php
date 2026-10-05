<?php get_header(); ?>
<header class="page-hero"><div class="narrow"><div class="eyebrow">04 / Writing</div><h1>Notes from<br><em>the stack.</em></h1></div></header>
<main id="content" class="article"><div class="narrow"><div class="blog-list-page">
<?php $posts=new WP_Query(['post_type'=>'post','posts_per_page'=>12,'post_status'=>'publish']); if($posts->have_posts()): while($posts->have_posts()):$posts->the_post(); ?>
<article class="blog-list-item"><div class="timeline-year"><?php echo esc_html(get_the_date('M Y')); ?></div><div><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><p><?php echo esc_html(kk_excerpt(get_the_excerpt(),30)); ?></p><a class="text-link" href="<?php the_permalink(); ?>">Read article</a></div></article>
<?php endwhile; wp_reset_postdata(); else: ?><div class="placeholder-note"><span>Blog</span><p>No published notes yet. Create your first post from WordPress → Posts. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div><?php endif; ?>
</div></div></main><?php get_footer(); ?>
