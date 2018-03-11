<?php
add_action('after_setup_theme', 'KustomKode_setup');
function KustomKode_setup(){
    load_theme_textdomain('KustomKode', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    register_nav_menus(
        array('main-menu' => __('Main Menu', 'KustomKode' ),'footer-menu' => __('Footer Menu'))
    );
}

function load_the_scripts(){
    wp_deregister_script('jquery');
    if(!is_admin()){
        wp_register_style('font', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700');
        wp_enqueue_style( 'font');
        wp_enqueue_style('Stylesheet', get_stylesheet_uri());
        wp_register_style('Animation', get_template_directory_uri() . '/css/animation.css');
        wp_enqueue_style('Animation');
        wp_register_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false,'',true);
        wp_enqueue_script('jquery');
        wp_register_script('themescripts', get_template_directory_uri() . '/js/theme-scripts.js',array('jquery'),'',true);
        wp_enqueue_script('themescripts');
        if(is_page(6)){
            wp_register_script('cycle2', get_template_directory_uri() . '/js/cycle2.min.js',array('jquery'),'',true);
            wp_enqueue_script('cycle2');
        }
        wp_register_script('AnimationJs', get_template_directory_uri() . '/js/animate.js', array('jquery'), '', true);
        wp_enqueue_script('AnimationJs');
        wp_register_script('FontAwesome','https://use.fontawesome.com/releases/v5.0.6/js/all.js', array('jquery'), '', true);
        wp_enqueue_script('FontAwesome');
        // wp_register_script('jqueryUi','//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js', array('jquery'), '', true);
        // wp_enqueue_script('jqueryUi');
    }
}
add_action('wp_enqueue_scripts','load_the_scripts');

add_filter('wp_theme_editor_filetypes', function($add_types){
    $add_types[] = 'scss';
    return $add_types;
});

require_once 'functions-custom.php';

// Remove query string from static files
function remove_cssjs_ver($src){
    if(strpos($src, '?ver='))
      $src = remove_query_arg('ver',$src);
    return $src;
}
add_filter('style_loader_src', 'remove_cssjs_ver', 10, 2);
add_filter('script_loader_src', 'remove_cssjs_ver', 10, 2);

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

function wpbeginner_remove_version() {return '';}
add_filter('the_generator', 'wpbeginner_remove_version');
function add_to_head(){
    global $is_IE;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
    ?><title><?php wp_title(" | ", true, "right"); ?></title><?php
    echo '<link rel="shortcut icon" href="/wp-content/uploads/favicon.ico" type="image/x-icon">';
    echo '<link rel="icon" href="/wp-content/uploads/favicon.ico" type="image/x-icon">';
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
    if($is_IE); echo '<!--[if IE]><style type="text/css">.clearfix{zoom:1;}</style><![endif]-->';
}
add_action('wp_head','add_to_head');


// ALLOW SVG THROUGH MEDIA UPLOADER ===>
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
function fix_svg_thumb_display(){
  echo '<style type="text/css">
    td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail{ 
      width: 100% !important; 
      height: auto !important; 
    }
    td strong.has-media-icon img{
      width: 100% !important; 
      height: auto !important; 
    }
  </style>';
}
add_action('admin_head', 'fix_svg_thumb_display');

class WP_HTML_Compression{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html){
        if (!empty($html)){
            $this->parseHTML($html);
        }
    }
    public function __toString(){
        return $this->html;
    }
    protected function bottomComment($raw, $compressed){
        $raw = strlen($raw);
        $compressed = strlen($compressed);
        $savings = ($raw-$compressed) / $raw * 100;
        $savings = round($savings, 2);

        // return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html){
        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
        $overriding = false;
        $raw_tag = false;

        // Variable reused for output
        $html = '';
        foreach ($matches as $token){
	    $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
	    $content = $token[0];
            if (is_null($tag)){
	        if ( !empty($token['script'])){
		    $strip = $this->compress_js;
		}
		else if ( !empty($token['style'])){
		    $strip = $this->compress_css;
		}
		else if ($content == '<!--wp-html-compression no compression-->'){
		    $overriding = !$overriding;
					
                    // Don't print the comment
		    continue;
		}
		else if ($this->remove_comments){
                    if(!$overriding && $raw_tag != 'textarea'){
                        // Remove any HTML comments, except MSIE conditional comments
                        $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                    }
                }
            } else {
                if($tag == 'pre' || $tag == 'textarea'){
                    $raw_tag = $tag;
                } else if ($tag == '/pre' || $tag == '/textarea') {
                    $raw_tag = false;
                } else {
                    if ($raw_tag || $overriding){
		        $strip = false;
                    } else {
                        $strip = true;

                        // Remove any empty attributes, except:
                        // action, alt, content, src
                        $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						
                        // Remove any space before the end of self-closing XHTML tags
                        // JavaScript excluded
                        $content = str_replace(' />', '/>', $content);
		    }
                }
            }
            if($strip){
                $content = $this->removeWhiteSpace($content);
            }
            $html .= $content;
        }
        return $html;
    }
		
    public function parseHTML($html){
        $this->html = $this->minifyHTML($html);
        if ($this->info_comment){
            $this->html .= "\n" . $this->bottomComment($html, $this->html);
        }
    }
    protected function removeWhiteSpace($str){
        $str = str_replace("\t", ' ', $str);
        $str = str_replace("\n",  '', $str);
        $str = str_replace("\r",  '', $str);
        while (stristr($str, '  ')){
            $str = str_replace('  ', ' ', $str);
        }
        return $str;
    }
}

