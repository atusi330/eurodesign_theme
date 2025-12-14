function toggleMobileMenu() {
  const menu = document.getElementById('mobile-menu');
  const hamburger = document.getElementById('hamburger-icon');
  const close = document.getElementById('close-icon');

  if (!menu || !hamburger || !close) {
    console.error('Menu elements not found');
    return;
  }

  if (menu.classList.contains('hidden')) {
    // Open menu
    menu.classList.remove('hidden');
    menu.style.display = 'block';
    setTimeout(() => {
      menu.classList.add('show');
    }, 10);
    hamburger.classList.add('hidden');
    close.classList.remove('hidden');
  } else {
    // Close menu
    menu.classList.remove('show');
    setTimeout(() => {
      menu.classList.add('hidden');
      menu.style.display = 'none';
    }, 300);
    hamburger.classList.remove('hidden');
    close.classList.add('hidden');
  }
}

function closeMobileMenu() {
  const menu = document.getElementById('mobile-menu');
  const hamburger = document.getElementById('hamburger-icon');
  const close = document.getElementById('close-icon');

  if (!menu || !hamburger || !close) return;

  menu.classList.remove('show');
  setTimeout(() => {
    menu.classList.add('hidden');
    menu.style.display = 'none';
  }, 300);
  hamburger.classList.remove('hidden');
  close.classList.add('hidden');
}

// Smooth scrolling
function scrollToSection(sectionId) {
  const element = document.getElementById(sectionId);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
}

// FAQ toggle
function toggleFAQ(faqNumber) {
  const content = document.getElementById('faq-content-' + faqNumber);
  const icon = document.getElementById('faq-icon-' + faqNumber);

  if (content.classList.contains('hidden')) {
    content.classList.remove('hidden');
    icon.textContent = '−';
  } else {
    content.classList.add('hidden');
    icon.textContent = '+';
  }
}

// Blog filtering
function filterBlog(category) {
  const items = document.querySelectorAll('.blog-item');
  const buttons = document.querySelectorAll('.filter-btn');

  // Reset all buttons
  buttons.forEach(btn => {
    btn.classList.remove('bg-blue-900', 'text-white');
    btn.classList.add('text-gray-600', 'hover:text-gray-900');
  });

  // Activate selected button
  const activeBtn = document.getElementById('filter-' + category);
  if (activeBtn) {
    activeBtn.classList.add('bg-blue-900', 'text-white');
    activeBtn.classList.remove('text-gray-600', 'hover:text-gray-900');
  }

  // Filter items
  items.forEach(item => {
    if (category === 'all' || item.classList.contains(category)) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}

// Initialize page on load
document.addEventListener('DOMContentLoaded', function () {
  showPage('home');
});
