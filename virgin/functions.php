<?php

// Load custom styles and scripts
function virgin_resources() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script( 'header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, false );
	wp_enqueue_script( 'footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true );
}
add_action( 'wp_enqueue_scripts', 'virgin_resources' );

// Theme setup
function virgin_setup() {
	// Handle Titles
	add_theme_support( 'title-tag' );

	// Add custom logo support
	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title' ),
	) );

	// Add featured image support
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'small-thumbnail', 720, 720, true );
	add_image_size( 'square-thumbnail', 80, 80, true );
	add_image_size( 'banner-image', 1024, 1024, true );

	// Register Nav Menu
	register_nav_menu( 'primary', __( 'Primary Menu', 'virgin' ) );
}
add_action( 'after_setup_theme', 'virgin_setup' );

// Checks if there are any posts in the results
function is_search_has_results() {
	return 0 != $GLOBALS['wp_query']->found_posts;
}

// Add Widget Areas
function virgin_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Call to Action', 'virgin' ),
		'id'            => 'cta',
		'description'   => __( 'Sezione per inserire CTA prima del footer', 'virgin' ),
		'before_widget' => '<div id="%1$s" class="widget row %2$s">',
		'after_widget'  => '</div>',
	) );	
  register_sidebar( array(
		'name'          => __( 'Footer Info', 'virgin' ),
		'id'            => 'footer1',
		'description'   => __( 'Sezione per inserire le info della agenzia', 'virgin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
  register_sidebar( array(
		'name'          => __( 'Footer Partner', 'virgin' ),
		'id'            => 'footer2',
		'description'   => __( 'Sezione per inserire i partner', 'virgin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
  register_sidebar( array(
		'name'          => __( 'Footer Menu', 'virgin' ),
		'id'            => 'footer3',
		'description'   => __( 'Sezione per inserire pagine secondarie', 'virgin' ),
		'before_widget' => '<div id="%1$s" class="widget service_page %2$s">',
		'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'virgin_widgets_init' );

// Register and load the widget
function wpb_load_widget() {
  register_widget( 'startProject' );
}

add_action( 'widgets_init', 'wpb_load_widget' );

class startProject extends WP_Widget {
	// class constructor
	public function __construct() {

		$widget_ops = array( 
			'classname' => 'startProject',
			'description' => 'A widget for a CTA',
		);
		parent::__construct( 'startProject', 'Start Project', $widget_ops );

	}
	
	// output the widget content on the front-end
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['link'] ) ) {
			?>
				<a href="<?php echo $instance['link']; ?>" class="button"><?php echo $instance['text']; ?></a>
			<?php
		}

		echo $args['after_widget'];

	}

	// output the option form field in admin Widgets screen
	public function form( $instance ) {

		$text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( 'Text', 'text_domain' );
		$link = ! empty( $instance['link'] ) ? $instance['link'] : esc_html__( 'Link', 'link_domain' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>">
			<?php esc_attr_e( 'Text:', 'text_domain' ); ?>
			</label> 
			
			<input 
				class="widefat" 
				id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" 
				name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" 
				type="text" 
				value="<?php echo esc_attr( $text ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>">
			<?php esc_attr_e( 'Link:', 'link_domain' ); ?>
			</label> 
			
			<input 
				class="widefat" 
				id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" 
				name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" 
				type="link" 
				value="<?php echo esc_attr( $link ); ?>">
		</p>

		<?php

	}

	// save options
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

		return $instance;

	}
}


// Customizer
function virgin_customize_register( $wp_customize ) {
	// Section
  $wp_customize->add_section( 'virgin_custom_settings_section' , array(
    'title'    => __( 'Custom Settings', 'virgin' ),
    'priority' => 30
  ) );   

  // Primary color picker
  $wp_customize->add_setting( 'virgin_primary' , array(
    'default'   => '#ffffff',
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
    'label'    => __( 'Primary Color', 'virgin' ),
    'section'  => 'virgin_custom_settings_section',
    'settings' => 'virgin_primary',
  ) ) );

  // Secondary color picker
  $wp_customize->add_setting( 'virgin_secondary' , array(
    'default'   => '#000000',
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
    'label'    => __( 'Secondary Color', 'virgin' ),
    'section'  => 'virgin_custom_settings_section',
    'settings' => 'virgin_secondary',
  ) ) );

  // Add Facebook profile url
  $wp_customize->add_setting( 'facebook' , array(
    'default'   => 'www.facebook.com',
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control('facebook', array(
    'label'    => __( 'Facebook', 'virgin' ),
    'section'  => 'virgin_custom_settings_section',
    'settings' => 'facebook',
    'type' => 'url',
  ) );

  // Add Twitter profile url
  $wp_customize->add_setting( 'twitter' , array(
    'default'   => 'www.twitter.com',
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control('twitter', array(
    'label'    => __( 'Twitter', 'virgin' ),
    'section'  => 'virgin_custom_settings_section',
    'settings' => 'twitter',
    'type' => 'url',
  ) );

  // Add Instagram profile url
  $wp_customize->add_setting( 'instagram' , array(
    'default'   => 'www.instagram.com',
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control('instagram', array(
    'label'    => __( 'Instagram', 'virgin' ),
    'section'  => 'virgin_custom_settings_section',
    'settings' => 'instagram',
    'type' => 'url',
  ) );

  // Show Logo in nav
  $wp_customize->add_setting( 'header-logo' , array(
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'header-logo', array(
    'label'    => __( 'Header Logo', 'virgin' ),
    'description' => __( 'Choose to show the logo in the header', 'virgin' ),
    'section'  => 'virgin_custom_settings_section',
    'settings' => 'header-logo',
    'type' => 'checkbox',
  ) ) );

  // Show CTA in nav button
  $wp_customize->add_setting( 'header-cta' , array(
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'header-cta', array(
    'label'    => __( 'Header CTA', 'virgin' ),
    'description' => __( 'Choose to show the cta in the header', 'virgin' ),
    'section'  => 'virgin_custom_settings_section',
    'settings' => 'header-cta',
    'type' => 'checkbox',
  ) ) );

  // Show always hamburger button in nav
  $wp_customize->add_setting( 'header-hamburger' , array(
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'header-hamburger', array(
    'label'    => __( 'Hamburger Nav', 'virgin' ),
    'description' => __( 'Choose to show the hamburger button in the header', 'virgin' ),
    'section'  => 'virgin_custom_settings_section',
    'settings' => 'header-hamburger',
    'type' => 'checkbox',
  ) ) );
}
add_action( 'customize_register', 'virgin_customize_register');

// Print Customizer Color Theme Mod in head
function virgin_customize_css() {
  ?>
		<style type="text/css">
			:root {
				--primary-color: <?php echo get_theme_mod('virgin_primary', '#000000'); ?>;
				--secondary-color: <?php echo get_theme_mod('virgin_secondary', '#000000'); ?>;
			}
		</style>
  <?php
}
add_action( 'wp_head', 'virgin_customize_css');


/*------------------------------------*\
	GENERAL SETTINGS
\*------------------------------------*/

// Add custom footer admin
function virgin_custom_footer_admin () {
	echo 'If you have any problem, <a href="mailto:marco@gadotti.dev" target="_blank">contact me</a> | Made with WordPress and love</p>';
}
add_filter('admin_footer_text', 'virgin_custom_footer_admin');

// Customize excerpt word count length
function custom_excerpt_length() {
	return 22;
}
add_filter( 'excerpt_length', 'custom_excerpt_length' );

// Remove admin bar 
show_admin_bar( false );

// Remove p from text => remove_p(get_sub_field('example'));
function remove_p ($titolo) {
	$stripper_text = str_replace(array('<p>','</p>'), '', $titolo);
	echo $stripper_text;
}

// Remove shits
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove version WordPress
function virgin_remove_version() { return ''; }
add_filter('the_generator', 'virgin_remove_version');

// Add support in dashboard
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
 	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {
	echo '<p>Welcome to this awesome site made with WordPress! Need help? Contact the developer <a href="mailto:marco@gadotti.dev">here</a>.</p>';
}
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

// Remove Welcome to WordPress
remove_action('welcome_panel', 'wp_welcome_panel');

// Remove XML-RPC
add_filter('xmlrpc_enabled', '__return_false');
