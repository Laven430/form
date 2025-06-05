<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - お問い合わせ</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #F5F5F5; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh;}
        .container { background-color: #FFF; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 100%; max-width: 600px; margin-top: 50px;}
        h1 { text-align: center; color: #333; margin-bottom: 30px; font-size: 28px;}
        .form-group { margin-bottom: 20px; display: flex; align-items: flex-start; }
        .form-group label { width: 150px; font-weight: bold; color: #555; padding-top: 8px;}
        .form-group .form-control { flex-grow: 1; }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select,
        .form-group textarea { width: 100%; padding: 10px; border: 1px solid #CCC; border-radius: 4px; font-size: 16px;}
        .form-group input[type="radio"] { margin-right: 5px;}
        .form-group input[type="radio"] + label { margin-right: 20px;}
        .form-group .tel-inputs { display: flex; gap: 10px;}
        .form-group .tel-inputs input { flex: 1;}
        .form-group .tel-inputs span { align-self: center; font-size: 18px; color: #777;}
        .required-mark { color: #E74C3C; margin-left: 5px; font-size: 14px;}
        .example-text { color: #A0A0A0; font-size: 13px; margin-top: 5px;}
        .error-message { color: #E74C3C; font-size: 13px; margin-top: 5px;}
        .button-wrapper { text-align: center; margin-top: 30px;}
        .submit-button { background-color: #8B7355; color: #FFF; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 18px; transition: background-color 0.3s ease;}
        .submit-button:hover { background-color: #6C5A42;}
        .name-inputs { display: flex; gap: 10px; }
        .name-inputs > div { flex: 1; }
        .name-inputs input { width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact</h1>

        <form action="{{ route('contact.confirm') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">お名前<span class="required-mark">※</span></label>
                <div class="form-control">
                    <div class="name-inputs">
                        <div>
                            <input type="text" name="first_name" placeholder="例: 山田" value="{{ old('first_name', $input['first_name'] ?? '') }}">
                        </div>
                        <div>
                            <input type="text" name="last_name" placeholder="例: 太郎" value="{{ old('last_name', $input['last_name'] ?? '') }}">
                        </div>
                    </div>
                    @error('first_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('last_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>性別<span class="required-mark">※</span></label>
                <div class="form-control">
                    <input type="radio" id="gender_male" name="gender" value="1" {{ old('gender', $input['gender'] ?? '1') == '1' ? 'checked' : '' }}>
                    <label for="gender_male">男性</label>
                    <input type="radio" id="gender_female" name="gender" value="2" {{ old('gender', $input['gender'] ?? '') == '2' ? 'checked' : '' }}>
                    <label for="gender_female">女性</label>
                    <input type="radio" id="gender_other" name="gender" value="3" {{ old('gender', $input['gender'] ?? '') == '3' ? 'checked' : '' }}>
                    <label for="gender_other">その他</label>
                    @error('gender')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">メールアドレス<span class="required-mark">※</span></label>
                <div class="form-control">
                    <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email', $input['email'] ?? '') }}">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="tel">電話番号<span class="required-mark">※</span></label>
                <div class="form-control">
                    <div class="tel-inputs">
                        <input type="text" name="tel1" placeholder="080" value="{{ old('tel1', $input['tel1'] ?? '') }}">
                        <span>-</span>
                        <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2', $input['tel2'] ?? '') }}">
                        <span>-</span>
                        <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3', $input['tel3'] ?? '') }}">
                    </div>
                    @error('tel1')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('tel2')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('tel3')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="address">住所<span class="required-mark">※</span></label>
                <div class="form-control">
                    <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $input['address'] ?? '') }}">
                    @error('address')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="building">建物名</label>
                <div class="form-control">
                    <input type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building', $input['building'] ?? '') }}">
                    @error('building')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="category_id">お問い合わせの種類<span class="required-mark">※</span></label>
                <div class="form-control">
                    <select id="category_id" name="category_id">
                        <option value="">選択してください</option>
                        @if(isset($categories) && (is_array($categories) || $categories instanceof \Illuminate\Support\Collection))
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        @else
                        {{-- categories がない、または不正な場合のフォールバック --}}
                        <option value="">カテゴリが読み込めませんでした</option>
                        @endif
                    </select>
                    @error('category_id')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="detail">お問い合わせ内容<span class="required-mark">※</span></label>
                <div class="form-control">
                    <textarea id="detail" name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $input['detail'] ?? '') }}</textarea>
                    @error('detail')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="submit-button">確認画面</button>
            </div>
        </form>
    </div>
</body>
</html>