<div class="search-bar-eventos">
    <div class="row justify-content-center">
        <div class="col-12">

            <div class="dropdown">
                <button class="btn btn-grid-selector dropdown-toggle" type="button" id="gridMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    if (isset($_GET['cat_evento']) && !empty($_GET['cat_evento'])) {
                        $term = get_term_by('slug', $_GET['cat_evento'], 'eventos-categorias');
                        echo $term ? esc_html($term->name) : 'Categoría';
                    } else {
                        echo '¿Qué quieres ver?';
                    }
                    ?>
                </button>

                <div class="dropdown-menu dropdown-grid-menu" aria-labelledby="gridMenuButton">
                    <a class="dropdown-grid-item item-full-width" href="<?php echo home_url('/eventos/'); ?>">
                        Todas las categorías
                    </a>

                    <?php
                    $categories = get_terms([
                        'taxonomy' => 'eventos-categorias',
                        'hide_empty' => true
                    ]);

                    if (!empty($categories) && !is_wp_error($categories)):
                        foreach ($categories as $cat):
                            $url = add_query_arg('cat_evento', $cat->slug, home_url('/eventos/'));
                            ?>
                            <a class="dropdown-grid-item" href="<?php echo esc_url($url); ?>">
                                <?php echo esc_html($cat->name); ?>
                            </a>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>