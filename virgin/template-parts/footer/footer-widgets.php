<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage Virgin
 * @since 1.0
 * @version 1.0
 */

?>


<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
    <aside class="widget col-md-3 offset-md-2 info">
      <?php dynamic_sidebar( 'footer1' ); ?>
    </aside>
<?php endif; ?>

<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
    <aside class="widget col-md-5 partner">
      <?php dynamic_sidebar( 'footer2' ); ?>
    </aside>
<?php endif; ?>