function wp_html_compression_finish($html){
    return new WP_HTML_Compression($html);
}
function wp_html_compression_start(){
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');

function wp_new_excerpt($text){
    if($text == ''){
        $text = get_the_content('');
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text,'<p></p><br>');
        $text = nl2br($text);
        $excerpt_length = apply_filters('excerpt_length', 40);
        $words = explode(' ', $text, $excerpt_length + 1);
        if(count($words) > $excerpt_length){
            array_pop($words);
            array_push($words,'...');
            $text = implode(' ', $words);
        }
    }
    return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_new_excerpt');

add_filter('the_title', 'KustomKode_title');
function KustomKode_title($title){
    if ($title == ''){
        return 'Untitled';
    } else {
        return $title;
    }
}

function theme_settings_function(){
    add_menu_page('Theme settings', 'Site Settings', 'manage_options', 'client_settings', 'client_settings');
    add_submenu_page('client_settings', 'Client Settings', 'Client Settings', 'manage_options', 'client_settings', 'client_settings'); 
    require_once 'theme-settings/client-settings.php';
}
add_action('admin_menu','theme_settings_function');
if(get_option('company_name')){
    add_shortcode('company-name', 'company_name');
    function company_name(){
        return get_option('company_name');
    }
}
if(get_option('company_add')){
    add_shortcode('company-add', 'company_add');
    function company_add(){
        return get_option('company_add');
    }
    if(get_option('company_add_line_two')){
        add_shortcode('company-add-line-two', 'company_add_line_two');
        function company_add_line_two(){
            return get_option('company_add_line_two');
        }
    }
}
if(get_option('company_city')){
    add_shortcode('company-city', 'company_city');
    function company_city(){
        return get_option('company_city');
    }
}
if(get_option('company_state')){
    add_shortcode('company-state', 'company_state');
    function company_state(){
        return get_option('company_state');
    }
}
if(get_option('company_zip')){
    add_shortcode('company-zip', 'company_zip');
    function company_zip(){
        return get_option('company_zip');
    }
}
if(get_option('company_phone')){
    add_shortcode('company-phone', 'company_phone');
    function company_phone() {
        return get_option('company_phone');
    }
    add_shortcode('company-phone-link', 'company_phone_link');
    function company_phone_link() {
        return preg_replace('/[^0-9]/', '', get_option('company_phone'));
    }
}
if(get_option('company_phone_two')){
    add_shortcode('company-phone-two', 'company_phone_two');
    function company_phone_two() {
        return get_option('company_phone_two');
    }
    add_shortcode('company-phone-two-link', 'company_phone_two_link');
    function company_phone_two_link() {
        return preg_replace('/[^0-9]/', '', get_option('company_phone_two'));
    }
}
if(get_option('company_fax')){
    add_shortcode('company-fax', 'company_fax');
    function company_fax() {
        return get_option('company_fax');
    }
    add_shortcode('company-fax-link', 'company_fax_link');
    function company_fax_link() {
        return preg_replace('/[^0-9]/', '', get_option('company_fax'));
    }
}
if(get_option('company_email')){
    add_shortcode('company-email', 'company_email');
    function company_email() {
        return antispambot(get_option('company_email'));
    }
}
if(get_option('company_facebook')){
    add_shortcode('company-facebook', 'company_facebook');
    function company_facebook() {
        return get_option('company_facebook');
    }
}
if(get_option('company_twitter')){
    add_shortcode('company-twitter', 'company_twitter');
    function company_twitter() {
        return get_option('company_twitter');
    }
}
if(get_option('company_linkedin')){
    add_shortcode('company-linkedin', 'company_linkedin');
    function company_linkedin() {
        return get_option('company_linkedin');
    }
}
if(get_option('company_google_plus')){
    add_shortcode('company-google-plus', 'company_google_plus');
    function company_google_plus() {
        return get_option('company_google_plus');
    }
}

add_action('admin_print_footer_scripts', 'quick_tags');
function quick_tags(){
    if (wp_script_is('quicktags')){ ?>
        <script type="text/javascript">
            QTags.addButton('clearfix', 'Clearfix', '<div class="clearfix">', '</div>', '', '<div class="clearfix"></div>', 141);
            QTags.addButton('l-image', 'L-Image', '<img width="300" height="200" src="/wp-content/uploads/.jpg" class="phleft" alt="" />', '', '', '', 142);
            QTags.addButton('r-image', 'R-Image', '<img width="300" height="200" src="/wp-content/uploads/.jpg" class="phright" alt="" />', '', '', '', 143);
            QTags.addButton('h2tag', 'Header2', '<h2>', '</h2>', '', '<h2></h2>', 144);
            QTags.addButton('h3tag', 'Header3', '<h3>', '</h3>', '', '<h3></h3>', 145);
            QTags.addButton('h4tag', 'Header4', '<h4>', '</h4>', '', '<h4></h4>', 146);
            QTags.addButton('h5tag', 'Header5', '<h5>', '</h5>', '', '<h5></h5>', 147);
            QTags.addButton('line-break', 'Break', '<br />\r', '', '', '', 148);
            QTags.addButton('ptag', 'Paragraph', '<p>', '</p>\r', '', '<p></p>\r', 149);
        </script><?php
    }
}

function post_pagination() {
	if( is_singular() )
		return;
	global $wp_query;
	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );
	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;
	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	echo '<div class="navigation clearfix bbox"><ul class="clearfix bbox">' . "\n";
	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="pagination-prev">%s</li>' . "\n", get_previous_posts_link() );
	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}
	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li class="pagination-next">%s</li>' . "\n", get_next_posts_link() );
	echo '</ul></div>' . "\n";
}

