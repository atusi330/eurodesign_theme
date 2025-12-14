<?php // Template Part?>

<!-- Service Section -->
<section id="services" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
        整備・点検サービス
      </h2>
      <p class="text-xl text-gray-600">
        国家1級整備士による確かな技術で、あなたの愛車をサポート
      </p>
      <div class="section-divider w-32 mx-auto mt-6"></div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
      <div class="text-center p-6 bg-gray-50 rounded-xl card-hover">
        <div class="w-32 h-32 mx-auto mb-4 rounded-lg overflow-hidden">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/services/service_mainte.webp"
            alt="定期点検・整備アイコン"
            class="w-full h-full object-cover"
          />
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">
          定期点検・整備
        </h3>
        <p class="text-gray-600 text-sm">
          オイル交換から大規模整備まで幅広く対応
        </p>
      </div>
      <div class="text-center p-6 bg-gray-50 rounded-xl card-hover">
        <div class="w-32 h-32 mx-auto mb-4 rounded-lg overflow-hidden">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/services/service_hood.webp"
            alt="幌交換アイコン"
            class="w-full h-full object-cover"
          />
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">幌交換</h3>
        <p class="text-gray-600 text-sm">
          ボクスター専門店ならではの幌交換技術
        </p>
      </div>
      <div class="text-center p-6 bg-gray-50 rounded-xl card-hover">
        <div class="w-32 h-32 mx-auto mb-4 rounded-lg overflow-hidden">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/services/service_insp.webp"
            alt="車検代行アイコン"
            class="w-full h-full object-cover"
          />
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">車検代行</h3>
        <p class="text-gray-600 text-sm">
          輸入車の車検も安心してお任せください
        </p>
      </div>
      <div class="text-center p-6 bg-gray-50 rounded-xl card-hover">
        <div class="w-32 h-32 mx-auto mb-4 rounded-lg overflow-hidden">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/services/service_imp.webp"
            alt="輸入車点検アイコン"
            class="w-full h-full object-cover"
          />
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">
          輸入車点検
        </h3>
        <p class="text-gray-600 text-sm">輸入車特有の問題も的確に診断</p>
      </div>
    </div>

    <div class="bg-blue-50 rounded-2xl p-8 md:p-12 mb-12">
      <div class="flex flex-col md:flex-row items-center gap-8">
        <div class="text-center md:text-left flex-1">
          <div
            class="flex items-center justify-center md:justify-start mb-4"
          >
            <div class="text-4xl mr-3">☕</div>
            <h3 class="text-2xl font-bold text-gray-900">
              カフェ併設で相談しやすい
            </h3>
          </div>
          <p class="text-gray-700 mb-6 leading-relaxed">
            整備の待ち時間や相談時には、併設のカフェスペースでリラックスしてお過ごしいただけます。
            コーヒーを飲みながら、整備内容について詳しくご説明いたします。
          </p>
          <button
            onclick="scrollToSection('contact')"
            class="bg-blue-900 hover:bg-blue-800 text-white px-8 py-3 rounded-lg font-semibold transition-colors"
          >
            販売・整備の相談する
          </button>
        </div>
        <div class="w-64 h-48 rounded-xl overflow-hidden">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/services/services_cafe.webp"
            alt="カフェスペース"
            class="w-full h-full object-cover"
          />
        </div>
      </div>
    </div>

    <!-- Service Detail CTA 詳細ページ準備中-->
    <!-- <div class="text-center">
      <button
        onclick="showPage('service-detail')"
        class="bg-blue-900 hover:bg-blue-800 text-white px-12 py-4 rounded-lg font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg"
      >
        整備サービス詳細を見る
      </button>
    </div> -->
  </div>
</section>