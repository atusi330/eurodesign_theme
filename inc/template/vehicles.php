<?php
$default_category = 'boxster-986';
$initial_count = 3;

// カテゴリ内の全件数取得（もっと見るボタン制御用）
$total_query = new WP_Query([
  'post_type' => 'vehicle',
  'tax_query' => [
    [
      'taxonomy' => 'vehicle_category',
      'field'    => 'slug',
      'terms'    => $default_category,
    ]
  ],
  'posts_per_page' => -1,
]);
$total_count = $total_query->found_posts;
// var_dump($total_count); // デバッグ用
wp_reset_postdata();
?>

<section class="py-20 bg-gray-50" id="vehicles">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">販売車両</h2>
      <p class="text-xl text-gray-600">厳選された986ボクスターを中心とした高品質な車両をご用意</p>
      <div class="section-divider w-32 mx-auto mt-6"></div>
    </div>

    <!-- Tabs -->
    <?php
$terms = get_terms([
  'taxonomy' => 'vehicle_category',
  'hide_empty' => false,
]);
?>

    <div class="flex justify-center mb-12">
      <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-200">
        <?php foreach ($terms as $index => $term): ?>
          <?php
            $is_first = ($index === 0);
            $tab_classes = 'tab-button px-6 py-3 rounded-lg font-semibold transition-all';
            $tab_classes .= $is_first ? ' tab-active' : ' text-gray-600';
            ?>
          <button
            class="<?php echo $tab_classes; ?>"
            data-category="<?php echo esc_attr($term->slug); ?>"
          >
            <?php echo esc_html($term->name); ?>
          </button>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Vehicle Cards Wrapper -->
    <div id="vehicles-wrapper" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
      <?php
      $args = [
        'post_type' => 'vehicle',
        'posts_per_page' => $initial_count,
        'tax_query' => [
            [
              'taxonomy' => 'vehicle_category',
              'field'    => 'slug',
              'terms'    => $default_category,
            ]
        ]
      ];
$query = new WP_Query($args);
if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        get_template_part('inc/template/vehicle-card');
    endwhile;
    wp_reset_postdata();
endif;
?>
    </div>

    <!-- Load More Button：3件以上のときのみ表示。常に出力、表示/非表示はJSに任せる -->
    <div class="text-center">
      <button id="load-more"
              data-page="1"
              data-category="<?php echo esc_attr($default_category); ?>"
              data-total="<?php echo esc_attr($total_count); ?>"
              data-loaded="<?php echo esc_attr($initial_count); ?>"
              class="mx-auto bg-white hover:bg-gray-50 text-blue-900 border border-blue-900 px-8 py-3 rounded-lg font-semibold transition-colors"
              style="<?php echo ($total_count <= $initial_count) ? 'display: none;' : ''; ?>">
        もっと見る
      </button>
    </div>

    <p class="text-center mt-4 text-sm text-gray-500">
      車両価格の更新が遅れる場合がございます。正しくは、カーセンサーの価格をご確認ください。
    </p>
  </div>
</section>