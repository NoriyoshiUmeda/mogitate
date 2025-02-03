@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" >
<link rel="stylesheet" href="{{ asset('css/edit.css') }}"> 

@endsection

@section('content')
<div class="container">
    <nav>
        <a href="{{ route('products.index') }}">商品一覧</a> &gt; {{ $product->name }}
    </nav>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- 左側: 商品画像 -->
        <div>
            @if ($product->image)
            <img src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail">
            @endif
            <div class="form-group">
                <label for="image">商品画像</label>
                <input type="file" name="image" id="image" class="form-control-file">
                @error('image') <p class="text-danger">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- 右側: 商品情報 -->
        <div>
            <div class="form-group">
                <label for="name">商品名</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control"  placeholder="商品名を入力">
                @error('name') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="price">値段</label>
                <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="値段を入力">
                @error('price') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>季節</label>
                <div>
                    @foreach($seasons as $season)
                    <label>
                        <input type="checkbox" name="season[]" value="{{ $season->id }}" 
                        {{ in_array($season->id, $product->seasons->pluck('id')->toArray() ?? []) ? 'checked' : '' }}>
                {{ $season->name }}
                    </label>
                    @endforeach
                </div>
                 @error('season') 
                    <p class="text-danger">{{ $message }}</p> 
                 @enderror
            </div>

            <div class="form-group">
                <label for="description">商品説明</label>
                <textarea name="description" id="description" class="form-control" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @error('description') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

    </form>
            <div class="form-group d-flex justify-content-between align-items-center">
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    <div class="button-group">
        <button type="submit" class="btn btn-warning">変更を保存</button>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
           <button type="submit" class="btn-danger">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
    削除
        </button>
         </form>
    </div>
</div>
