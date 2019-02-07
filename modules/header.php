<header class="header" id="masthead" data-module="header">
	<div class="container header__container">
		<div class="header__wrapper">
			<div class="header__block header__block--logo">
				<?php if ( has_custom_logo() ) : ?>
					<div class="header__logo"><?php the_custom_logo(); ?></div>
				<?php endif; ?>
				<?php $blog_info = get_bloginfo( 'name' ); ?>
				<?php if ( ! empty( $blog_info ) ) : ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="header__title"><a class="header__title-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="header__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
				<?php endif; ?>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) :
					?>
					<p class="site-description">
						<?php echo $description; ?>
					</p>
				<?php endif; ?>
			</div>
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<div class="header__block header__block--navigation">
					<nav id="site-navigation" class="header__nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'wpstarter' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'header__menu',
								'items_wrap'     => '<ul id="%1$s" class="%2$s" tabindex="0">%3$s</ul>',
							)
						);
						?>
					</nav><!-- #site-navigation -->
					<button class="header__nav-toggle" data-toggle-nav>
						<span class="fas fa-bars header__nav-icon"></span>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>
</header>
