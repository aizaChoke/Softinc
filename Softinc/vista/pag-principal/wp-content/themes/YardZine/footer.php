<?php global $theme; ?>
</div>

    <div id="footer-container">
    
        <div id="footer">
        
            <div id="copyrights">
                <?php
                    if($theme->display('footer_custom_text')) {
                        $theme->option('footer_custom_text');
                    } else { 
                        ?> &copy; <?php echo date('Y'); ?>  <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a><?php
                    }
                ?> 
            </div>
            
            <?php /* 
            All links in the footer should remain intact. 
            These links are all family friendly and will not hurt your site in any way. 
            Warning! Your site may stop working if these links are edited or deleted 
            
            You can buy this theme without footer links online at http://fthemes.com/buy/?theme=yardzine
        */ ?>
            
            <div id="credits">Powered by <a href="http://wordpress.org/"><strong>WordPress</strong></a> | Designed by: <a href="http://fthemes.com">Free WP Themes</a> | Thanks to <a href="http://wpthemely.com">Magazine WordPress Theme</a>, <a href="http://freewpthemes.co">WordPress Themes 2012</a> and <a href="http://flexithemes.com">Premium Themes</a></div><!-- #credits -->
            
        </div><!-- #footer -->
        
    </div>
    </div>
</div><!-- #container -->

<?php wp_footer(); ?>
<?php $theme->hook('html_after'); ?>
</body>
</html>