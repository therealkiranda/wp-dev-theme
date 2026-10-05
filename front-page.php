<?php get_header(); $o=wdt_options(); ?>
<main id="content">
<section class="hero" aria-labelledby="hero-title"><div class="hero-grid">
  <div class="hero-copy">
    <div class="hero-kicker eyebrow reveal"><?php echo esc_html($o['location']); ?> · <?php echo esc_html($o['years']); ?></div>
    <h1 id="hero-title" class="reveal delay-1"><span>Kiran</span><span class="outline">Khadka</span></h1>
    <div class="hero-bottom reveal delay-2">
      <p class="hero-intro"><?php echo esc_html($o['hero_intro']); ?></p>
      <div class="hero-meta" aria-label="Professional summary">
        <div class="meta-row"><span>Role</span><span><?php echo esc_html($o['role']); ?></span></div>
        <div class="meta-row"><span>Now</span><span><?php echo esc_html($o['company_period']); ?></span></div>
        <div class="meta-row"><span>Focus</span><span>Web · Mobile · Cloud</span></div>
      </div>
    </div>
  </div>
  <div class="hero-portrait-wrap reveal delay-2"><figure class="hero-portrait"><img src="<?php echo esc_url(wdt_photo_url()); ?>" alt="Kiran Khadka — Full Stack Developer" width="1521" height="1536" fetchpriority="high"><figcaption class="portrait-caption">Software / Systems / Craft</figcaption></figure></div>
</div><div class="scroll-cue">Scroll to explore</div></section>

<section class="section section-dark" id="about" aria-labelledby="about-title"><div class="container">
<div class="section-head reveal"><div class="section-num">01 / About</div><div><h2 id="about-title" class="section-title">I build <em>software.</em></h2></div></div>
<div class="manifesto"><h3 class="manifesto-big reveal">From <span>interface</span><br>to infrastructure.</h3><div class="reveal delay-1"><p class="lede"><?php echo esc_html($o['about']); ?></p><div class="tech-line" aria-label="Technology expertise">
<?php foreach(array_filter(array_map('trim',preg_split('/[,]+/',$o['tech_stack']))) as $tech): ?><span><?php echo esc_html($tech); ?></span><?php endforeach; ?></div></div></div>
</div></section>

<section class="section" id="capabilities" aria-labelledby="expertise-title"><div class="container">
<div class="section-head reveal"><div class="section-num">02 / Expertise</div><div><h2 id="expertise-title" class="section-title">Built across<br><em>the stack.</em></h2></div></div>
<div class="cap-grid reveal">
<?php for($i=1;$i<=3;$i++): ?><article class="cap"><div class="cap-num">0<?php echo $i; ?></div><h3><?php echo nl2br(esc_html($o["expertise_{$i}_title"])); ?></h3><p><?php echo esc_html($o["expertise_{$i}_text"]); ?></p><div class="cap-tags"><?php echo esc_html($o["expertise_{$i}_tags"]); ?></div></article><?php endfor; ?>
</div></div></section>

<section class="section section-dark" id="work" aria-labelledby="work-title"><div class="container">
<div class="section-head reveal"><div class="section-num">03 / Selected Work</div><div><h2 id="work-title" class="section-title">Public work,<br><em>carefully selected.</em></h2></div></div>
<?php $projects=new WP_Query(['post_type'=>'kk_project','posts_per_page'=>8,'post_status'=>'publish','orderby'=>'menu_order date','order'=>'DESC']); ?>
<div class="work-list reveal">
<?php if($projects->have_posts()): $i=1; while($projects->have_posts()): $projects->the_post(); $stack=get_post_meta(get_the_ID(),'_kk_stack',true); ?><article class="work-item"><div class="work-index"><?php echo esc_html(str_pad((string)$i++,2,'0',STR_PAD_LEFT)); ?></div><div class="work-name"><?php the_title(); ?></div><div class="work-stack"><?php echo esc_html($stack); ?></div><a class="work-link" href="<?php echo esc_url(get_permalink()); ?>">View project</a></article><?php endwhile; wp_reset_postdata(); else: ?><div class="work-empty"><p>Professional client work is intentionally kept private. This archive is reserved for public, personal and shareable work. Add projects from <strong>WordPress → Projects</strong> when there is something worth showing.</p><a class="text-link" href="<?php echo esc_url($o['github']); ?>" target="_blank" rel="me noopener">Explore GitHub</a></div><?php endif; ?>
</div></div></section>

<section class="section section-dark" id="experience" aria-labelledby="experience-title"><div class="container"><div class="section-head reveal"><div class="section-num">04 / Experience</div><div><h2 id="experience-title" class="section-title">15+ years<br><em>building.</em></h2></div></div>
<div class="experience-grid"><h3 class="experience-main reveal">Software<br>is a craft.</h3><div class="reveal delay-1"><div class="experience-card"><div class="experience-year"><?php echo esc_html($o['company_period']); ?></div><div class="experience-role"><?php echo esc_html($o['experience_role']); ?></div><div class="experience-company"><?php echo esc_html($o['company']); ?></div><p class="experience-copy"><?php echo esc_html($o['experience_text']); ?></p></div><div style="margin-top:60px"><a class="text-link" href="<?php echo esc_url($o['github']); ?>" target="_blank" rel="me noopener">Public code on GitHub</a></div></div></div>
</div></section>

<section class="section section-dark" id="writing" aria-labelledby="writing-title"><div class="container"><div class="section-head reveal"><div class="section-num">05 / Writing</div><div><h2 id="writing-title" class="section-title">Notes from<br><em>the stack.</em></h2></div></div>
<?php $posts=new WP_Query(['post_type'=>'post','posts_per_page'=>3,'post_status'=>'publish']); if($posts->have_posts()): ?><div class="blog-grid reveal"><?php while($posts->have_posts()):$posts->the_post(); ?><article class="post-card"><div class="post-date"><?php echo esc_html(get_the_date('M d, Y')); ?></div><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo esc_html(wdt_excerpt(get_the_excerpt(),22)); ?></p></article><?php endwhile; wp_reset_postdata(); ?></div><?php else: ?><div class="blog-empty reveal">No published notes yet. When there is something useful to say, this becomes the journal—not a feed of filler.</div><?php endif; ?></div></section>

<section class="section contact" id="contact" aria-labelledby="contact-title"><div class="container contact-grid"><div><div class="eyebrow">06 / Contact</div><h2 id="contact-title" class="contact-title reveal">Let's build<br><em>something</em><br>worthwhile.</h2></div><div class="reveal delay-1"><p class="contact-copy">For collaborations, public projects, technical conversations or simply saying hello.</p><a class="contact-email" href="mailto:<?php echo antispambot(sanitize_email($o['email'])); ?>"><?php echo esc_html($o['email']); ?></a><div class="contact-meta"><a href="<?php echo esc_url($o['github']); ?>" target="_blank" rel="me noopener">GitHub ↗</a><?php if($o['linkedin']): ?><a href="<?php echo esc_url($o['linkedin']); ?>" target="_blank" rel="me noopener">LinkedIn ↗</a><?php endif; ?><a href="<?php echo esc_url($o['company_site']); ?>" target="_blank" rel="noopener">Prime Logic IT ↗</a></div></div></div></section>
</main><?php get_footer(); ?>
