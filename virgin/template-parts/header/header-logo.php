<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Virgin
 * @since 1.0
 * @version 1.0
 */

?>

<div id="header__logo" class="header__logo col-md-4">
	<?php
		if ( function_exists( 'the_custom_logo' ) ) {
		  if (has_custom_logo()) {
		  	the_custom_logo();
		  } else {
		  	?>
		  		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		  	<?php
		  }
		}
	?>
</div>
