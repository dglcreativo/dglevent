<?php
//SECTOR 1
$gm_bg_sector_one = get_field('gm_bg_sector_one');
$gm_first_text = get_field('gm_first_text');
$gm_color_first_text = get_field('gm_color_first_text');
$gm_second_text = get_field('gm_second_text');
$gm_third_text = get_field('gm_third_text');
$gm_four_text = get_field('gm_four_text');
$gm_img_sector_one = get_field('gm_img_sector_one');
$gm_p_sector_one = get_field('gm_p_sector_one');

//SECTOR 2
$gm_bg_sector_two = get_field('gm_bg_sector_two');
$gm_color_sector_two = get_field('gm_color_sector_two');
$gm_img_sector_two = get_field('gm_img_sector_two');
$gm_text_sector_two = get_field('gm_text_sector_two');

//SECTOR 3
$gm_bg_sector_three = get_field('gm_bg_sector_three');
$gm_color_sector_three = get_field('gm_color_sector_three');
$gm_img_sector_three = get_field('gm_img_sector_three');
$gm_text_sector_three = get_field('gm_text_sector_three');

//SECTOR 4
$gm_bg_sector_four = get_field('gm_bg_sector_four');
$gm_color_sector_four = get_field('gm_color_sector_four');
$gm_img_sector_four = get_field('gm_img_sector_four');
$gm_text_sector_four = get_field('gm_text_sector_four');
$gm_p_sector_four = get_field('gm_p_sector_four');

//SECTOR 5
$gm_bg_sector_five = get_field('gm_bg_sector_five');
$gm_color_sector_five = get_field('gm_color_sector_five');
$gm_img_sector_five = get_field('gm_img_sector_five');
$gm_text_sector_five = get_field('gm_text_sector_five');

//SECTOR 6
$gm_bg_sector_six = get_field('gm_bg_sector_six');
$gm_color_sector_six = get_field('gm_color_sector_six');
$gm_img_sector_six = get_field('gm_img_sector_six');
$gm_text_sector_six = get_field('gm_text_sector_six');
$gm_text_sector_six_two = get_field('gm_text_sector_six_two');

//SECTOR 7
$gm_bg_sector_seven = get_field('gm_bg_sector_seven');
$gm_color_sector_seven = get_field('gm_color_sector_seven');
$gm_img_sector_seven = get_field('gm_img_sector_seven');
$gm_text_sector_seven = get_field('gm_text_sector_seven');
$gm_text_sector_seven_two = get_field('gm_text_sector_seven_two');

//SECTOR 8
$gm_bg_sector_eight = get_field('gm_bg_sector_eight');
$gm_color_sector_eight = get_field('gm_color_sector_eight');
$gm_img_sector_eight = get_field('gm_img_sector_eight');
$gm_text_sector_eight = get_field('gm_text_sector_eight');

wp_register_style('new-grid-main-style', false);
wp_enqueue_style('new-grid-main-style');

$custom_css = "
            .section__social{ background-color: {$gm_bg_sector_one};}
            .social__title, .social__paragraph{ color: {$gm_color_first_text}}
            .section__manage{ background-color: {$gm_bg_sector_two};}
            .manage__title{ color: {$gm_color_sector_two}}
            .section__maintain{ background-color: {$gm_bg_sector_three};}
            .maintain__title{ color: {$gm_color_sector_three}}
            .section__schedule{ background-color: {$gm_bg_sector_four};}
            .schedule__title, .schedule__paragraph{ color: {$gm_color_sector_four}}
            .section__grow{ background-color: {$gm_bg_sector_five};}
            .grow__title{ color: {$gm_color_sector_five}}
            .section__fast{ background-color: {$gm_bg_sector_six};}
            .fast__title, .fast__paragraph{ color: {$gm_color_sector_six}}
            .section__create{ background-color: {$gm_bg_sector_seven};}
            .create__title{ color: {$gm_color_sector_seven}}
            .section__ai{ background-color: {$gm_bg_sector_eight};}
            .ai__title{ color: {$gm_color_sector_eight}}";                
wp_add_inline_style('new-grid-main-style', $custom_css);
?>

