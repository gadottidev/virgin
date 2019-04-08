<?php
/**
 * Displays header title
 *
 * @package WordPress
 * @subpackage Virgin
 * @since 1.0
 * @version 1.0
 */

?>
<div id="virgin-header" class="virgin-header row justify-content-between">

		<div class="virgin-header-title col-7">
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>
		</div>

	<?php get_template_part( 'template-parts/header/header', 'button' ); ?>

</div><!-- .custom-header -->
