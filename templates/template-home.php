<?php
/*
Template Name: Home Template
*/
?>

<?php get_header(); ?>

<div class="homepage-content">

    <?php $hero_image = get_field('hero_image'); ?>
    <section data-aos="zoom-in" class="hero" <?php if ($hero_image): ?>
            style="background-image: url('<?php echo esc_url($hero_image['url']); ?>')" <?php endif; ?>>
        <h1><?php the_field('hero_title'); ?></h1>
        <p><?php the_field('hero_description'); ?></p>
    </section>

    <section class="latest-posts">
        <div class="container">
            <h2>Latest Posts</h2>

            <?php
            $latest_posts = new WP_Query(array(
                'posts_per_page' => 6,
                'post_type' => 'post',
                'post_status' => 'publish'
            ));

            if ($latest_posts->have_posts()): ?>
                <div class="posts-grid">
                    <?php while ($latest_posts->have_posts()):
                        $latest_posts->the_post(); ?>
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
                    <?php endwhile; ?>
                </div>

                <?php if ($latest_posts->max_num_pages > 1): ?>
                    <button class="load-more" data-page="1" data-max="<?php echo $latest_posts->max_num_pages; ?>">
                        Load More
                    </button>
                <?php endif; ?>
            <?php else: ?>
                <p>No posts found.</p>
            <?php endif;

            wp_reset_postdata();
            ?>
        </div>
    </section>

</div> <!-- /.homepage-content -->

<?php get_footer(); ?>