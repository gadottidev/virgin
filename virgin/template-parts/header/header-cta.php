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

<div id="header__cta" class="header__cta col-md-4">
	<?php if ( is_active_sidebar( 'cta' ) ) { ?>
		<?php dynamic_sidebar( 'cta' ); ?>
	<?php } ?>
</div>