// MOVE WORDPRESS SEO PLUGIN METABOX PRIORITY DOWN SO IT DISPLAYS LAST ===>
add_filter('wpseo_metabox_prio', function(){return 'low';});

// REMOVE SCHEMA.ORG FROM HEAD ===>
function bybe_remove_yoast_json($data){
    $data = array();
    return $data;
  }
add_filter('wpseo_json_ld_output', 'bybe_remove_yoast_json', 10, 1);

// ADD POST ID TO HIDDEN INPUT BEFORE CLOSING BODY TAG ===>
function add_post_id_input(){
  echo '<input id="the-post-id" disabled type="hidden" value="'.get_the_ID().'" />';
}
add_action('wp_footer', 'add_post_id_input', 0);

// ADD button instead of input for CF7 submit ===>
add_action( 'wpcf7_init', 'kustom_wpcf7_add_form_tag_text' );
function kustom_wpcf7_add_form_tag_text() {
    wpcf7_add_form_tag(
        array( 'text', 'text*', 'email', 'email*', 'url', 'url*', 'tel', 'tel*' ),
        'wpcf7_text_form_tag_handler', array('name-attr' => true ) );
}
add_action( 'wpcf7_init', 'custom_add_form_tag_button' );
function custom_add_form_tag_button() {
    wpcf7_add_form_tag( 'btn_1', 'custom_button_form_tag_handler' );
    wpcf7_add_form_tag( 'btn_2', 'custom_button_form_tag_handler2' );
    wpcf7_add_form_tag( 'btn_3', 'custom_button_form_tag_handler3' ); 
}
function custom_button_form_tag_handler($tag) {
	return '<button type="submit" class="wpcf7-form-control wpcf7-submit submit hvr-pop"><i class="fas fa-chevron-circle-right"></i> Contact Us</button>';
}
function custom_button_form_tag_handler2($tag) {
	return '<button type="submit" class="wpcf7-form-control wpcf7-submit submit hvr-pop"><i class="fas fa-chevron-circle-right"></i> Get It Now</button>';
}

function custom_button_form_tag_handler3($tag) {
	return '<button type="submit" class="wpcf7-form-control wpcf7-submit submit hvr-pop"><i class="fas fa-chevron-circle-right"></i> Send Now</button>';
}