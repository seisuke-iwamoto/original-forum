document.addEventListener('DOMContentLoaded', function () {

    // 会員登録画面のパスワード表示
    if (document.getElementById('togglePassword')) {
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
    }

    // ヘッダーのドロップダウンメニュー
    const dropDownMenu = document.getElementById('dropDownMenu');

    function toggleSubmenu(isVisible) {
        const dropDownSubMenu = dropDownMenu.querySelector('ul');
        dropDownSubMenu.classList.toggle('hidden', !isVisible);
    }

    dropDownMenu.addEventListener('mouseenter', function () {
        toggleSubmenu(true);
    });

    dropDownMenu.addEventListener('mouseleave', function () {
        toggleSubmenu(false);
    });
});