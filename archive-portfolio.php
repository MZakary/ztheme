<?php get_header(); ?>
<div class="portfolio-archive">
    <div class="container">
        <h1>Portfolio</h1>
        <div class="portfolio-grid">
            <?php if(have_posts()): ?>
                <?php while(have_posts()): the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item'); ?>>
                        <?php if(has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        <?php endif; ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php if(get_field('project_description')): ?>
                            <p><?php the_field('project_description'); ?></p>
                        <?php endif; ?>
                        <?php if(get_field('project_url')): ?>
                            <a href="<?php the_field('project_url'); ?>" target="_blank" class="btn">View Project</a>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No projects found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>