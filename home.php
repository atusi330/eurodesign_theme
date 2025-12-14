<?php get_header(); ?>

<section class="pt-16">
  <!-- Breadcrumb -->
  <div class="bg-gray-50 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <nav class="breadcrumb">
        <a href="<?php echo home_url(); ?>" class="hover:text-blue-900 transition-colors">ホーム</a>
        <span class="mx-2">></span>
        <span class="text-gray-900"><?php single_post_title(); ?></span>
      </nav>
    </div>
  </div>

  <!-- Blog List Header -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4"><?php echo get_the_title(get_option('page_for_posts')); ?></h1>
        <p class="text-xl text-gray-600">整備やレビューなど、お役立ち情報をお届け</p>
        <div class="section-divider w-32 mx-auto mt-6"></div>
      </div>

      <div id="blog-filter-tabs" class="flex  flex-wrap md:flex-nowrap justify-center mb-12">
        <?php
          $categories = get_categories(['hide_empty' => true]);
echo '<button class="tab-btn filter-btn tab-active px-6 py-3" data-category="all">すべて</button>';
foreach ($categories as $cat) {
    echo '<button class="tab-btn filter-btn px-6 py-3" data-category="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</button>';
}
?>
      </div>

      <div id="posts-wrapper">
        <?php
  $args = [
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => 1
  ];
$query = new WP_Query($args);
if ($query->have_posts()) :
    echo '<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">';
    while ($query->have_posts()) : $query->the_post();
        get_template_part('inc/template/blog-card');
    endwhile;
    echo '</div>';
    echo '<div class="pagination mt-8 text-center">';
    for ($i = 1; $i <= $query->max_num_pages; $i++) {
        echo '<a href="#" class="pagination-link inline-block mx-2 text-blue-700 font-semibold" data-page="' . $i . '">' . $i . '</a>';
    }
    echo '</div>';
else :
    echo '<p class="text-center text-gray-500">記事が見つかりませんでした。</p>';
endif;
wp_reset_postdata();
?>
      </div>
    </div>
  </section>
</section>

<?php get_footer(); ?>