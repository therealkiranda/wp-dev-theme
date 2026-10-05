<?php
if (!defined('ABSPATH')) exit;

/** Core setup. */
function wdt_theme_setup() {
    load_theme_textdomain('wp-dev-theme', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('custom-logo', ['height'=>100,'width'=>300,'flex-height'=>true,'flex-width'=>true]);
    register_nav_menus(['primary'=>'Primary Navigation','footer'=>'Footer Navigation']);
    add_image_size('wdt-hero', 1200, 1500, true);
}
add_action('after_setup_theme','wdt_theme_setup');

function wdt_defaults() {
    return [
        'name'=>'Kiran Khadka',
        'role'=>'Full Stack Developer',
        'location'=>'Kathmandu, Nepal',
        'years'=>'15+ years',
        'company'=>'Prime Logic Information Technology Pvt. Ltd.',
        'company_period'=>'2022 — Present',
        'email'=>'info@khadkakiran.com.np',
        'website'=>'https://khadkakiran.com.np',
        'github'=>'https://github.com/therealkiranda',
        'company_site'=>'https://primelogic.com.np',
        'linkedin'=>'', 'x'=>'', 'instagram'=>'',
        'photo'=>'',
        'hero_intro'=>'I build web applications, mobile products and cloud systems with a focus on clarity, reliability and long-term value.',
        'about'=>'A full-stack developer with more than 15 years of experience across web, mobile and cloud technologies. I work across the stack—from product interfaces and APIs to deployment, infrastructure and the details that make software dependable.',
        'about_long'=>'I am a software developer focused on building useful, maintainable digital products. My work spans frontend interfaces, backend systems, databases, mobile applications and cloud infrastructure. Professional client work is intentionally kept private; this site focuses on public work, technical writing and the craft behind the software.',
        'expertise_1_title'=>'Web Applications',
        'expertise_1_text'=>'Product interfaces, dashboards, APIs and business systems designed around real workflows.',
        'expertise_1_tags'=>'React · Node.js · PHP · Laravel · MySQL',
        'expertise_2_title'=>'Mobile Products',
        'expertise_2_text'=>'Cross-platform and native experiences for Android and iOS, with Flutter where it makes sense.',
        'expertise_2_tags'=>'Flutter · Android · iOS',
        'expertise_3_title'=>'Cloud & Infrastructure',
        'expertise_3_text'=>'Deployment, hosting, cloud management and production-minded infrastructure across modern platforms.',
        'expertise_3_tags'=>'AWS · GCP · Cloud Management',
        'experience_role'=>'Managing Director',
        'experience_text'=>'Leading technology work while staying close to software: architecture, development, cloud infrastructure and the practical details behind reliable digital products.',
        'tech_stack'=>'React, Node.js, PHP, Laravel, MySQL, Flutter, Android, iOS, AWS, Google Cloud, Cloud Management',
        'seo_title'=>'Kiran Khadka — Full Stack Developer in Kathmandu, Nepal',
        'seo_description'=>'Kiran Khadka is a full stack developer in Kathmandu, Nepal with 15+ years of experience building web applications, mobile apps and cloud systems.',
        'seo_keywords'=>'',
        'og_image'=>'',
        'google_verification'=>'',
        'bing_verification'=>'',
        'github_repo'=>'https://github.com/therealkiranda/wp-dev-theme',
        'github_branch'=>'main',
        'auto_update'=>'0',
        'release_channel'=>'stable',
        'animations'=>'1',
        'performance_fonts'=>'1',
        'remove_emoji'=>'1',
        'custom_css'=>'',
        'custom_js'=>'',
    ];
}

function wdt_options() {
    $saved = get_option('wp_dev_theme_options', []);
    if (!is_array($saved)) $saved = [];
    return wp_parse_args($saved, wdt_defaults());
}
function wdt_get($key, $default='') {
    $o = wdt_options();
    if (array_key_exists($key, $o) && $o[$key] !== '') return $o[$key];
    $legacy = [
        'role'=>'kk_role','location'=>'kk_location','years'=>'kk_years','company'=>'kk_company','company_period'=>'kk_company_years',
        'email'=>'kk_email','github'=>'kk_github','website'=>'kk_site','company_site'=>'kk_company_site','hero_intro'=>'kk_intro','about'=>'kk_bio','photo'=>'kk_photo'
    ];
    if (isset($legacy[$key])) {
        $v = get_theme_mod($legacy[$key], '');
        if ($v !== '') return $v;
    }
    return $default !== '' ? $default : ($o[$key] ?? '');
}
function wdt_photo_url() {
    $photo = wdt_get('photo');
    return $photo ?: get_template_directory_uri() . '/assets/images/profile.jpg';
}


/* Backward-compatible template helpers from earlier theme builds. */
function kk_get($key){
    $map=['kk_role'=>'role','kk_location'=>'location','kk_years'=>'years','kk_company'=>'company','kk_company_years'=>'company_period','kk_email'=>'email','kk_github'=>'github','kk_site'=>'website','kk_company_site'=>'company_site','kk_intro'=>'hero_intro','kk_bio'=>'about','kk_photo'=>'photo','kk_linkedin'=>'linkedin'];
    return wdt_get($map[$key]??$key);
}
function kk_profile_photo(){ return esc_url(wdt_photo_url()); }
function kk_page_url($slug,$fallback=''){ return wdt_page_url($slug,$fallback); }
function kk_excerpt($text,$words=24){ return wdt_excerpt($text,$words); }

/** Assets. */
function wdt_assets() {
    $ver = wp_get_theme()->get('Version');
    wp_enqueue_style('wdt-style', get_stylesheet_uri(), [], $ver);
    wp_enqueue_script('wdt-main', get_template_directory_uri() . '/assets/js/main.js', [], $ver, true);
    wp_localize_script('wdt-main','WDTTheme',['home'=>esc_url_raw(home_url('/')),'animations'=>wdt_get('animations','1')]);
    if (wdt_get('custom_css')) wp_add_inline_style('wdt-style', wdt_get('custom_css'));
    if (wdt_get('custom_js') && current_user_can('manage_options')) wp_add_inline_script('wdt-main', "\n" . wdt_get('custom_js') . "\n");
}
add_action('wp_enqueue_scripts','wdt_assets');

/** Admin options. One control center for the entire theme. */
function wdt_admin_menu() {
    add_menu_page('WP Dev Theme','WP Dev Theme','manage_options','wp-dev-theme','wdt_settings_page','dashicons-admin-customizer',58);
}
add_action('admin_menu','wdt_admin_menu');
function wdt_register_settings() {
    register_setting('wdt_settings_group','wp_dev_theme_options',['sanitize_callback'=>'wdt_sanitize_options']);
}
add_action('admin_init','wdt_register_settings');
function wdt_sanitize_options($input) {
    $d=wdt_defaults(); $out=[];
    foreach($d as $k=>$v){
        $val=$input[$k] ?? $v;
        if (in_array($k,['email'],true)) $out[$k]=sanitize_email($val);
        elseif (in_array($k,['website','github','company_site','linkedin','x','instagram','photo','og_image','github_repo'],true)) $out[$k]=esc_url_raw($val);
        elseif (in_array($k,['animations','performance_fonts','remove_emoji','auto_update'],true)) $out[$k]=!empty($val)?'1':'0';
        elseif (in_array($k,['hero_intro','about','about_long','expertise_1_text','expertise_2_text','expertise_3_text','experience_text','custom_css','custom_js'],true)) $out[$k]=($k==='custom_css'||$k==='custom_js') ? wp_strip_all_tags($val) : sanitize_textarea_field($val);
        else $out[$k]=sanitize_text_field($val);
    }
    return $out;
}
function wdt_settings_page() {
    if (!current_user_can('manage_options')) return;
    $o=wdt_options();
    $tabs=[
        'identity'=>'Identity','hero'=>'Hero','about'=>'About','expertise'=>'Expertise','experience'=>'Experience','contact'=>'Contact','seo'=>'SEO','performance'=>'Performance','updates'=>'Updates','advanced'=>'Advanced'
    ];
    $tab=sanitize_key($_GET['tab']??'identity'); if(!isset($tabs[$tab])) $tab='identity';
    ?>
    <div class="wrap wdt-admin"><h1>WP Dev Theme <span class="wdt-version">v<?php echo esc_html(wp_get_theme()->get('Version')); ?></span></h1>
    <p class="description">One control center for the visual identity, content defaults, SEO, performance and GitHub update channel.</p>
    <nav class="wdt-tabs"><?php foreach($tabs as $id=>$label): ?><a class="<?php echo $tab===$id?'active':''; ?>" href="<?php echo esc_url(admin_url('admin.php?page=wp-dev-theme&tab='.$id)); ?>"><?php echo esc_html($label); ?></a><?php endforeach; ?></nav>
    <form method="post" action="options.php">
    <?php settings_fields('wdt_settings_group'); ?>
    <div class="wdt-panel">
    <?php wdt_render_tab($tab,$o); ?>
    </div>
    <?php submit_button('Save WP Dev Theme Settings'); ?>
    </form>
    </div>
    <style>.wdt-admin{max-width:1100px}.wdt-version{font-size:12px;font-weight:500;background:#111;color:#fff;padding:5px 8px;margin-left:8px;border-radius:3px}.wdt-tabs{display:flex;flex-wrap:wrap;gap:4px;margin:25px 0 0}.wdt-tabs a{padding:11px 14px;text-decoration:none;border:1px solid #dcdcde;background:#fff;color:#1d2327}.wdt-tabs a.active{background:#111;color:#fff;border-color:#111}.wdt-panel{background:#fff;border:1px solid #dcdcde;padding:26px;margin-top:12px}.wdt-grid{display:grid;grid-template-columns:1fr 1fr;gap:22px}.wdt-field{margin-bottom:20px}.wdt-field label{display:block;font-weight:600;margin-bottom:7px}.wdt-field input,.wdt-field textarea{width:100%;max-width:none}.wdt-field textarea{min-height:110px}.wdt-help{color:#646970;font-size:12px}.wdt-section-title{font-size:20px;border-bottom:1px solid #eee;padding-bottom:10px;margin:4px 0 24px}.wdt-wide{grid-column:1/-1}@media(max-width:800px){.wdt-grid{grid-template-columns:1fr}}</style>
    <?php
}
function wdt_field($o,$key,$label,$type='text',$wide=false,$help='') {
    $v=$o[$key]??''; echo '<div class="wdt-field'.($wide?' wdt-wide':'').'">'; echo '<label for="wdt-'.$key.'">'.esc_html($label).'</label>';
    if($type==='textarea') echo '<textarea id="wdt-'.esc_attr($key).'" name="wp_dev_theme_options['.esc_attr($key).']">'.esc_textarea($v).'</textarea>';
    elseif($type==='checkbox') echo '<label style="font-weight:400"><input type="checkbox" id="wdt-'.esc_attr($key).'" name="wp_dev_theme_options['.esc_attr($key).']" value="1" '.checked($v,'1',false).'> Enable</label>';
    else echo '<input type="'.esc_attr($type).'" id="wdt-'.esc_attr($key).'" name="wp_dev_theme_options['.esc_attr($key).']" value="'.esc_attr($v).'">';
    if($help) echo '<p class="wdt-help">'.esc_html($help).'</p>'; echo '</div>';
}
function wdt_render_tab($tab,$o){
    switch($tab){
        case 'identity': echo '<h2 class="wdt-section-title">Personal identity</h2><div class="wdt-grid">'; wdt_field($o,'name','Display name'); wdt_field($o,'role','Primary role'); wdt_field($o,'location','Location'); wdt_field($o,'years','Experience label'); wdt_field($o,'company','Current company'); wdt_field($o,'company_period','Company period'); wdt_field($o,'website','Website','url'); wdt_field($o,'photo','Profile photo URL','url',false,'Use a crawlable image URL. A bundled portrait is used by default.'); echo '</div>'; break;
        case 'hero': echo '<h2 class="wdt-section-title">Hero and first impression</h2><div class="wdt-grid">'; wdt_field($o,'hero_intro','Hero introduction','textarea',true); wdt_field($o,'tech_stack','Technology stack / expertise labels','textarea',true,'Used as concise technical metadata; do not stuff keywords.'); echo '</div>'; break;
        case 'about': echo '<h2 class="wdt-section-title">About</h2><div class="wdt-grid">'; wdt_field($o,'about','Short about text','textarea',true); wdt_field($o,'about_long','Long-form about text','textarea',true); echo '</div>'; break;
        case 'expertise': echo '<h2 class="wdt-section-title">Expertise cards</h2><div class="wdt-grid">'; for($i=1;$i<=3;$i++){ echo '<div class="wdt-wide"><h3>Expertise '.$i.'</h3></div>'; wdt_field($o,"expertise_{$i}_title",'Title'); wdt_field($o,"expertise_{$i}_tags",'Technology tags'); wdt_field($o,"expertise_{$i}_text",'Description','textarea',true); } echo '</div>'; break;
        case 'experience': echo '<h2 class="wdt-section-title">Experience</h2><div class="wdt-grid">'; wdt_field($o,'experience_role','Current role'); wdt_field($o,'company_period','Period'); wdt_field($o,'company','Company'); wdt_field($o,'experience_text','Experience description','textarea',true); echo '</div>'; break;
        case 'contact': echo '<h2 class="wdt-section-title">Contact and social identity</h2><div class="wdt-grid">'; wdt_field($o,'email','Public email','email'); wdt_field($o,'github','GitHub','url'); wdt_field($o,'company_site','Company website','url'); wdt_field($o,'linkedin','LinkedIn','url'); wdt_field($o,'x','X / Twitter','url'); wdt_field($o,'instagram','Instagram','url'); echo '</div>'; break;
        case 'seo': echo '<h2 class="wdt-section-title">Search and entity SEO</h2><div class="wdt-grid">'; wdt_field($o,'seo_title','Default SEO title','text',true); wdt_field($o,'seo_description','Default meta description','textarea',true); wdt_field($o,'seo_keywords','Optional keywords','text',true,'Leave empty unless there is a genuine reason. The theme does not keyword-stuff pages.'); wdt_field($o,'og_image','Default social image','url'); wdt_field($o,'google_verification','Google Search Console verification token'); wdt_field($o,'bing_verification','Bing Webmaster verification token'); echo '</div>'; break;
        case 'performance': echo '<h2 class="wdt-section-title">Performance and motion</h2><div class="wdt-grid">'; wdt_field($o,'animations','Reveal animations','checkbox'); wdt_field($o,'performance_fonts','Use lightweight system fonts','checkbox'); wdt_field($o,'remove_emoji','Remove WordPress emoji assets','checkbox'); echo '</div>'; break;
        case 'updates': echo '<h2 class="wdt-section-title">GitHub updates</h2><div class="wdt-grid">'; wdt_field($o,'github_repo','GitHub repository','url',true,'Create this repository and publish releases there. Example: https://github.com/therealkiranda/wp-dev-theme'); wdt_field($o,'github_branch','Development branch'); wdt_field($o,'release_channel','Release channel'); wdt_field($o,'auto_update','Enable automatic theme updates','checkbox',true,'WordPress also exposes a per-theme automatic-update switch.'); echo '</div><p class="wdt-help">The theme checks the latest GitHub Release and can expose it through WordPress updates. Release ZIPs must contain the wp-dev-theme folder and use the same version as style.css.</p>'; break;
        case 'advanced': echo '<h2 class="wdt-section-title">Advanced</h2><div class="wdt-grid">'; wdt_field($o,'custom_css','Custom CSS','textarea',true); wdt_field($o,'custom_js','Custom JS (admin only)','textarea',true,'Only printed for administrators. Avoid third-party scripts unless necessary.'); echo '</div>'; break;
    }
}

/** Projects CPT. */
function wdt_register_projects(){
    register_post_type('kk_project',[
        'labels'=>['name'=>'Projects','singular_name'=>'Project','add_new_item'=>'Add Project','edit_item'=>'Edit Project'],
        'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-screenoptions','supports'=>['title','editor','thumbnail','excerpt','page-attributes'],
        'has_archive'=>true,'rewrite'=>['slug'=>'work'],'show_in_nav_menus'=>true,'map_meta_cap'=>true,
    ]);
}
add_action('init','wdt_register_projects');
function wdt_project_meta(){add_meta_box('kk_project_details','Project Details','wdt_project_meta_html','kk_project','normal','high');}
add_action('add_meta_boxes','wdt_project_meta');
function wdt_project_meta_html($post){
    wp_nonce_field('kk_project_save','kk_project_nonce');
    $fields=['stack'=>'Technology / stack','url'=>'Live URL','github'=>'GitHub URL','year'=>'Year'];
    foreach($fields as $key=>$label){$v=get_post_meta($post->ID,'_kk_'.$key,true);echo '<p><label><strong>'.esc_html($label).'</strong></label><input style="width:100%" name="kk_'.$key.'" value="'.esc_attr($v).'" placeholder="'.esc_attr($key==='stack'?'React · Node.js · AWS':'').'" /></p>';}
}
function wdt_project_save($post_id){
    if(!isset($_POST['kk_project_nonce'])||!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['kk_project_nonce'])),'kk_project_save')) return;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return;if(!current_user_can('edit_post',$post_id))return;
    update_post_meta($post_id,'_kk_stack',sanitize_text_field(wp_unslash($_POST['kk_stack']??'')));
    update_post_meta($post_id,'_kk_url',esc_url_raw(wp_unslash($_POST['kk_url']??'')));
    update_post_meta($post_id,'_kk_github',esc_url_raw(wp_unslash($_POST['kk_github']??'')));
    update_post_meta($post_id,'_kk_year',sanitize_text_field(wp_unslash($_POST['kk_year']??'')));
}
add_action('save_post_kk_project','kk_project_save');

