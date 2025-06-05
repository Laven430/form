<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - お問い合わせ内容確認</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #F5F5F5; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh;}
        .container { background-color: #FFF; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 100%; max-width: 600px; margin-top: 50px;}
        h1 { text-align: center; color: #333; margin-bottom: 30px; font-size: 28px;}
        .confirm-group { margin-bottom: 15px; display: flex; align-items: flex-start;}
        .confirm-group label { width: 150px; font-weight: bold; color: #555; padding-top: 5px;}
        .confirm-group .confirm-value { flex-grow: 1; padding: 5px 0; font-size: 16px; word-break: break-all;}
        .button-wrapper { text-align: center; margin-top: 30px;}
        .submit-button { background-color: #8B7355; color: #FFF; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 18px; margin-right: 15px; transition: background-color 0.3s ease;}
        .submit-button:hover { background-color: #6C5A42;}
        .back-button { background: none; border: none; color: #007bff; font-size: 16px; cursor: pointer; text-decoration: underline;}
        .back-button:hover { color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact</h1>
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf

            <div class="confirm-group">
                <label>お名前</label>
                <div class="confirm-value">
                    {{ $input['first_name'] }} {{ $input['last_name'] }}
                </div>
            </div>

            <div class="confirm-group">
                <label>性別</label>
                <div class="confirm-value">
                    {{ $input['gender_string'] }}
                </div>
            </div>

            <div class="confirm-group">
                <label>メールアドレス</label>
                <div class="confirm-value">
                    {{ $input['email'] }}
                </div>
            </div>

            <div class="confirm-group">
                <label>電話番号</label>
                <div class="confirm-value">
                    {{ $input['tel'] }}
                </div>
            </div>

            <div class="confirm-group">
                <label>住所</label>
                <div class="confirm-value">
                    {{ $input['address'] }}
                </div>
            </div>

            <div class="confirm-group">
                <label>建物名</label>
                <div class="confirm-value">
                    {{ $input['building'] ?? 'なし' }}
                </div>
            </div>

            <div class="confirm-group">
                <label>お問い合わせの種類</label>
                <div class="confirm-value">
                    {{ $input['category_name'] }}
                </div>
            </div>

            <div class="confirm-group">
                <label>お問い合わせ内容</label>
                <div class="confirm-value">
                    {{ $input['detail'] }}
                </div>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="submit-button">送信</button>
                <button type="button" class="back-button" onclick="history.back()">修正する</button>
            </div>
        </form>
    </div>
</body>
</html>