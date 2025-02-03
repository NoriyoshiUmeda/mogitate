@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="container">
    <nav>
        <a href="{{ route('products.index') }}">商品一覧</a> &gt; 商品登録
    </nav>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 左側: 商品画像 -->
        <div class="form-section image-section">
            <label for="image" class="image-label">商品画像</label>
            <input type="file" name="image" id="image" class="form-control-file">
            @error('image') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <!-- 右側: 商品情報 -->
        <div class="form-section">
            <div class="form-group">
                <label for="name">商品名</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="商品名を入力">
                @error('name') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="price">値段</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control" placeholder="値段を入力">
                @error('price') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>季節</label>
                <div class="checkbox-group">
                    @foreach($seasons as $season)
                    <label>
                        <input type="checkbox" name="season[]" value="{{ $season->id }}" 
                            {{ in_array($season->id, old('season', [])) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                    @endforeach
                </div>
                @error('season') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="description">商品説明</label>
                <textarea name="description" id="description" class="form-control" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                @error('description') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="form-group button-group">
                <button type="submit" class="btn btn-warning">登録</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            </div>
        </div>
    </form>
</div>
@endsection