function wdt_page_url($slug,$fallback=''){ $page=get_page_by_path($slug); return $page?get_permalink($page):$fallback; }
function wdt_excerpt($text,$words=24){return wp_trim_words(wp_strip_all_tags($text),$words,'…');}

/** Create starter pages only when switching to this theme. */
function wdt_ensure_pages(){
    $pages=['about'=>'About','experience'=>'Experience','expertise'=>'Expertise','blog'=>'Blog','resume'=>'Resume','contact'=>'Contact'];
    foreach($pages as $slug=>$title){if(!get_page_by_path($slug)) wp_insert_post(['post_title'=>$title,'post_name'=>$slug,'post_status'=>'publish','post_type'=>'page','post_content'=>'']);}
}
add_action('after_switch_theme','wdt_ensure_pages');

/** Migration from the earlier Kiran theme settings. */
function wdt_migrate_legacy(){
    if(get_option('wp_dev_theme_migrated'))return;
    $o=wdt_options();
    $legacy=['role'=>'kk_role','location'=>'kk_location','years'=>'kk_years','company'=>'kk_company','company_period'=>'kk_company_years','email'=>'kk_email','github'=>'kk_github','website'=>'kk_site','company_site'=>'kk_company_site','hero_intro'=>'kk_intro','about'=>'kk_bio','photo'=>'kk_photo'];
    foreach($legacy as $new=>$old){$v=get_theme_mod($old,'');if($v!=='')$o[$new]=$v;}
    update_option('wp_dev_theme_options',$o,false);update_option('wp_dev_theme_migrated','1',false);
}
add_action('after_switch_theme','wdt_migrate_legacy',20);

