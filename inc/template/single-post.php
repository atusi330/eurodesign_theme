<?php get_header(); ?>

<article class="py-16 bg-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Breadcrumb -->
    <div class="bg-gray-50 py-4 mb-6">
      <nav class="breadcrumb text-sm text-gray-600">
        <a href="<?php echo home_url(); ?>" class="hover:text-blue-900">ホーム</a>
        <span class="mx-2">></span>
        <a href="<?php echo get_post_type_archive_link('post'); ?>" class="hover:text-blue-900">ブログ一覧</a>
        <span class="mx-2">></span>
        <span class="text-gray-900"><?php the_title(); ?></span>
      </nav>
    </div>

    <!-- Article Header -->
    <header class="mb-12">
      <div class="text-sm text-blue-900 font-semibold mb-4">
        <?php the_category(', '); ?>
      </div>
      <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-relaxed md:leading-normal mb-6">
        <?php the_title(); ?>
      </h1>
      <div class="flex items-center text-gray-600 mb-8">
        <span>投稿日: <?php the_time('Y年n月j日'); ?></span>
        <?php if ($author = get_the_author()) : ?>
          <span class="mx-4">|</span>
          <span>投稿者: <?php echo esc_html($author); ?></span>
        <?php endif; ?>
      </div>

      <!-- Featured Image -->
      <?php if (has_post_thumbnail()) : ?>
        <div class="w-full h-80 rounded-xl overflow-hidden mb-8">
          <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
        </div>
      <?php endif; ?>
    </header>

    <!-- Content -->
    <div class="prose prose-lg max-w-none">
      <?php the_content(); ?>
    </div>

  </div>
</article>
<?php
$categories = wp_get_post_categories($post->ID);
$args = [
  'category__in' => $categories,
  'post__not_in' => [$post->ID],
  'posts_per_page' => 3
];
$related = new WP_Query($args);
if ($related->have_posts()):
    ?>
<div class="max-w-4xl mx-auto px-4 pb-20 sm:px-6 lg:px-8">
  <h2 class="text-2xl font-semibold mb-4">あわせて読みたい記事</h2>
  <ul class="list-disc list-inside text-lg space-y-1">
    <?php while ($related->have_posts()): $related->the_post(); ?>
      <li><a href="<?php the_permalink(); ?>" class="text-blue-600 hover:underline"><?php the_title(); ?></a></li>
    <?php endwhile; ?>
  </ul>
</div>
<?php
    wp_reset_postdata();
endif;
?>
<!-- 固定CTA -->
<div class="bg-gray-950/50 fixed bottom-0 left-0 w-full z-50 p-4 sm:p-3">
  <div class="max-w-3xl mx-auto flex gap-4 justify-center">
    <a href="<?php echo home_url()?>#contact" class="bg-blue-600 text-white py-3 px-5 rounded-lg shadow-md hover:bg-blue-700 text-sm sm:text-base">お問い合わせ</a>
    <a href="<?php echo home_url()?>#vehicles" class="bg-green-600 text-white py-3 px-5 rounded-lg shadow-md hover:bg-green-700 text-sm sm:text-base">車両を見に行く</a>
  </div>
</div>
<?php get_footer(); ?>