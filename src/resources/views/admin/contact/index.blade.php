<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <style>
        /* ここに直接スタイルを記述するか、app.cssにまとめる */
        body { font-family: sans-serif; margin: 20px; background-color: #f8f8f8; color: #333;}
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;}
        .admin-header h1 { font-size: 24px; color: #555;}
        .search-form { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05);}
        .search-form div { flex-grow: 1; min-width: 150px; }
        .search-form input, .search-form select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;}
        .search-buttons { display: flex; gap: 10px; margin-top: 10px; }
        .search-buttons button { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; transition: background-color 0.3s ease;}
        .search-buttons button.search { background-color: #007bff; color: white; }
        .search-buttons button.search:hover { background-color: #0056b3; }
        .search-buttons button.reset { background-color: #6c757d; color: white; }
        .search-buttons button.reset:hover { background-color: #5a6268; }
        .export-button { padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; margin-bottom: 20px; font-size: 14px; transition: background-color 0.3s ease;}
        .export-button:hover { background-color: #218838; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05);}
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; font-size: 14px;}
        th { background-color: #f2f2f2; font-weight: bold; color: #555;}
        tr:nth-child(even) { background-color: #f9f9f9; }
        .pagination { display: flex; justify-content: center; align-items: center; gap: 5px; margin-top: 20px; }
        .pagination a, .pagination span { padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #007bff; background-color: white; transition: background-color 0.3s ease;}
        .pagination a:hover { background-color: #e9ecef; }
        .pagination span.current { background-color: #007bff; color: white; border-color: #007bff; }
        .pagination span.disabled { color: #ccc; cursor: not-allowed; }

        /* モーダルウィンドウのスタイル */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 30px;
            border: 1px solid #888;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            animation-name: animatetop;
            animation-duration: 0.4s;
            position: relative;
            border-radius: 10px;
        }
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }
        .close-button {
            color: #aaa;
            float: right;
            font-size: 32px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
        }
        .close-button:hover,
        .close-button:focus {
            color: #555;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-details p { margin-bottom: 12px; font-size: 16px;}
        .modal-details strong { display: inline-block; width: 120px; color: #666;}
        .delete-button { background-color: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; display: block; width: fit-content; margin-left: auto; margin-right: auto; transition: background-color 0.3s ease;}
        .delete-button:hover { background-color: #c82333; }
        .detail-button { padding: 8px 12px; background-color: #17a2b8; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; transition: background-color 0.3s ease;}
        .detail-button:hover { background-color: #138496; }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1>FashionablyLate - Admin</h1>
        <div class="logout">
            <a href="#" style="text-decoration: none; color: #007bff;">logout</a> </div>
    </header>

    <main>
        <h2>Admin</h2>

        <form id="search_form" method="GET" action="{{ route('admin.contacts.index') }}">
            <div class="search-form">
                <div>
                    <input type="text" name="name_or_email" placeholder="名前またはメールアドレスを入力してください" value="{{ $searchParams['name_or_email'] ?? '' }}">
                </div>
                <div>
                    <select name="gender">
                        <option value="" {{ ($searchParams['gender'] ?? '') === '' ? 'selected' : '' }}>性別</option>
                        <option value="all" {{ ($searchParams['gender'] ?? '') === 'all' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ ($searchParams['gender'] ?? '') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ ($searchParams['gender'] ?? '') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ ($searchParams['gender'] ?? '') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div>
                    <select name="category_id">
                        <option value="" {{ ($searchParams['category_id'] ?? '') === '' ? 'selected' : '' }}>お問い合わせの種類</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($searchParams['category_id'] ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="date" name="date" value="{{ $searchParams['date'] ?? '' }}">
                </div>
                <div class="search-buttons">
                    <button type="submit" class="search">検索</button>
                    <button type="button" id="reset_button" class="reset">リセット</button>
                </div>
            </div>
        </form>

        <button id="export_button" class="export-button">エクスポート</button>

        <table>
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th> </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->full_name }}</td>
                        <td>{{ $contact->gender_string }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->name }}</td>
                        <td><button class="detail-button" data-id="{{ $contact->id }}">詳細</button></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">該当するお問い合わせがありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $contacts->appends($searchParams)->links('vendor.pagination.default') }}
        </div>
        </main>

    <div id="detail_modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h3>お問い合わせ詳細</h3>
            <div class="modal-details">
                <p><strong>お名前:</strong> <span id="modal_name"></span></p>
                <p><strong>性別:</strong> <span id="modal_gender"></span></p>
                <p><strong>メールアドレス:</strong> <span id="modal_email"></span></p>
                <p><strong>電話番号:</strong> <span id="modal_tel"></span></p>
                <p><strong>住所:</strong> <span id="modal_address"></span></p>
                <p><strong>建物名:</strong> <span id="modal_building"></span></p>
                <p><strong>お問い合わせの種類:</strong> <span id="modal_type"></span></p>
                <p><strong>お問い合わせ内容:</strong> <span id="modal_content"></span></p>
            </div>
            <button id="delete_button" class="delete-button">削除</button>
        </div>
    </div>

    <script>
        // CSRFトークンをグローバルに設定 (Ajaxリクエスト用)
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const searchForm = document.getElementById('search_form');
        const resetButton = document.getElementById('reset_button');
        const exportButton = document.getElementById('export_button');

        const detailModal = document.getElementById('detail_modal');
        const closeModalButton = document.querySelector('.close-button');
        const modalName = document.getElementById('modal_name');
        const modalGender = document.getElementById('modal_gender');
        const modalEmail = document.getElementById('modal_email');
        const modalTel = document.getElementById('modal_tel');
        const modalAddress = document.getElementById('modal_address');
        const modalBuilding = document.getElementById('modal_building');
        const modalType = document.getElementById('modal_type');
        const modalContent = document.getElementById('modal_content');
        const deleteButton = document.getElementById('delete_button');

        // リセットボタンのイベントリスナー
        resetButton.addEventListener('click', () => {
            searchForm.querySelectorAll('input, select').forEach(element => {
                if (element.type === 'text' || element.type === 'date') {
                    element.value = '';
                } else if (element.tagName === 'SELECT') {
                    element.value = ''; // デフォルトの「性別」「お問い合わせの種類」のvalue="" に対応
                }
            });
            searchForm.submit(); // リセット後にフォームを送信
        });

        // エクスポートボタンのイベントリスナー
        exportButton.addEventListener('click', () => {
            const currentUrl = new URL(window.location.href);
            const exportUrl = new URL("{{ route('admin.contacts.exportCsv') }}");

            // 現在の検索クエリパラメータをエクスポートURLにコピー
            currentUrl.searchParams.forEach((value, key) => {
                // ページネーション関連のパラメータは除外
                if (key !== 'page') {
                    exportUrl.searchParams.append(key, value);
                }
            });
            window.location.href = exportUrl.toString();
        });

        // 詳細ボタンのクリックイベント委譲
        document.body.addEventListener('click', async (event) => {
            if (event.target.classList.contains('detail-button')) {
                const recordId = event.target.dataset.id;
                try {
                    const response = await fetch(`/admin/contacts/${recordId}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const detail = await response.json();

                    if (detail) {
                        modalName.textContent = detail.full_name; // Contactモデルのアクセサ
                        modalGender.textContent = detail.gender_string; // Contactモデルのアクセサ
                        modalEmail.textContent = detail.email;
                        modalTel.textContent = detail.tel;
                        modalAddress.textContent = detail.address;
                        modalBuilding.textContent = detail.building || 'なし';
                        modalType.textContent = detail.category.name; // categoryリレーションから名前を取得
                        modalContent.textContent = detail.detail;
                        deleteButton.dataset.id = detail.id; // 削除ボタンにIDを設定
                        detailModal.style.display = 'flex'; // モーダル表示
                    } else {
                        alert('詳細データの取得に失敗しました。');
                    }
                } catch (error) {
                    console.error('詳細データの取得に失敗しました:', error);
                    alert('詳細データの取得に失敗しました。ネットワークエラーまたはサーバーの問題。');
                }
            }
        });

        // モーダル閉じるボタン
        closeModalButton.addEventListener('click', () => {
            detailModal.style.display = 'none';
        });

        // モーダル外クリックで閉じる
        window.addEventListener('click', (event) => {
            if (event.target === detailModal) {
                detailModal.style.display = 'none';
            }
        });

        // 削除ボタンのクリックイベント
        deleteButton.addEventListener('click', async () => {
            const recordId = deleteButton.dataset.id;
            if (confirm('このデータを本当に削除しますか？')) {
                try {
                    const response = await fetch(`/admin/contacts/${recordId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN // CSRFトークンを送信
                        },
                    });
                    const result = await response.json();

                    if (result.success) {
                        alert('データを削除しました。');
                        detailModal.style.display = 'none'; // モーダルを閉じる
                        // ページをリロードして、テーブルを更新
                        window.location.reload();
                    } else {
                        alert('データの削除に失敗しました: ' + (result.message || '不明なエラー'));
                    }
                } catch (error) {
                    console.error('データの削除中にエラーが発生しました:', error);
                    alert('データの削除中にエラーが発生しました。ネットワークエラーまたはサーバーの問題。');
                }
            }
        });
    </script>
</body>
</html>