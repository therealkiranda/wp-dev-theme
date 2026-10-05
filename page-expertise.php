<?php get_header(); ?>
<header class="page-hero"><div class="narrow"><div class="eyebrow">03 / Expertise</div><h1>Across<br><em>the stack.</em></h1></div></header>
<main id="content" class="article"><div class="narrow expertise-page">
<?php $items=[['01','Web Applications','React · Node.js · PHP · Laravel · MySQL','Business systems, dashboards, APIs and responsive web products built around real workflows.'],['02','Mobile Products','Flutter · Android · iOS','Cross-platform and native mobile experiences with an emphasis on useful, dependable interfaces.'],['03','Cloud & Infrastructure','AWS · GCP · Cloud Management','Deployment, hosting, infrastructure and production-minded operations across modern cloud platforms.']]; foreach($items as $item): ?>
<section class="expertise-row"><div class="timeline-year"><?php echo esc_html($item[0]); ?></div><div><h2><?php echo esc_html($item[1]); ?></h2><div class="expertise-stack"><?php echo esc_html($item[2]); ?></div><p><?php echo esc_html($item[3]); ?></p></div></section>
<?php endforeach; ?>
<div class="placeholder-note"><span>Editable area</span><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Add deeper specialties, preferred tools, architecture patterns or services here.</p></div>
</div></main><?php get_footer(); ?>
