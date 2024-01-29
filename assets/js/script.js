document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('togglePassword').addEventListener('click', function () {
      // パスワード入力フィールドを取得
      const passwordInput = document.getElementById('password');
      
      // チェックボックスの状態に基づいてパスワードフィールドのタイプを切り替える
      if (this.checked) {
          passwordInput.type = 'text';
      } else {
          passwordInput.type = 'password';
      }
  });
});