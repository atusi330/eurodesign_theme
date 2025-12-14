# EURO DESIGN WordPress Theme 要件定義・仕様書

## 1. プロジェクト概要

### 1.1 テーマ情報
- **テーマ名**: EURO DESIGN
- **作者**: Atsushi Yasui
- **バージョン**: 1.0
- **説明**: ユーロデザインオリジナルデザイン
- **主要技術スタック**: WordPress, PHP, Tailwind CSS, JavaScript (Vanilla), SCSS

### 1.2 ビジネス概要
ポルシェ・ボクスター986専門の自動車販売・整備店舗のWebサイト。車両販売、整備サービス、カフェ併設による複合的なビジネスモデルを展開。

### 1.3 ターゲットユーザー
- ポルシェ・ボクスター986の購入検討者
- 既存オーナーのメンテナンス需要
- 輸入車愛好家のコミュニティ

## 2. 機能要件

### 2.1 カスタム投稿タイプ

#### 2.1.1 販売車両 (vehicle)
```php
投稿タイプ: vehicle
スラッグ: vehicles
アーカイブ: 有効
サポート: title, thumbnail
```

**カスタムフィールド (ACF使用)**:
- `year` - 年式
- `mileage` - 走行距離
- `accident_history` - 事故歴
- `displacement` - 排気量
- `price` - 価格
- `car_links` - 外部リンク（カーセンサー等）

**タクソノミー**:
- `vehicle_category` - 車種カテゴリ（階層型）

#### 2.1.2 FAQ (faq)
```php
投稿タイプ: faq
アーカイブ: 無効
サポート: title
```

**カスタムフィールド**:
- `answer` - 回答内容

### 2.2 Ajax機能

#### 2.2.1 車両読み込み
- **エンドポイント**: `wp_ajax_load_vehicles`
- **パラメータ**:
  - `category`: カテゴリスラッグ
  - `offset`: オフセット値
- **レスポンス**: JSON形式（HTML + 総件数）
- **表示件数**: 3件/回

#### 2.2.2 ブログ読み込み
- **エンドポイント**: `wp_ajax_load_blogs`
- **パラメータ**:
  - `category`: カテゴリスラッグ（'all'で全件）
- **表示件数**: 6件/回

#### 2.2.3 フィルタリング付きブログ
- **エンドポイント**: `wp_ajax_load_filtered_posts`
- **パラメータ**:
  - `category`: カテゴリスラッグ
  - `paged`: ページ番号
- **ページネーション**: 有効

### 2.3 ページテンプレート構成

#### 2.3.1 フロントページ構成
```
header.php
├── inc/template/hero.php        # ヒーローセクション
├── inc/template/vehicles.php    # 販売車両一覧
├── inc/template/services.php    # サービス紹介
├── inc/template/mechanic.php    # 整備士紹介
├── inc/template/cafe.php        # カフェ紹介
├── inc/template/blog-area.php   # ブログエリア
├── inc/template/faq.php         # FAQ
├── inc/template/contact.php     # お問い合わせ
footer.php
```

#### 2.3.2 ブログ関連
- `home.php` - ブログ一覧ページ
- `category.php` - カテゴリ別一覧
- `single.php` - 個別記事表示
- `inc/template/single-post.php` - 記事詳細テンプレート
- `inc/template/blog-card.php` - 記事カード部品

#### 2.3.3 車両関連
- `inc/template/vehicle-card.php` - 車両カード部品

## 3. 技術仕様

### 3.1 フロントエンド

#### 3.1.1 CSS/スタイリング
**Tailwind CSS設定**:
```javascript
// tailwind.config.js
content: [
  "./**/*.php",
  "./**/*.html",
  "./**/*.js",
]
```

**カスタムSCSS**:
- ヒーローセクションのグラデーション
- カードホバーアニメーション
- タブのグラデーションスタイル
- フェードインアニメーション
- モバイルメニューのトランジション

#### 3.1.2 JavaScript機能
**ajax-vehicles.js**:
- カテゴリ別フィルタリング
- 「もっと見る」機能
- オフセットベースのページネーション
- 動的コンテンツ更新

**ajax-blog.js**:
- カテゴリフィルタリング
- Ajaxページネーション
- タブ状態管理

**script.js**:
- モバイルメニュー制御
- スムーススクロール
- FAQアコーディオン
- ページ初期化処理

