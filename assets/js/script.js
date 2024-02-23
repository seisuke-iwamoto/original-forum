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
    if (document.getElementById('dropDownMenu')) {
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
    }

    // 質問投稿画面のテキストエリアのカウントダウン
    if (document.getElementById('questions_body')) {
        function count_down() {
            const obj = document.getElementById('questions_body');
            const element = document.getElementById('count');
            element.innerHTML = 1000 - obj.value.length;

            if (1000 - obj.value.length < 0) {
                element.style.color = '#EF4444';
            } else {
                element.style.color = '#000';
            }
        }
    }

    // イベントリスナーをテキストエリアに追加
    if (document.getElementById('questions_body')) {
        const textarea = document.getElementById('questions_body');
        if (textarea) {
            textarea.addEventListener('keyup', count_down);
        }
    }
});