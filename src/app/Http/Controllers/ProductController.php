<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Season;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 検索クエリ
        $search = $request->input('search');
        $sort = $request->input('sort');

        // クエリビルダ
        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($sort) {
            $query->orderBy('price', $sort);
        }

        // ページネーション（6件ずつ表示）
        $products = $query->paginate(6);

        return view('products.index', compact('products', 'search', 'sort'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(ProductStoreRequest $request)
    {
        // 商品保存
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // 季節のデータを中間テーブルに保存
        $seasons = $request->input('season', []);

        // 画像アップロード処理
        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName(); // 現在時刻 + 元のファイル名
        $filePath = $file->storeAs('fruits-img', $fileName, 'public'); // 指定ディレクトリに保存
        $product->image = $fileName; // データベースに保存
         }

        $product->save(); // ここで保存
        $product->seasons()->attach($seasons); // 中間テーブルへ保存

        return redirect()->route('products.index');
    }

    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        $seasons = Season::all();
        return view('products.edit', compact('product', 'seasons'));
    }

    public function update(ProductUpdateRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // 各フィールドの更新
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // 季節のデータを更新（中間テーブル）
        $seasons = $request->input('season', []);
        $product->seasons()->sync($seasons); // 古いデータを削除し、新しいデータを追加

        // 画像アップロードの処理
        if ($request->hasFile('image')) {
        // 古い画像を削除
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // 新しい画像を保存
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('fruits-img', $fileName, 'public');
        $product->image =  $fileName;
        }

        $product->save();

        return redirect()->route('products.index');
    }

    public function destroy($productId)
    {
    $product = Product::findOrFail($productId);

        // 画像の削除
        if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
        }

        // 中間テーブルのデータも削除
        $product->seasons()->detach();

        // 商品削除
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }

}
