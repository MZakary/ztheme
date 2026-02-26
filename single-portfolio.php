<?php get_header(); ?>
<div class="single-portfolio-wrapper">
    <main class="main-content">
        <?php if(have_posts()): ?>
            <?php while(have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if(has_post_thumbnail()): ?>
                        <div class="portfolio-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    <h1><?php the_title(); ?></h1>
                    <?php if(get_field('project_description')): ?>
                        <p class="project-description"><?php the_field('project_description'); ?></p>
                    <?php endif; ?>
                    <?php if(get_field('project_technologies')): ?>
                        <p class="project-technologies"><strong>Technologies:</strong> <?php the_field('project_technologies'); ?></p>
                    <?php endif; ?>
                    <?php if(get_field('project_url')): ?>
                        <a href="<?php the_field('project_url'); ?>" target="_blank" class="btn">View Project</a>
                    <?php endif; ?>
                    <div class="project-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>
</div>
<?php get_footer(); ?>