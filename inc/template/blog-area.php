<section id="blog" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-gray-900 mb-4">ブログ</h2>
      <p class="text-xl text-gray-600">整備やレビューなど、お役立ち情報をお届け</p>
      <div class="section-divider w-32 mx-auto mt-6"></div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php
      $args = [
        'post_type' => 'post',
        'posts_per_page' => 3,
      ];
      $blog_query = new WP_Query($args);
      if ($blog_query->have_posts()) :
          while ($blog_query->have_posts()) : $blog_query->the_post();
              get_template_part('inc/template/blog-card');
          endwhile;
          wp_reset_postdata();
      else :
          echo '<p class="text-gray-500">記事が見つかりませんでした。</p>';
      endif;
      ?>
    </div>

    <div class="text-center mt-12">
      <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
         class="bg-blue-900 hover:bg-blue-800 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
        ブログ一覧を見る
      </a>
    </div>
  </div>
</section>