### 3.2 バックエンド

#### 3.2.1 依存関係
- WordPress 5.0以上
- PHP 7.4以上
- Advanced Custom Fields (ACF) プラグイン
- Contact Form 7 プラグイン

#### 3.2.2 外部連携
- Google Tag Manager (GTM-WB59JVNH)
- Google Fonts (Noto Sans JP)
- Font Awesome 6.5.0
- カーセンサーAPI（リンク連携）

### 3.3 セキュリティ対策
- `sanitize_text_field()` - 入力値のサニタイズ
- `intval()` - 数値型の検証
- `wp_localize_script()` - Ajax URLの安全な受け渡し
- 管理画面外でのみGTM実行

## 4. ディレクトリ構造

```
euro_design/
├── assets/
│   ├── css/
│   │   ├── main.scss       # カスタムスタイル
│   │   └── style.css       # Tailwindビルド出力
│   ├── img/
│   │   ├── cafe/           # カフェ画像
│   │   ├── common/         # 共通画像・ロゴ
│   │   ├── hero/           # ヒーロー背景
│   │   ├── mechanic/       # 整備士関連
│   │   └── services/       # サービス画像
│   └── js/
│       ├── ajax-blog.js    # ブログAjax
│       ├── ajax-vehicles.js # 車両Ajax
│       └── script.js       # 汎用スクリプト
├── inc/
│   └── template/           # テンプレートパーツ
├── node_modules/           # npm依存関係
├── partials/               # HTML部品（開発用）
├── functions.php           # テーマ機能定義
├── style.css              # テーマ情報
├── package.json           # npm設定
├── tailwind.config.js     # Tailwind設定
└── postcss.config.js      # PostCSS設定
```

## 5. ビジネス要件

### 5.1 主要機能
1. **販売車両管理**
   - 在庫管理システム
   - カテゴリ別表示
   - 外部サイト連携

2. **サービス紹介**
   - 整備・点検
   - 幌交換
   - 車検対応
   - 輸入車診断

3. **カフェ併設**
   - 待ち時間の有効活用
   - コミュニティスペース

4. **ブログ機能**
   - 整備記録
   - 新着車両情報
   - イベント告知

5. **問い合わせ対応**
   - Contact Form 7統合
   - 営業時間表示
   - アクセス情報

### 5.2 パフォーマンス要件
- Ajax利用による高速コンテンツ切り替え
- 画像最適化（WebP形式使用）
- レスポンシブ対応（モバイルファースト）
- Tailwind CSSによる軽量CSS

### 5.3 SEO要件
- カスタム投稿タイプのREST API対応
- 適切なURL構造（/vehicles/, /vehicle-category/）
- パンくずリスト実装
- 構造化データ対応準備

## 6. 開発・運用

### 6.1 開発環境構築
```bash
# 依存関係インストール
npm install

# Tailwind CSSビルド（開発時）
npm run dev

# Tailwind CSSビルド（本番）
npm run build
```

### 6.2 必要プラグイン
- Advanced Custom Fields (ACF) - 必須
- Contact Form 7 - 必須
- Google Tag Manager for WordPress - 推奨

### 6.3 デプロイメント
1. テーマファイルをwp-content/themes/にアップロード
2. 管理画面でテーマを有効化
3. 必要プラグインをインストール・有効化
4. カスタム投稿タイプのパーマリンク更新
5. ACFフィールド設定のインポート

## 7. 今後の拡張計画

### 7.1 機能追加候補
- [ ] 車両比較機能
- [ ] お気に入り機能
- [ ] LINE通知連携
- [ ] 在庫アラート機能
- [ ] オンライン見積もり

### 7.2 技術改善
- [ ] React/Vueでのインタラクティブ化
- [ ] PWA対応
- [ ] GraphQL API実装
- [ ] 画像の遅延読み込み最適化
- [ ] CDN統合

## 8. メンテナンス

### 8.1 定期更新項目
- WordPress本体のアップデート
- プラグインの更新
- セキュリティパッチ適用
- バックアップ実施

### 8.2 監視項目
- Google Analytics/GTMのトラッキング
- Contact Form 7の送信状況
- エラーログの確認
- パフォーマンス指標

## 9. お問い合わせ

開発に関するお問い合わせは作者（Atsushi Yasui）まで。

---

*最終更新: 2025年8月9日*
*バージョン: 1.0*