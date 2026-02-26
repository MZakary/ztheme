<footer class="site-footer">
    <div class="container">
        <div class="site-info">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            <?php 
                if(has_nav_menu('footer')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container' => false,
                        'menu_class' => 'footer-menu'
                    )); 
                }
            ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>