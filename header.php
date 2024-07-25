<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<div id="preloader" class="preloader"><span class="loader"></span></div>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
		<header id="masthead" class="<?php echo is_singular() ? 'site-header featured-image' : 'site-header'; ?>">
			<div class="site-branding-container">
				<?php get_template_part( 'template-parts/header/site', 'header' ); ?>
			</div><!-- .site-branding-container -->
			<?php if ( is_singular()) : ?>
				<div class="site-featured-image">
					<?php
						the_post();
						$classes = 'entry-header';
					?>
					<div class="<?php echo $classes; ?>">
						<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
					</div><!-- .entry-header -->
				</div>
			<?php endif; ?>
		</header><!-- #masthead -->

	
