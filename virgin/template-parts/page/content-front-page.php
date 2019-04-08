<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Virgin
 * @since 1.0
 * @version 1.0
 */

?>


<div class="main">

	<?php

	// check if the flexible content field has rows of data
	if( have_rows('contenuti') ):
	  $i = -1;
	  // loop through the rows of data
	  while ( have_rows('contenuti') ) : the_row();
	  	$i++;
	    if( get_row_layout() == 'hero' ): ?>

	      <section class="container hero">
		      <div class="row">
	          <div class="col-lg-8 offset-lg-2">
	            <h1><?php remove_p(get_sub_field('pay_off')); ?></h1>
	          </div>
	        	<video autoplay="" muted="" loop="" id="video">
	            <source src="<?php the_sub_field('video'); ?>" type="video/mp4">
	          </video>
	        </div>
	      </section>

	    <?php elseif( get_row_layout() == 'value_proposition' ): ?>

	      <section class="container value_proposition">
	      	<div class="row">
	          <h2><?php the_sub_field('testo'); ?></h2>
	          <?php $link = get_sub_field('link');
							if( $link ): ?>
								<a class="button" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
							<?php endif; ?>
	      	</div>
	      </section>

	      <?php elseif( get_row_layout() == 'case_study' ): ?>

	        <section class="container case_study">
	        	<div class="row">
	            <h1><?php the_sub_field('titolo'); ?></h1>
              <?php $link = get_sub_field('link');
    						if( $link ): ?>
    							<a class="button" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
    						<?php endif; ?>
	        	</div>
	        </section>


	    <?php endif;

	  endwhile;

	else :

	    // no layouts found

	endif;

	?>

</div> <!-- fine MAIN -->





