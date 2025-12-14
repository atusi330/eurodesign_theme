<?php // Template Part?>

<!-- FAQ Section -->
<section class="py-20 bg-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">よくある質問</h2>
      <div class="section-divider w-32 mx-auto mt-6"></div>
    </div>

    <div class="space-y-6">
      <?php
        $args = [
          'post_type' => 'faq',
          'posts_per_page' => 5, // 最新5件を表示
          'orderby' => 'menu_order',
          'order' => 'ASC',
        ];
$faq_query = new WP_Query($args);
if ($faq_query->have_posts()) :
    $cnt = 0;
    while ($faq_query->have_posts()) : $faq_query->the_post();
        $answer = get_field('answer');
        $clean_answer = wp_strip_all_tags($answer);
        ?>
        <div class="bg-gray-50 rounded-lg border border-gray-200">
          <button
          onclick="toggleFAQ(<?php echo $cnt; ?>)"
          class="w-full p-6 text-left flex justify-between items-center hover:bg-gray-100 transition-colors">
            <span class="font-semibold text-gray-900"><?php the_title(); ?> </span>
            <span id="faq-icon-<?php echo $cnt; ?>" class="text-2xl text-blue-900">+</span>
          </button>
          <div id="faq-content-<?php echo $cnt; ?>" class="hidden px-6 pb-6 bg-white">
            <p class="text-gray-700 pt-6">
              <?php echo $clean_answer; ?>
            </p>
          </div>
        </div>
        <?php $cnt++; ?>
      <?php endwhile;
    wp_reset_postdata();
else: ?>
        <p class="text-center text-gray-500">現在、FAQは登録されていません。</p>
      <?php endif; ?>
    </div>
  </div>
</section>