/** Performance hygiene. */
function wdt_remove_emoji(){if(wdt_get('remove_emoji','1')==='1'){remove_action('wp_head','print_emoji_detection_script',7);remove_action('wp_print_styles','print_emoji_styles');remove_action('admin_print_scripts','print_emoji_detection_script');remove_action('admin_print_styles','print_emoji_styles');}}
add_action('init','wdt_remove_emoji');
function wdt_resource_hints($urls,$relation_type){if('preconnect'===$relation_type)return $urls;return $urls;}
add_filter('wp_resource_hints','wdt_resource_hints',10,2);
function wdt_robots($robots){$robots['max-image-preview']='large';$robots['max-snippet']='-1';$robots['max-video-preview']='-1';return $robots;}
add_filter('wp_robots','wdt_robots');

/** Do not duplicate metadata if a major SEO plugin is active. */
function wdt_has_seo_plugin(){return defined('WPSEO_VERSION')||defined('RANK_MATH_VERSION')||defined('AIOSEO_VERSION')||defined('SEOPRESS_VERSION');}
function wdt_meta_description(){
    if(is_singular() && has_excerpt())return wp_strip_all_tags(get_the_excerpt());
    if(is_front_page()||is_home())return wdt_get('seo_description');
    if(is_page('about'))return wdt_get('about_long');
    if(is_singular('kk_project'))return get_the_excerpt()?:wdt_get('seo_description');
    return wdt_get('seo_description');
}
function wdt_seo_head(){
    if(is_admin()||wdt_has_seo_plugin())return;
    $title=wp_get_document_title();$desc=wdt_meta_description();$url=home_url(add_query_arg([], $GLOBALS['wp']->request??''));
    if(is_singular())$url=get_permalink();elseif(is_front_page())$url=home_url('/');
    $img=wdt_get('og_image')?:wdt_photo_url();
    echo '<meta name="description" content="'.esc_attr(wp_trim_words($desc,45,'')).'">';
    echo '<link rel="canonical" href="'.esc_url($url).'">';
    echo '<meta property="og:type" content="'.(is_single()?'article':'website').'">';
    echo '<meta property="og:title" content="'.esc_attr($title).'">';
    echo '<meta property="og:description" content="'.esc_attr($desc).'">';
    echo '<meta property="og:url" content="'.esc_url($url).'">';
    echo '<meta property="og:site_name" content="'.esc_attr(wdt_get('name')).'">';
    if($img)echo '<meta property="og:image" content="'.esc_url($img).'">';
    echo '<meta name="twitter:card" content="summary_large_image">';
    echo '<meta name="twitter:title" content="'.esc_attr($title).'">';
    echo '<meta name="twitter:description" content="'.esc_attr($desc).'">';
    if($img)echo '<meta name="twitter:image" content="'.esc_url($img).'">';
    if(wdt_get('google_verification'))echo '<meta name="google-site-verification" content="'.esc_attr(wdt_get('google_verification')).'">';
    if(wdt_get('bing_verification'))echo '<meta name="msvalidate.01" content="'.esc_attr(wdt_get('bing_verification')).'">';
}
add_action('wp_head','wdt_seo_head',4);

