<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|integer|in:1,2,3',
            'email' => 'required|string|email|max:255',
            'tel1' => 'required|string|digits_between:1,5',
            'tel2' => 'required|string|digits_between:1,5',
            'tel3' => 'required|string|digits_between:1,5',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'detail' => 'required|string|max:2000',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください。',
            'last_name.required' => '名を入力してください。',
            'gender.required' => '性別を選択してください。',
            'gender.in' => '性別は男性、女性、その他から選択してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'tel1.required' => '電話番号を入力してください。',
            'tel2.required' => '電話番号を入力してください。',
            'tel3.required' => '電話番号を入力してください。',
            'tel1.digits_between' => '電話番号は1桁から5桁の数字で入力してください。',
            'tel2.digits_between' => '電話番号は1桁から5桁の数字で入力してください。',
            'tel3.digits_between' => '電話番号は1桁から5桁の数字で入力してください。',
            'address.required' => '住所を入力してください。',
            'category_id.required' => 'お問い合わせの種類を選択してください。',
            'category_id.exists' => '選択されたお問い合わせの種類は無効です。',
            'detail.required' => 'お問い合わせ内容を入力してください。',
            'detail.max' => 'お問い合わせ内容は2000文字以内で入力してください。',
        ];
    }

    /**
     * Prepare the data for validation.
     * 電話番号を結合してバリデーション前に `tel` フィールドを作成
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('tel1') && $this->has('tel2') && $this->has('tel3')) {
            $this->merge([
                'tel' => $this->tel1 . $this->tel2 . $this->tel3,
            ]);
        }
    }

    /**
     * Get custom attributes for validator errors.
     * @return array
     */
    public function attributes()
    {
        return [
            'first_name' => 'お名前(姓)',
            'last_name' => 'お名前(名)',
            'gender' => '性別',
            'email' => 'メールアドレス',
            'tel1' => '電話番号',
            'tel2' => '電話番号',
            'tel3' => '電話番号',
            'address' => '住所',
            'building' => '建物名',
            'category_id' => 'お問い合わせの種類',
            'detail' => 'お問い合わせ内容',
        ];
    }
}