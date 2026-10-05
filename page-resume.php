<?php get_header(); ?>
<header class="page-hero"><div class="narrow"><div class="eyebrow">05 / Resume</div><h1>The<br><em>short version.</em></h1></div></header>
<main id="content" class="article"><div class="narrow resume-page">
<section class="resume-block"><div class="timeline-year">PROFILE</div><div><h2><?php echo esc_html(kk_get('kk_role')); ?></h2><p><?php echo esc_html(kk_get('kk_bio')); ?></p></div></section>
<section class="resume-block"><div class="timeline-year">EXPERIENCE</div><div><h2>Managing Director</h2><div class="timeline-company"><?php echo esc_html(kk_get('kk_company')); ?> · <?php echo esc_html(kk_get('kk_company_years')); ?></div><p>Technology leadership alongside hands-on full-stack development, cloud management and product delivery.</p></div></section>
<section class="resume-block"><div class="timeline-year">STACK</div><div><div class="resume-tags"><span>React</span><span>Node.js</span><span>PHP</span><span>Laravel</span><span>MySQL</span><span>Flutter</span><span>Android</span><span>iOS</span><span>AWS</span><span>GCP</span></div></div></section>
<div class="placeholder-note"><span>Editable area</span><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Use this space for selected achievements, earlier roles or a downloadable CV when you are ready.</p></div>
</div></main><?php get_footer(); ?>
