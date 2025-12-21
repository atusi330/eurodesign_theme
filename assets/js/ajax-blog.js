document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.filter-btn');
  let currentCategory = 'all';

  function loadPosts(category = 'all', paged = 1) {
    fetch(ajaxBlog.ajaxurl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        action: 'load_filtered_posts',
        category,
        paged,
      }),
    })
      .then(res => res.text())
      .then(html => {
        document.querySelector('#posts-wrapper').innerHTML = html;
        currentCategory = category;
        // カレントページのスタイルを更新
        const paginationLinks = document.querySelectorAll('.pagination-link');
        paginationLinks.forEach(link => {
          const pageNum = parseInt(link.dataset.page);
          if (pageNum === paged) {
            link.classList.add('pagination-current', 'font-bold');
          } else {
            link.classList.remove('pagination-current', 'font-bold');
          }
        });
      });
  }

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('tab-active'));
      tab.classList.add('tab-active');
      loadPosts(tab.dataset.category, 1);
    });
  });

  document.addEventListener('click', e => {
    if (e.target.classList.contains('pagination-link')) {
      e.preventDefault();
      const page = parseInt(e.target.dataset.page);
      loadPosts(currentCategory, page);
    }
  });
});
