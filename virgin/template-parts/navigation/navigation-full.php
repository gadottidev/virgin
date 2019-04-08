<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Virgin
 * @since 1.0
 * @version 1.2
 */

?>
<div id="navigation-top" class="navigation-top">
	<div class="container">
		<div class="wrap row">
			<nav id="site-navigation" class="main-navigation col-lg-4 offset-sm-1" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'virgin' ); ?>">

				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'top-menu',
					'menu_class'     => 'top-menu',
				) ); ?>

			</nav> <!-- #site-navigation -->
			<?php if (has_nav_menu("case_study")) :
				?>
				<nav id="portfolio-navigation" class="portfolio-navigation col-3 offset-1">
					<?php
					$menu_amm = wp_get_nav_menu_object("case-study"); ?>
					  <h3>BLOG</h3>

					<?php wp_nav_menu( array(
						'theme_location' => 'case_study',
						'menu_id'        => 'portfolio-menu',
						'menu_class'     => 'portfolio-menu',
					) ); ?>

				</nav>
			<?php endif; ?>
		</div> <!-- .wrap -->
	</div> <!-- .container -->
</div> <!-- .navigation-top -->
