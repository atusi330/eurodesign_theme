module.exports = {
  content: [
    './*.html',
    './partials/*.html',
    './assets/js/*.js',

    // ↓ PHPファイルを追加（WordPressテーマ用）
    './*.php',
    './partials/*.php',
    './template-parts/**/*.php',
    './inc/**/*.php',
    './functions.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
