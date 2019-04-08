<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Virgin
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container blog">
		<header class="entry-header">
			<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				}
			?>
		</header><!-- .entry-header -->

		<div class="entry-content col-lg-8 offset-lg-2">
			<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'virgin' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'virgin' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .container -->
</article><!-- #post-## -->



<div class="main blog">

	<div class="container">
		<?php

	    $args = array(
	      'post_type'   	 => 'post',
	      'order'			  	 => 'DESC',
	      'post_status' 	 => 'publish',
	      'posts_per_page' => '4',
	      'paged'					 => '1'
	    );

	    $query = new WP_Query($args);

	    if( $query->have_posts() ){

		?>

		<div class="row posts" id="post_response">
			
			<div class="col-lg-12 titolo">
				<h3>Altre news</h3>
			</div>

			<?php

	  		// RICERCA POST NATIVI
	      while( $query->have_posts() ){

	  	    $query->the_post();

	    	?>

					<article class="articolo col-lg-3">
						<a class="scopri" href="<?php the_permalink() ?>">
							<div class="immagine">
								<figure style="background-image: url(<?php echo the_post_thumbnail_url() ?>)">
								</figure>
							</div>
							<div class="post">
					      <h3><?php the_title() ?></h3>
							</div>
						</a>
			    </article>

	  	<?php
				}; // finish while

			wp_reset_postdata();

			?>

		</div> <!-- fine .row -->
		<?php

	 		}; // finish if

	wp_reset_query();

	?>
	</div> <!-- fine .container -->

</div> <!-- fine MAIN -->