
<footer class="bg-gray-900 text-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center">
      <div class="text-3xl font-bold mb-2"><?php bloginfo('name'); ?></div>
      <p class="text-gray-400 mb-6">
        <?php _e('986ボクスター専門店 | 整備士が支えるボクスターライフ', 'your-theme-textdomain'); ?>
      </p>
      <!-- <div class="flex justify-center space-x-4 mb-6">
        <a href="https://facebook.com" class="hover:text-gray-300" target="_blank" rel="noopener">
          <i class="fab fa-facebook-f text-2xl"></i>
        </a>
        <a href="https://twitter.com" class="hover:text-gray-300" target="_blank" rel="noopener">
          <i class="fab fa-twitter text-2xl"></i>
        </a>
        <a href="https://instagram.com" class="hover:text-gray-300" target="_blank" rel="noopener">
          <i class="fab fa-instagram text-2xl"></i>
        </a>
      </div> -->
      <div class="border-t border-gray-800 pt-8">
        <p class="text-gray-500 text-sm">
          &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'your-theme-textdomain'); ?>
        </p>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
