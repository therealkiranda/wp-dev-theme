<?php if(!defined('ABSPATH')) exit; ?>
<footer class="site-footer"><div class="container footer-grid">
<div><div class="footer-brand">Kiran Khadka.</div><div class="footer-small">Full Stack Developer · <?php echo esc_html(kk_get('kk_location')); ?></div></div>
<div class="footer-links">
<a href="<?php echo esc_url(kk_get('kk_github')); ?>" target="_blank" rel="noopener">GitHub</a>
<?php if(kk_get('kk_linkedin')): ?><a href="<?php echo esc_url(kk_get('kk_linkedin')); ?>" target="_blank" rel="noopener">LinkedIn</a><?php endif; ?>
<a href="mailto:<?php echo antispambot(sanitize_email(kk_get('kk_email'))); ?>">Email</a>
</div><div class="footer-small">© <?php echo esc_html(wp_date('Y')); ?> Kiran Khadka</div></div></footer>
<?php wp_footer(); ?></body></html>
