<?php

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        // 投稿タイプ別にテンプレートを分ける
        $post_type = get_post_type();
        get_template_part("inc/template/single", $post_type);
    endwhile;
endif;

get_footer();
