<article class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden card-hover">
  <a href="<?php the_permalink(); ?>">
    <div class="h-48 overflow-hidden">
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']); ?>
      <?php else : ?>
        <div class="w-full h-full bg-gray-200"></div>
      <?php endif; ?>
    </div>

    <div class="p-6">
      <?php
      $categories = get_the_category();
  if (!empty($categories)) :
      $cat = $categories[0];
      ?>
        <div class="text-sm font-semibold mb-2">
          <?php echo esc_html($cat->name); ?>
        </div>
      <?php endif; ?>

      <h3 class="text-xl font-bold text-gray-900 mb-3"><?php the_title(); ?></h3>

      <p class="text-gray-600 mb-4 text-sm leading-relaxed">
        <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
      </p>

      <div class="flex justify-between items-center text-sm text-gray-500">
        <span><?php echo get_the_date(); ?></span>
        <span class="text-blue-900 font-semibold">続きを読む →</span>
      </div>
    </div>
  </a>
</article>