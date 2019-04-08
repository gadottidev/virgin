<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="header">
	<h1>Header</h1>
	<div class="container">
		<div class="row">
			<?php
				// Check if header-hamburger is true and get template part
				if (get_theme_mod('header-hamburger')) {
					get_template_part( 'template-parts/header/header', 'hamburger' ); 
				};
				// Check if header-logo is true and get template part
				if (get_theme_mod('header-logo')) {
					get_template_part( 'template-parts/header/header', 'logo' ); 
				} else {
					?>
					<div class="header__text">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</div>
					<?php
				};
				// Print Primary Navigation if there is no hamburger
				if (!get_theme_mod('header-hamburger')) {
					?>
						<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
						</nav>
					<?php
				};
				// Check if header-cta is true and get template part
				if (get_theme_mod('header-cta')) {
					get_template_part( 'template-parts/header/header', 'cta' ); 
				}
			?>
		</div><!-- .row -->
	</div><!-- .container -->
</header>
<?php
// Print Primary Navigation if there is no hamburger
if (get_theme_mod('header-hamburger')) { ?>
	<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
	</nav>
<?php }; ?>

<h1>alskjdflaksjdlfkja</h1>