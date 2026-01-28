<?php

global $new_options;

// get text-color class
if ($new_options['footer_text_colors'] == 'text-dark') {
    $new_footer_class = 'text-dark';
} else {
    $new_footer_class = 'text-light';
}

?>

<div class="section site-footer <?php echo esc_attr($new_footer_class);?>">


    <?php $sidebar_number = get_option_theme('mainfooter-sidebars', false, '4');
    $display_footer = false;
    for($i = 1; $i <= $sidebar_number; $i++ ) {
        $sidebar_id = "sidebar-footer-".$i;
        if ( is_active_sidebar($sidebar_id)) {
            $display_footer = true;
        }
    }
    ?>
    <?php if ($display_footer) :?>
        <div class="container main-footer">
            <div class="row">
                <?php $sidebar_number = get_option_theme('mainfooter-sidebars', false, '4');
                $sidebar_class = 'col-md-'.('12'/ $sidebar_number);
                $mobile_class = ' col-sm-6';
                for($i = 1; $i <= $sidebar_number; $i++ ) {
                    if($sidebar_number == 1 || ($sidebar_number == 3 && $i == 3)) {
                        $mobile_class = ' col-sm-12';
                    }
                    $sidebar_id = "sidebar-footer-".$i; ?>
                    <?php if ( is_active_sidebar($sidebar_id)) : ?>
                        <div class="widgets <?php echo esc_attr($sidebar_class) . esc_attr($mobile_class);?> mb-5">
                            <?php if ( is_active_sidebar($sidebar_id)) {
                                dynamic_sidebar($sidebar_id);
                            };?>
                        </div>
                    <?php endif;?>
                <?php } ?>
            </div>
        </div>
    <?php endif;?>

</div>
<footer id="footer" class="footer">
    <section class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 ">

                </div>
                <div class="col-12 col-md-5">
                    <div class="icons">
                        <?php social_links(); ?>
                        <!--<a href="https://linkedin.com/in/luis-miguel-moreno-tapia-b88b6965" target="_blank"> <i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/dglcreativo" target="_blank"> <i class="fab fa-github"></i></a>
                        <a href="mailto:dglcreativo@hotmail.es" target="_blank"> <i class="fa fa-envelope"></i></a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

<?php wp_footer(); ?>
</body>
</html>

