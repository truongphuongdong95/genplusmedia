<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?>
<div class="site-branding">
	<?php if (has_custom_logo()): ?>
		<div class="site-logo"><?php the_custom_logo(); ?></div>
	<?php else: ?>
		<?php $blog_info = get_bloginfo('name'); ?>
		<?php if (!empty($blog_info)): ?>
			<?php if (is_front_page() && is_home()): ?>
				<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
						rel="home"><?php bloginfo('name'); ?></a></h1>
			<?php else: ?>
				<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
						rel="home"><?php bloginfo('name'); ?></a></p>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
	<?php
	$description = get_bloginfo('description', 'display');
	if ($description || is_customize_preview()):
		?>
		<p class="site-description">
			<?php echo $description; ?>
		</p>
	<?php endif; ?>
	<?php if (has_nav_menu('primary')): ?>
		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Top Menu', 'genplus-media'); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class' => 'main-menu',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				)
			);
			?>
			<button class="btn-apply-now"><?php esc_html_e('Ứng tuyển ngay', 'genplus-media'); ?></button>
		</nav><!-- #site-navigation -->
		<a class="nav-mobile-button"><img src="<?php echo get_template_directory_uri() . '/assets/icon/icon-nav-mobile.svg'; ?>" loading="lazy" /></a>

	<?php endif; ?>

</div><!-- .site-branding -->
<nav id="site-navigation-mobile" class="main-navigation-mobile"
	aria-label="<?php esc_attr_e('Top Menu', 'genplus-media'); ?>">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'menu_class' => 'main-menu',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		)
	);
	?>
	<button class="btn-apply-now"><?php esc_html_e('Ứng tuyển ngay', 'genplus-media'); ?></button>
</nav><!-- #site-navigation-mobile -->