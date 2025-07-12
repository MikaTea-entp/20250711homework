<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Journal</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f7f7f7;
        color: #333;
        line-height: 1.6;
        margin: 0;
        padding: 2rem;
    }
    h1, h2, h3 {
        color: #222;
    }
    blockquote {
        border-left: 4px solid #999;
        padding-left: 1rem;
        color: #666;
        font-style: italic;
    }
    code {
        background: #eee;
        padding: 2px 4px;
        border-radius: 4px;
    }
    .section {
        background: rgba(255, 255, 255, 0.85); /* 背景のみ透明 */
        padding: 2rem;
        margin-bottom: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    ul {
        padding-left: 1.5rem;
    }
    a {
        color: #0366d6;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    footer {
        text-align: center;
        font-size: 0.9rem;
        color: #f7f7f7;
        margin-top: 4rem;
    }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: url("../pictures/Golden_Gate_Bridge.jpg") center center / cover no-repeat fixed;
        color: #333;
        line-height: 1.6;
        margin: 0;
        padding: 2rem;
    }
    .input-area {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1rem;
    }
    .input-area input,
    .input-area textarea {
        width: 100%;
        font-size: 1rem;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        background: #fff;
    }

    /* ===== スマホ対応レスポンシブ追加 ===== */
    @media (max-width: 600px) {
    body {
        padding: 0.5rem;
        line-height: 1.45; /* 文字多いのでちょい詰め */
    }
    .section {
        padding: 0.7rem 0.6rem;
        margin-bottom: 1rem;
        border-radius: 6px;
        max-width: 98vw;      /* 文字多いので横幅詰め */
    }
    .section p, .section ul, .section blockquote {
        font-size: 0.98rem;
        line-height: 1.45;
        letter-spacing: 0.01em;
        word-break: break-word;
        margin-bottom: 0.8em;
        max-width: 38em;     /* 1行の最大文字数を制限 */
    }
    h1 { font-size: 1.35rem; }
    h2 { font-size: 1.07rem; }
    h3 { font-size: 0.95rem; }
    .input-area input,
    .input-area textarea {
        font-size: 0.98rem;
        padding: 0.5rem;
    }
    button {
        font-size: 1.02rem;
        padding: 0.7rem;
        border-radius: 7px;
        width: 100%;
    }
    footer {
        font-size: 0.75rem;
        padding: 1rem 0;
    }
    }

    </style>
    <link rel="icon" href="../pictures/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="section">
        <h1>心のデバッグログ / Mind Debug Log</h1>
        <blockquote>
            “In the journal I do not just express myself more openly than I could to any person; I create myself.”<br/>
            ― Susan Sontag, <i>"Reborn: Journals and Notebooks"</i>
        </blockquote>
        <blockquote>
            “We write to taste life twice, in the moment and in retrospect.”<br/>
            ― Anaïs Nin
        </blockquote>
    </div>

    <div class="section">
        <p>このページは、あなたの「心のデバッグログ」。<br/>
            日々の中でふと感じたモヤモヤや、言葉にしづらい気持ちを、そっと書き残す場所です。<br/>
            「こんなことで悩むなんて…」と思うことも、ここでは否定せずに、そのまま書いてみてください。<br/>
        <br/>
            小さな違和感や、まだはっきりしない気持ちも、書き出すことで少しずつ輪郭が見えてきます。<br/>
            もしかしたら、あなたの気づきが、未来の自分や誰かのヒントになるかもしれません。</p>
    </div>

    <div class="section">
    <h2>📝 今日の「困りごと」を書いてみよう</h2>
        <ul>
            <li>最近、どんな“モヤモヤ”や“小さなバグ”を感じましたか？</li>
            <li>それは、どんなとき、なぜ気になりましたか？</li>
            <li>その気持ちや違和感を、これまでどう扱ってきましたか？</li>
        </ul>
        <p>気軽に、思いつくままに。書くこと自体が、未来をつくる一歩です。</p>
        <div class="input-area">
            <input id="journal-title" type="text" placeholder="タイトルを入力してください..." />
            <textarea id="journal-text" rows="10" placeholder="ここにあなたの困りごとを書いてください..."></textarea>
            <button id="submit-journal">ジャーナルを保存</button>
        </div>
    </div>

    <div class="section">
    <h2>📚 保存されたジャーナル一覧</h2>
    <div id="journal-list"></div>
    </div>

    <!-- 今回の新規追加箇所：投稿一覧表示部分に編集用UI追加 -->
    <div class="journal-entry" data-id="<?= $row['id'] ?>">
        <textarea disabled><?= htmlspecialchars($row['content']) ?></textarea>
        <br>
        <button class="edit-btn">編集</button>
        <button class="update-btn" style="display:none;">更新</button>
    </div>

<script>
document.getElementById('submit-journal').addEventListener('click', function () {
    const title = document.getElementById('journal-title').value.trim();
    const text = document.getElementById('journal-text').value.trim();

    if (!title || !text) {
        alert('タイトルと本文を入力してください。');
        return;
    }

        $.ajax({
            url: './save_journal.php',
            type: 'POST',
            data: { title, content: text },
            success: function(res) {
                alert('ジャーナルを保存しました！');
                document.getElementById('journal-title').value = '';
                document.getElementById('journal-text').value = '';
                displaySavedJournals();
            },
            error: function() {
                alert('保存に失敗しました');
            }
        });
    });

    function displaySavedJournals() {
        const listContainer = document.getElementById('journal-list');
        listContainer.innerHTML = '';

        $.getJSON('./get_journals.php', function(data) {
            if (!data.length) {
                listContainer.innerHTML = '<p>保存されたジャーナルはありません。</p>';
                return;
            }
            data.forEach(item => {
                const entry = document.createElement('div');
                entry.style.marginBottom = '2rem';
                entry.innerHTML = `
                    <h3>${item.title} <span style="font-size:0.8em;color:#888;">(${item.created_at})</span></h3>
                    <p>${item.content.replace(/\n/g, "<br>")}</p>
                    <button onclick="deleteJournal(${item.id})">🗑 削除</button>
                    <hr/>
                `;
                listContainer.appendChild(entry);
            });
        });
    }

    function deleteJournal(id) {
        if (confirm('本当に削除しますか？')) {
            $.post('./delete_journal.php', { id }, function() {
                displaySavedJournals();
            });
        }
    }

// 初回読み込み時に表示
window.addEventListener('DOMContentLoaded', displaySavedJournals);

// 編集機能の追加
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const entry = btn.closest('.journal-entry');
        const textarea = entry.querySelector('textarea');
        const updateBtn = entry.querySelector('.update-btn');
        textarea.disabled = false;
        textarea.focus();
        btn.style.display = 'none';
        updateBtn.style.display = 'inline-block';
    });
});

document.querySelectorAll('.update-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const entry = btn.closest('.journal-entry');
        const id = entry.dataset.id;
        const newContent = entry.querySelector('textarea').value;

        fetch('update_journal.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `id=${encodeURIComponent(id)}&content=${encodeURIComponent(newContent)}`
        }).then(res => res.text()).then(data => {
            alert('更新しました！');
            entry.querySelector('textarea').disabled = true;
            btn.style.display = 'none';
            entry.querySelector('.edit-btn').style.display = 'inline-block';
        }).catch(err => alert('更新に失敗しました。'));
    });
});
</script>

</body>
</html>