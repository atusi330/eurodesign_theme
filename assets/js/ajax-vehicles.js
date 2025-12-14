document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.tab-button');
  const wrapper = document.querySelector('#vehicles-wrapper');
  let loadMoreBtn = document.querySelector('#load-more');

  let currentCategory = 'boxster-986';
  let offset = 3;

  const loadVehicles = (reset = false) => {
    fetch(ajaxVehicles.ajaxurl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        action: 'load_vehicles',
        category: currentCategory,
        offset: reset ? 0 : offset,
      }),
    })
      .then(res => res.json())
      .then(data => {
        const html = data.html;
        const total = parseInt(data.total);

        // console.log('カテゴリ:', currentCategory);
        // console.log('Ajax total:', total);
        // console.log('offset:', offset);

        if (reset) {
          wrapper.innerHTML = html;
          offset = 3;

          // ボタン再取得（タブ切り替えで再描画された場合）
          loadMoreBtn = document.querySelector('#load-more');

          if (loadMoreBtn) {
            loadMoreBtn.dataset.loaded = offset;
            loadMoreBtn.dataset.total = total;
            loadMoreBtn.dataset.category = currentCategory;

            loadMoreBtn.style.display = offset >= total ? 'none' : 'block';

            // 既存イベントを無効化してから再登録（多重登録防止）
            const newBtn = loadMoreBtn.cloneNode(true);
            loadMoreBtn.parentNode.replaceChild(newBtn, loadMoreBtn);
            loadMoreBtn = newBtn;

            loadMoreBtn.addEventListener('click', () => loadVehicles());
          }
        } else {
          wrapper.insertAdjacentHTML('beforeend', html);
          offset += 3;

          if (loadMoreBtn) {
            loadMoreBtn.dataset.loaded = offset;
            loadMoreBtn.dataset.total = total;

            if (offset >= total) {
              loadMoreBtn.style.display = 'none';
            }
          }
        }
      })
      .catch(err => {
        console.error('車両の読み込み中にエラーが発生しました', err);
      });
  };

  // タブ切り替え処理
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(b => {
        b.classList.remove('tab-active', 'text-white');
        b.classList.add('text-gray-600');
      });
      tab.classList.add('tab-active', 'text-white');
      tab.classList.remove('text-gray-600');

      currentCategory = tab.dataset.category;
      offset = 3;

      // loadMoreBtn自体はタブ切り替え後に再取得されるため、ここでは null にしておくだけでOK
      loadMoreBtn = null;

      loadVehicles(true);
    });
  });

  // 初回のもっと見るボタン登録（offset=3の状態で）
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', () => loadVehicles());
  }
});
