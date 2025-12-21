<?php

// headにcssとjsを読み込む
function mytheme_enqueue_assets()
{
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/style.css', [], null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], '6.5.0');

    wp_enqueue_script('ajax-vehicles', get_template_directory_uri() . '/assets/js/ajax-vehicles.js', [], null, true);
    wp_enqueue_script('ajax-blog', get_template_directory_uri() . '/assets/js/ajax-blog.js', [], null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/script.js', [], null, true);

    // JSに ajaxurl を渡す（WordPressが提供するadmin-ajax.phpのURL）
    wp_localize_script('ajax-vehicles', 'ajaxVehicles', [
      'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
    wp_localize_script('ajax-blog', 'ajaxBlog', [
      'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');

function mytheme_add_gtag()
{
    if (!is_admin()) : ?>
   <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-WB59JVNH');</script>
  <!-- End Google Tag Manager -->
  <?php endif;
}
add_action('wp_head', 'mytheme_add_gtag');

add_theme_support('post-thumbnails');

// 販売車両カスタム投稿
function register_vehicle_post_type()
{
    register_post_type('vehicle', [
      'label' => '販売車両',
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'supports' => ['title', 'thumbnail'],
      'rewrite' => ['slug' => 'vehicles'],
      'show_in_rest' => true,
    ]);
}
add_action('init', 'register_vehicle_post_type');

// カテゴリ用のタクソノミー（986ボクスターなど）
function register_vehicle_taxonomy()
{
    register_taxonomy('vehicle_category', 'vehicle', [
      'label' => '車種カテゴリ',
      'public' => true,
      'hierarchical' => true,
      'rewrite' => ['slug' => 'vehicle-category'],
      'show_in_rest' => true,
    ]);
}
add_action('init', 'register_vehicle_taxonomy');

// 販売車両の販売状態フィールドをACFに追加
function register_vehicle_sale_status_acf_field()
{
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_vehicle_sale_status',
            'title' => '販売状態',
            'fields' => [
                [
                    'key' => 'field_vehicle_sale_status',
                    'label' => '販売状態',
                    'name' => 'sale_status',
                    'type' => 'select',
                    'instructions' => '車両の販売状態を選択してください',
                    'required' => 0,
                    'choices' => [
                        '販売中' => '販売中',
                        'SOLD' => 'SOLD',
                    ],
                    'default_value' => '販売中',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'vehicle',
                    ],
                ],
            ],
            'menu_order' => -1,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }
}
add_action('acf/init', 'register_vehicle_sale_status_acf_field');

function register_faq_post_type()
{
    register_post_type('faq', [
        'label' => 'FAQ',
        'public' => true,
        'has_archive' => false,
        'menu_position' => 6,
        'supports' => ['title'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'register_faq_post_type');

// Ajax処理（販売車両用）
add_action('wp_ajax_load_vehicles', 'ajax_load_vehicles');
add_action('wp_ajax_nopriv_load_vehicles', 'ajax_load_vehicles');

function ajax_load_vehicles()
{
    $category = sanitize_text_field($_POST['category']);
    $offset = intval($_POST['offset']);

    // 車両カード出力（3件）
    ob_start();
    $query = new WP_Query([
        'post_type' => 'vehicle',
        'posts_per_page' => 3,
        'offset' => $offset,
        'tax_query' => [[
            'taxonomy' => 'vehicle_category',
            'field'    => 'slug',
            'terms'    => $category,
        ]]
    ]);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('inc/template/vehicle-card');
        endwhile;
    else :
        echo '<p class="text-center col-span-3 text-gray-500">車両が見つかりませんでした。</p>';
    endif;
    wp_reset_postdata();
    $html = ob_get_clean();

    // 該当カテゴリの総件数取得
    $count_query = new WP_Query([
        'post_type' => 'vehicle',
        'posts_per_page' => -1,
        'tax_query' => [[
            'taxonomy' => 'vehicle_category',
            'field'    => 'slug',
            'terms'    => $category,
        ]]
    ]);
    $total = $count_query->found_posts;
    wp_reset_postdata();
    error_log("【AJAX】カテゴリ: $category / 件数: $total");

    // JSONでHTML＋件数を返す
    wp_send_json([
        'html' => $html,
        'total' => $total,
    ]);
}

// Ajax処理（ブログ用）

add_action('wp_ajax_load_blogs', 'ajax_load_blogs');
add_action('wp_ajax_nopriv_load_blogs', 'ajax_load_blogs');

function ajax_load_blogs()
{
    $category = sanitize_text_field($_POST['category']);

    $args = [
      'post_type' => 'post',
      'posts_per_page' => 6,
    ];

    if ($category !== 'all') {
        $args['tax_query'] = [[
          'taxonomy' => 'category', // 通常の投稿カテゴリならcategory
          'field' => 'slug',
          'terms' => $category,
        ]];
    }

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()): $query->the_post();
            get_template_part('inc/template/blog-card');
        endwhile;
        wp_send_json_success(ob_get_clean());
    } else {
        wp_send_json_error('記事が見つかりませんでした');
    }
    wp_die();
}

// Ajax処理（カテゴリ毎用）

add_action('wp_ajax_load_filtered_posts', 'load_filtered_posts');
add_action('wp_ajax_nopriv_load_filtered_posts', 'load_filtered_posts');

function load_filtered_posts()
{
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $category = sanitize_text_field($_POST['category']);

    $args = [
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 6,
      'paged' => $paged
    ];

    if ($category !== 'all') {
        $args['tax_query'] = [[
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => $category,
        ]];
    }

    $query = new WP_Query($args);
    ob_start();

    if ($query->have_posts()) :
        echo '<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">';
        while ($query->have_posts()) : $query->the_post();
            get_template_part('inc/template/blog-card');
        endwhile;
        echo '</div>';
        echo '<div class="pagination mt-8 text-center">';
        for ($i = 1; $i <= $query->max_num_pages; $i++) {
            $current_class = ($i == $paged) ? 'pagination-current font-bold' : '';
            echo '<a href="#" class="pagination-link inline-block mx-2 text-blue-700 font-semibold ' . $current_class . '" data-page="' . $i . '">' . $i . '</a>';
        }
        echo '</div>';
    else :
        echo '<p class="text-center text-gray-500">記事が見つかりませんでした。</p>';
    endif;

    wp_reset_postdata();
    echo ob_get_clean();
    wp_die();
}
