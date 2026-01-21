<?php
$style_effect = get_field('style_effect') != null ? get_field('style_effect') : 'style_1';
$container = get_field('container_effect') ? 'container-fluid' : 'container';
$mt = get_field('margin_top_effect');
$add_image = get_field('add_effect');
$title_effect = get_field('title_effect');

if (!empty($mt)){
    $mt_yes = ' style=margin-top:' . $mt .'px';
} else {
    $mt_yes= '';
}

$add_html = function($effect, $type){
    if($type === 'description'){
        return '<p>' . esc_html($effect['description_effect']) . '</p>';
    } elseif ($type === 'third_title') {
        return '<i>' . esc_html($effect['third_title_effect']) . '</i>';
    }
    return '';
};

$styles = [
    'style_1' => [
        'figure_class' => 'effect-1',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_2' => [
        'figure_class' => 'effect-2',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_3' => [
        'figure_class' => 'effect-3',
        'extra_html' => fn($effect) => $add_html($effect, 'third_title'),
    ],
    'style_4' => [
        'figure_class' => 'effect-4',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_5' => [
        'figure_class' => 'effect-5',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_6' => [
        'figure_class' => 'effect-6',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_7' => [
        'figure_class' => 'effect-7',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_8' => [
        'figure_class' => 'effect-8',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_9' => [
        'figure_class' => 'effect-9',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_10' => [
        'figure_class' => 'effect-10',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_11' => [
        'figure_class' => 'effect-11',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_12' => [
        'figure_class' => 'effect-12',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_13' => [
        'figure_class' => 'effect-13',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_14' => [
        'figure_class' => 'effect-14',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_15' => [
        'figure_class' => 'effect-15',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_16' => [
        'figure_class' => 'effect-16',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_17' => [
        'figure_class' => 'effect-17',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_18' => [
        'figure_class' => 'effect-18',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_19' => [
        'figure_class' => 'effect-19',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_20' => [
        'figure_class' => 'effect-20',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],
    'style_21' => [
        'figure_class' => 'effect-21',
        'extra_html' => fn($effect) => $add_html($effect, 'description'),
    ],

];
?>

<section class="section-block-effect grid" <?php echo esc_attr($mt_yes) ?>>
    <?php if(array_key_exists($style_effect, $styles)): ?>
    <div class="<?php echo esc_attr($container) ?>">
        <?php if($title_effect != ''): ?>
        <h2><?php echo esc_html($title_effect); ?></h2>
        <?php endif; ?>
        <div class="row">
            <?php if(!empty($add_image) && is_array($add_image)):
                foreach ($add_image as $image):
                    $image_effect = $image['image_effect'];
                    $link_title = $image['link_title'];
                    $first_title = $image['first_title_effect'];
                    $second_title = $image['second_title_effect'];

                    if(!empty($link_title)):
                        $link_title_start = '<a href="' . $link_title . '">';
                        $link_title_end = '</a>';
                    else:
                        $link_title_start = '';
                        $link_title_end = '';
                    endif;

                    ?>
                    <div class="col-12 col-md-6 mb-4">
                        <figure class="<?php echo esc_attr($styles[$style_effect]['figure_class']) ?>">
                            <img src="<?php echo esc_html($image_effect); ?>" alt="<?php echo esc_html($first_title); ?>">
                            <figcaption>
                                <div>
                                    <h2>
                                        <?php echo $link_title_start; ?><?php echo esc_html($first_title); ?>
                                        <span><?php echo esc_html($second_title); ?></span>
                                        <?php if($style_effect === 'style_3'):
                                            echo call_user_func($styles[$style_effect]['extra_html'], $image);
                                        endif;
                                        ?>
                                        <?php echo $link_title_end; ?>
                                    </h2>
                                    <?php if($style_effect !== 'style_3'):
                                        echo call_user_func($styles[$style_effect]['extra_html'], $image);
                                    endif;
                                    ?>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
    <?php endif; ?>
</section>
