<?php get_header(); ?>
<div id="content" class="site-content">
    <?php
    // Start the Loop.
    while (have_posts()):
        the_post();

        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php
                if (is_singular()):
                    the_title('<h1 class="entry-title">', '</h1>');
                else:
                    the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                endif;
                ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                the_content();
                ?>
            </div>
        </article>
        <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
    endwhile; // End the loop.
    ?>
</div>
<?php get_footer(); ?>