function wdt_same_as(){
    $a=[];foreach(['github','linkedin','x','instagram'] as $k){$u=wdt_get($k);if($u)$a[]=esc_url_raw($u);}return array_values(array_unique($a));
}
function wdt_person_data(){
    $person=['@type'=>'Person','@id'=>home_url('/#person'),'name'=>wdt_get('name'),'url'=>home_url('/'),'jobTitle'=>wdt_get('role'),'description'=>wdt_get('seo_description'),'image'=>wdt_photo_url(),'address'=>['@type'=>'PostalAddress','addressLocality'=>'Kathmandu','addressCountry'=>'NP'],'knowsAbout'=>array_map('trim',preg_split('/[,\n]+/',wdt_get('tech_stack'))),'sameAs'=>wdt_same_as()];
    if(wdt_get('email'))$person['email']='mailto:'.sanitize_email(wdt_get('email'));
    if(wdt_get('company'))$person['worksFor']=['@type'=>'Organization','name'=>wdt_get('company'),'url'=>wdt_get('company_site')];
    return $person;
}
function wdt_schema(){
    if(is_admin())return;
    $graph=[];$person=wdt_person_data();
    if(is_front_page()){
        $graph[]=$person;$graph[]=['@type'=>'WebSite','@id'=>home_url('/#website'),'url'=>home_url('/'),'name'=>wdt_get('name'),'publisher'=>['@id'=>home_url('/#person')]];
    }elseif(is_page('about')){
        $graph[]=['@type'=>'ProfilePage','@id'=>get_permalink().'#profile','url'=>get_permalink(),'name'=>get_the_title(),'mainEntity'=>['@id'=>home_url('/#person')],'dateModified'=>get_the_modified_date('c')];$graph[]=$person;
    }elseif(is_singular('kk_project')){
        $graph[]=['@type'=>'CreativeWork','@id'=>get_permalink().'#work','url'=>get_permalink(),'name'=>get_the_title(),'description'=>get_the_excerpt(),'author'=>['@id'=>home_url('/#person')],'dateModified'=>get_the_modified_date('c')];
    }elseif(is_singular('post')){
        $graph[]=['@type'=>'Article','@id'=>get_permalink().'#article','url'=>get_permalink(),'headline'=>get_the_title(),'description'=>wdt_meta_description(),'image'=>get_the_post_thumbnail_url(get_the_ID(),'large')?:wdt_photo_url(),'datePublished'=>get_the_date('c'),'dateModified'=>get_the_modified_date('c'),'author'=>['@id'=>home_url('/#person')],'publisher'=>['@id'=>home_url('/#person')]];
    }
    if(!is_front_page()){
        $items=[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>home_url('/')]];
        if(is_page())$items[]=['@type'=>'ListItem','position'=>2,'name'=>get_the_title(),'item'=>get_permalink()];
        if(is_singular('post')||is_singular('kk_project'))$items[]=['@type'=>'ListItem','position'=>2,'name'=>get_post_type_object(get_post_type())->labels->name,'item'=>get_post_type_archive_link(get_post_type())];
        if(is_singular()&&!is_page())$items[]=['@type'=>'ListItem','position'=>3,'name'=>get_the_title(),'item'=>get_permalink()];
        $graph[]=['@type'=>'BreadcrumbList','itemListElement'=>$items];
    }
    if(!$graph)return;
    echo '<script type="application/ld+json">'.wp_json_encode(['@context'=>'https://schema.org','@graph'=>$graph],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
}
add_action('wp_head','wdt_schema',20);

