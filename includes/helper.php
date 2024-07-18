<?php
function get_breadcrumb( $sep = ' / ')
{
    if (!is_front_page()) {

        // Start the breadcrumb with a link to your homepage
        echo '<div class="breadcrumbs-detail">';
        echo '<a href="';
        echo get_option('home');
        echo '">';
        esc_html_e('Home', 'genplus-media');
        echo '</a>' . $sep;

        // Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category() || is_single()) {
            echo '<a href="' . get_site_url() . '/blog">Blog</a>';
        } elseif (is_archive() || is_single()) {
            if (is_day()) {
                printf(__('%s', 'genplus-media'), get_the_date());
            } elseif (is_month()) {
                printf(__('%s', 'genplus-media'), get_the_date(_x('F Y', 'monthly archives date format', 'genplus-media')));
            } elseif (is_year()) {
                printf(__('%s', 'genplus-media'), get_the_date(_x('Y', 'yearly archives date format', 'genplus-media')));
            } else {
                _e('Blog Archives', 'genplus-media');
            }
        }

        // If the current page is a single post, show its title with the separator
        if (is_single()) {
            echo $sep;
            echo '<span class="post-title">'.get_the_title().'</span>';
        }

        // If the current page is a static page, show its title.
        if (is_page()) {
            echo '<span class="post-title">'.get_the_title().'</span>';
        }

        // if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()) {
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ($page_for_posts_id) {
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                echo '<span class="post-title">'.get_the_title().'</span>';
                rewind_posts();
            }
        }
        echo '</div>';
    }
}
?>