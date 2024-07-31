<?php get_header(); ?>
<div id="content" class="site-content">
    <?php if (!is_front_page()): ?>
        <div class="breadcrumb"
            style="--overlay-breadcrumb-left: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-left.png'; ?>'); --overlay-breadcrumb-right:url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-right.png'; ?>');">
            <h1 class="breadcrumb-title"><?php the_title(); ?></h1>
        </div>
    <?php endif; ?>
    <main id="main" class="site-main <?php esc_attr_e(is_front_page() ? 'home-page' : 'page'); ?>"
        style="--overlay-page: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-page-min.png'; ?>');">
        <div class="page-container">
            <?php
            the_content();
            ?>
        </div>
    </main><!-- #main -->
</div>
<?php get_footer(); ?>