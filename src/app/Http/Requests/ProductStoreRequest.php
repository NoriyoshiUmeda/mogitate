<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0|max:10000',
        'season' => 'required|array',
        'description' => 'required|string|max:120',
        'image' => 'required|image|mimes:jpeg,png',
    ];
}

public function messages()
{
    return [
        'name.required' => '商品名を入力してください ',
        'price.required' => '値段を入力してください ',
        'price.numeric' => '値段は数値で入力してください ',
        'price.min' => '値段は0円以上で入力してください ',
        'price.max' => '値段は10000円以内で入力してください ',
        'season.required' => '季節を選択してください ',
        'description.required' => '商品説明を入力してください ',
        'description.max' => '商品説明は120文字以内で入力してください ',
        'image.required' => '商品画像を登録してください。',
        'image.required' => '商品画像は画像を登録してください ',
        'image.mimes' => '商品画像は「.png」または「.jpeg」形式でアップロードしてください ',
    ];
}
}
