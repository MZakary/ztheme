<aside id="sidebar">
    <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'main-sidebar' ); ?>
    <?php else : ?>
        <div class="widget">
            <h3>Search</h3>
            <?php get_search_form(); ?>
        </div>
        <div class="widget">
            <h3>Recent Posts</h3>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));
                foreach($recent_posts as $post) : ?>
                    <li><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo $post['post_title']; ?></a></li>
                <?php endforeach; wp_reset_query(); ?>
            </ul>
        </div>
    <?php endif; ?>
</aside>