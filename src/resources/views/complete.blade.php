<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - お問い合わせ完了</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #F5F5F5; display: flex; justify-content: center; align-items: center; min-height: 100vh;}
        .container { background-color: #FFF; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center; width: 100%; max-width: 400px;}
        h1 { color: #333; margin-bottom: 20px; font-size: 24px;}
        p { color: #555; margin-bottom: 30px; font-size: 16px;}
        .home-button { background-color: #8B7355; color: #FFF; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 18px; text-decoration: none; display: inline-block; transition: background-color 0.3s ease;}
        .home-button:hover { background-color: #6C5A42;}
    </style>
</head>
<body>
    <div class="container">
        <h1>お問い合わせありがとうございました</h1>
        <p>今後ともご愛顧いただけますよう、よろしくお願いいたします。</p>
        <a href="{{ url('/') }}" class="home-button">トップページへ</a>
    </div>
</body>
</html>