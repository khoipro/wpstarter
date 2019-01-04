<?php
get_header();
?>

	<section id="primary" class="site__primary">
		<main id="main" class="site__main">

			<?php
			if ( have_posts() ) {
				// Load posts loop.
				while ( have_posts() ) {
					the_post();
					get_template_part( 'modules/content/content' );
				}
				// Previous/next page navigation.
			} else {
				// If no content, include the "No posts found" template.
				get_template_part( 'modules/content/content', 'none' );
			}
			?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php
get_footer();
