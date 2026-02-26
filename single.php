<?php get_header(); ?>
<div class="single-post-wrapper">
    <main class="main-content">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1><?php the_title(); ?></h1>
                    <?php if(get_field('post_subtitle')): ?>
                        <h2 class="post-subtitle"><?php the_field('post_subtitle'); ?></h2>
                    <?php endif; ?>
                    <div class="meta">
                        <span>By <?php the_author(); ?></span>
                        <span> | <?php the_date(); ?></span>
                        <span> | <?php comments_number('0 comments', '1 comment', '% comments'); ?></span>
                        <?php if(get_field('reading_time')): ?>
                            <span> | <?php the_field('reading_time'); ?> min read</span>
                        <?php endif; ?>
                        <?php if(get_field('post_source')): ?>
                            <span> | <a href="<?php the_field('post_source'); ?>" target="_blank">Source</a></span>
                        <?php endif; ?>
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
</div>
<?php get_footer(); ?>