<section class="section-grid-main">
    <section class="section__social container-grid">
        <div class="social__container">
            <h1 class="social__title"><?php echo esc_html($gm_first_text); ?> <span class="social__title--color"><?php echo esc_html($gm_second_text); ?></span> <span class="social__title--oblique"><?php echo esc_html($gm_third_text); ?></span> <?php echo esc_html($gm_four_text); ?></h1>
            <figure class="social__picture">
                <?php if($gm_img_sector_one): ?>
                    <img src="<?php echo esc_attr($gm_img_sector_one);?>" class="social__img">
                <?php else: ?>
                    <img src="<?php echo MB_PLUGIN_URL . 'blocks/grid-main/img/sector1.jpg'?>" class="social__img">
                <?php endif; ?>
            </figure>
            <p class="social__paragraph"><?php echo esc_html($gm_p_sector_one); ?></p>
        </div>
    </section>

    <section class="section__manage container-grid">
        <div class="manage__container">
            <figure class="manage__picture">
                <?php if($gm_img_sector_two): ?>
                    <img src="<?php echo esc_attr($gm_img_sector_two);?>" class="manage__img">
                <?php else: ?>
                    <img src="<?php echo MB_PLUGIN_URL . 'blocks/grid-main/img/sector2.jpg'?>" class="manage__img">
                <?php endif; ?>
            </figure>
            <h3 class="manage__title"><?php echo esc_html($gm_text_sector_two); ?></h3>
        </div>
    </section>


    <section class="section__maintain container-grid">
        <div class="maintain__container">
            <h3 class="maintain__title"><?php echo esc_html($gm_text_sector_three); ?></h3>
            <figure class="maintain__picture">
                <?php if($gm_img_sector_three): ?>
                    <img src="<?php echo esc_attr($gm_img_sector_three);?>" class="maintain__img">
                <?php else: ?>
                    <img src="<?php echo MB_PLUGIN_URL . 'blocks/grid-main/img/sector3.jpg'?>" class="maintain__img">
                <?php endif; ?>
            </figure>
        </div>
    </section>

    <section class="section__schedule container-grid">
        <div class="schedule__container">
            <h3 class="schedule__title"><?php echo esc_html($gm_text_sector_four); ?></h3>
            <figure class="schedule__picture">
                <?php if($gm_img_sector_four): ?>
                    <img src="<?php echo esc_attr($gm_img_sector_four);?>" class="schedule__img">
                <?php else: ?>
                    <img src="<?php echo MB_PLUGIN_URL . 'blocks/grid-main/img/sector4.jpg'?>" class="schedule__img">
                <?php endif; ?>
            </figure>
            <p class="schedule__paragraph"><?php echo esc_html($gm_p_sector_four); ?></p>
        </div>
    </section>

    <section class="section__grow container-grid">
        <div class="grow__container">
            <figure class="grow__picture">
                <?php if($gm_img_sector_five): ?>
                    <img src="<?php echo esc_attr($gm_img_sector_five);?>" class="grow__img">
                <?php else: ?>
                    <img src="<?php echo MB_PLUGIN_URL . 'blocks/grid-main/img/sector5.jpg'?>" class="grow__img">
                <?php endif; ?>
            </figure>
            <h3 class="grow__title"><?php echo esc_html($gm_text_sector_five); ?></h3>
        </div>
    </section>

    <section class="section__fast container-grid">
        <div class="fast__container">
            <h3 class="fast__title"><?php echo esc_html($gm_text_sector_six); ?></h3>
            <p class="fast__paragraph"><?php echo esc_html($gm_text_sector_six_two); ?></p>
            <figure class="fast__picture">
                <?php if($gm_img_sector_six): ?>
                    <img src="<?php echo esc_attr($gm_img_sector_six);?>" class="fast__img">
                <?php else: ?>
                    <img src="<?php echo MB_PLUGIN_URL . 'blocks/grid-main/img/sector6.jpg'?>" class="fast__img">
                <?php endif; ?>
            </figure>
        </div>
    </section>

    <section class="section__create container-grid">
        <div class="create__container">
            <h3 class="create__title"><?php echo esc_html($gm_text_sector_seven); ?> <span class="create__title--colorblique"> <?php echo esc_html($gm_text_sector_seven_two); ?></span></h3>
            <figure class="create__picture">
                <?php if($gm_img_sector_six): ?>
                    <img src="<?php echo esc_attr($gm_img_sector_seven);?>" class="create__img">
                <?php else: ?>
                    <img src="<?php echo MB_PLUGIN_URL . 'blocks/grid-main/img/sector7.jpg'?>" class="create__img">
                <?php endif; ?>
            </figure>
        </div>
    </section>

    <section class="section__ai container-grid">
        <div class="ai__container">
            <h3 class="ai__title"><?php echo esc_html($gm_text_sector_eight); ?></h3>
            <figure class="ai__picture">
                <?php if($gm_img_sector_six): ?>
                    <img src="<?php echo esc_attr($gm_img_sector_eight);?>" class="ai__img">
                <?php else: ?>
                    <img src="<?php echo MB_PLUGIN_URL . 'blocks/grid-main/img/sector8.jpg'?>" class="ai__img">
                <?php endif; ?>
            </figure>
        </div>
    </section>
</section>

