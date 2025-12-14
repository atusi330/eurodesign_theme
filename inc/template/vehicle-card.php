<?php
$year = get_field('year');
$mileage = get_field('mileage');
$accident = get_field('accident_history');
$displacement = get_field('displacement');
$price = get_field('car_price');
$link = get_field('car_links');

?>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden card-hover">
  <?php if (has_post_thumbnail()) : ?>
    <div class="h-48 bg-gray-100 overflow-hidden">
      <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300']); ?>
    </div>
  <?php endif; ?>
  <div class="p-6">
    <h3 class="text-xl font-bold text-gray-900 mb-2"><?php the_title(); ?></h3>
    <div class="text-sm text-gray-600 mb-4 space-y-1">
      <div>年式: <?= esc_html($year); ?></div>
      <div>走行距離: <?= esc_html($mileage); ?>km</div>
      <div>修復歴: <?= esc_html($accident); ?></div>
      <div>排気量: <?= esc_html($displacement); ?>cc</div>
    </div>
    <div class="text-2xl font-bold text-blue-900 mb-4">支払総額：<?= number_format($price, 1); ?>万円</div>
    <a href="<?= esc_url($link); ?>" target="_blank" class="block w-full bg-blue-900 hover:bg-blue-800 text-white py-3 rounded-lg font-semibold text-center transition-colors">
      カーセンサーを見る
    </a>
  </div>
</div>