/** GitHub Releases updater. Update URI makes WordPress treat this as a non-directory theme. */
function wdt_github_repo_parts(){
    $repo=trim(wdt_get('github_repo'));
    if(!$repo||!preg_match('~github\.com/([^/]+)/([^/#]+)~i',$repo,$m))return false;
    return [$m[1],preg_replace('/\.git$/','',$m[2])];
}
function wdt_github_update_response($update,$theme_data,$theme_stylesheet,$locales){
    if($theme_stylesheet!=='wp-dev-theme')return $update;
    $parts=wdt_github_repo_parts();if(!$parts)return $update;
    [$owner,$repo]=$parts;$cache_key='wdt_github_release_'.md5($owner.'/'.$repo);$release=get_transient($cache_key);
    if(false===$release){
        $r=wp_remote_get('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/releases/latest',['timeout'=>8,'headers'=>['Accept'=>'application/vnd.github+json','User-Agent'=>'wp-dev-theme/'.wp_get_theme()->get('Version')]]);
        if(is_wp_error($r))return $update;$release=json_decode(wp_remote_retrieve_body($r),true);if(!is_array($release)||empty($release['tag_name']))return $update;set_transient($cache_key,$release,6*HOUR_IN_SECONDS);
    }
    $version=ltrim((string)$release['tag_name'],'v');$current=wp_get_theme()->get('Version');if(!version_compare($version,$current,'>'))return $update;
    $package='';foreach(($release['assets']??[]) as $asset){if(!empty($asset['browser_download_url'])&&preg_match('/\.zip$/i',$asset['name']??'')){$package=$asset['browser_download_url'];break;}}
    if(!$package)$package=$release['zipball_url']??'';if(!$package)return $update;
    return ['id'=>$theme_data['UpdateURI']?:wdt_get('github_repo'),'theme'=>'wp-dev-theme','version'=>$version,'url'=>$release['html_url']??wdt_get('github_repo'),'package'=>$package,'tested'=>get_bloginfo('version'),'requires_php'=>'7.4','autoupdate'=>wdt_get('auto_update','0')==='1'];
}
add_filter('update_themes_github.com','wdt_github_update_response',10,4);
function wdt_force_auto_update($update,$item){if(wdt_get('auto_update','0')==='1'&&isset($item->theme)&&$item->theme==='wp-dev-theme')return true;return $update;}
add_filter('auto_update_theme','wdt_force_auto_update',10,2);

/** Keep WordPress core sitemap as the sitemap source; no duplicate theme sitemap. */
function wdt_admin_notice(){if(!current_user_can('manage_options'))return;if(isset($_GET['activated']))echo '<div class="notice notice-success is-dismissible"><p><strong>WP Dev Theme:</strong> production theme activated. Configure everything from <a href="'.esc_url(admin_url('admin.php?page=wp-dev-theme')).'">WP Dev Theme → Settings</a>.</p></div>';}
add_action('admin_notices','wdt_admin_notice');
