<?php get_header(); ?>

<div class="single-post-wrapper">
    <main class="main-content">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1><?php the_title(); ?></h1>
                    <div class="meta">
                        <span>By <?php the_author(); ?></span>
                        <span> | <?php the_date(); ?></span>
                        <span> | <?php comments_number('0 comments', '1 comment', '% comments'); ?></span>
                    </div>
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </article>

                <?php comments_template(); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>

    <?php get_sidebar(); ?>
</div> <!-- content-area ends here -->

<?php get_footer(); ?>