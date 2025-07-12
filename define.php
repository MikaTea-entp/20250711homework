<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    👷工事中👷



<script>
    document.getElementById('submit-journal').addEventListener('click', function () {
        const title = document.getElementById('journal-title').value.trim();
        const text = document.getElementById('journal-text').value.trim();

        if (!title || !text) {
            alert('タイトルと本文を入力してください。');
            return;
        }

    // タイトルと現在のタイムスタンプを組み合わせてユニークなキーを生成
        const timestamp = new Date().toISOString();
        const uniqueKey = `${title} [${timestamp}]`;

        localStorage.setItem(uniqueKey, text);
        alert('ジャーナルを保存しました！');

        document.getElementById('journal-title').value = '';
        document.getElementById('journal-text').value = '';

        displaySavedJournals();
    });

    function displaySavedJournals() {
        const listContainer = document.getElementById('journal-list');
        listContainer.innerHTML = '';

        if (localStorage.length === 0) {
            listContainer.innerHTML = '<p>保存されたジャーナルはありません。</p>';
            return;
        }

        const keys = Object.keys(localStorage).sort();

        keys.forEach((key) => {
            const content = localStorage.getItem(key);

            const entry = document.createElement('div');
            entry.style.marginBottom = '2rem';
            entry.innerHTML = `
                <h3>${key}</h3>
                <p>${content.replace(/\n/g, "<br>")}</p>
                <button onclick="deleteJournal('${key}')">🗑 削除</button>
                <hr/>
            `;
            listContainer.appendChild(entry);
        });
    }

    function deleteJournal(key) {
        if (confirm(`「${key}」を削除しますか？`)) {
            localStorage.removeItem(key);
            displaySavedJournals();
        }
    }

    // 初回読み込み時に表示
    window.addEventListener('DOMContentLoaded', displaySavedJournals);
</script>

<footer>
    &copy; 2025 株式会社Savants - All rights reserved.
</footer>

</body>
</html>