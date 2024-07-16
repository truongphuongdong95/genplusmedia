<?php get_header(); ?>
<div id="content" class="site-content">
    <?php if (!is_front_page()): ?>
        <div class="breadcrumb"
            style="--overlay-breadcrumb-left: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-left.png'; ?>'); --overlay-breadcrumb-right:url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-right.png'; ?>');">
            <span><?php the_title(); ?></span>
        </div>
    <?php endif; ?>
    <main id="main" class="site-main"
        style="--overlay-page: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-page-min.png'; ?>');">
        <?php the_content(); ?>
    </main><!-- #main -->
</div>
<?php get_footer(); ?>