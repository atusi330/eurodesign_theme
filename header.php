<?php
/**
 * The header for euro_design theme.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

  <!-- Tailwind CSS -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <?php wp_head(); ?>
</head>
<body <?php body_class("bg-white"); ?>>

<!-- Header Navigation -->
<nav class="bg-white/95 backdrop-blur-sm fixed w-full z-50 shadow-sm border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <div class="flex items-center">
        <a href="<?php echo home_url('/'); ?>" class="text-2xl font-bold text-blue-900 hover:text-blue-800 transition-colors">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/ed_logo.svg?>" alt="EURODESIGNロゴ" class=" w-full h-auto">
        </a>
        <div class="ml-3 text-sm text-gray-600 hidden sm:block">986ボクスター専門店</div>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex space-x-8">
        <a href="<?php echo home_url()?>#vehicles" class="text-gray-700 hover:text-blue-900 transition-colors font-medium">車両一覧</a>
        <a href="<?php echo home_url()?>#services" class="text-gray-700 hover:text-blue-900 transition-colors font-medium">整備・点検</a>
        <a href="<?php echo home_url()?>#blog" class="text-gray-700 hover:text-blue-900 transition-colors font-medium">ブログ</a>
        <a href="<?php echo home_url()?>#contact" class="text-gray-700 hover:text-blue-900 transition-colors font-medium">お問い合わせ</a>
      </div>

      <!-- Mobile Menu Button -->
      <div class="md:hidden">
        <button id="hamburger-icon" class="text-gray-700 hover:text-blue-900 focus:outline-none"
                onclick="toggleMobileMenu()">
          <!-- Hamburger Icon -->
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        <button id="close-icon" class="hidden text-gray-700 hover:text-blue-900 focus:outline-none"
                onclick="toggleMobileMenu()">
          <!-- Close Icon -->
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden absolute top-16 left-0 w-full bg-white shadow-md md:hidden mobile-menu-slide">
    <a href="<?php echo home_url()?>#vehicles" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 text-center">車両一覧</a>
    <a href="<?php echo home_url()?>#services" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 text-center">整備・点検</a>
    <a href="<?php echo home_url()?>#blog" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 text-center">ブログ</a>
    <a href="<?php echo home_url()?>#contact" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 text-center">お問い合わせ</a>
  </div>
</nav>
