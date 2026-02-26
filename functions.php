<?php

// Enqueue CSS & JS
function ztheme_enqueue_scripts()
{

    // Compiled CSS (SCSS → dist)
    wp_enqueue_style(
        'ztheme-style',
        get_template_directory_uri() . '/dist/style.css',
        [],
        filemtime(get_template_directory() . '/dist/style.css')
    );

    // JS
    wp_enqueue_script(
        'ztheme-scripts',
        get_template_directory_uri() . '/dist/bundle.js',  // ← should be dist/bundle.js
        ['jquery'],
        filemtime(get_template_directory() . '/dist/bundle.js'),
        true
    );

    wp_enqueue_script(
        'ztheme-ajax',
        get_template_directory_uri() . '/assets/js/ajax.js',
        ['jquery'],
        filemtime(get_template_directory() . '/assets/js/ajax.js'),
        true
    );
    wp_localize_script('ztheme-ajax', 'loadMoreData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('load_more_nonce')
    ));

    wp_enqueue_style(
        'aos-style',
        get_template_directory_uri() . '/node_modules/aos/dist/aos.css',
        [],
        '2.3.4'
    );
}
add_action('wp_enqueue_scripts', 'ztheme_enqueue_scripts');


// Theme supports
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');
add_theme_support('menus');


// Register menus
function ztheme_register_menus()
{
    register_nav_menus([
        'primary' => __('Primary Menu', 'ztheme'),
        'footer' => __('Footer Menu', 'ztheme'),
    ]);
}
add_action('after_setup_theme', 'ztheme_register_menus');


// Sidebar
function ztheme_widgets_init()
{
    register_sidebar([
        'name' => 'Main Sidebar',
        'id' => 'main-sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);
}
add_action('widgets_init', 'ztheme_widgets_init');


// AJAX handler
function handle_load_more_posts()
{
    check_ajax_referer('load_more_nonce', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 2;

    $query = new WP_Query(array(
        'posts_per_page' => 6,
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $page,
    ));

    if ($query->have_posts()):
        ob_start();
        while ($query->have_posts()):
            $query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                <?php if (has_post_thumbnail()): ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                <?php endif; ?>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="post-excerpt"><?php echo wp_trim_words(get_the_content(), 25); ?></p>
                <a class="read-more" href="<?php the_permalink(); ?>">Read More →</a>
            </article>
        <?php endwhile;
        wp_reset_postdata();
        $html = ob_get_clean();
        wp_send_json_success(array('html' => $html));
    else:
        wp_send_json_error();
    endif;
}
add_action('wp_ajax_load_more_posts', 'handle_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'handle_load_more_posts');


// Include custom functions
require get_template_directory() . '/inc/custom-functions.php';