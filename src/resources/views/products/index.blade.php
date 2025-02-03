@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="page-title">商品一覧</h1>
    <div class="add-product-button">
        <a href="{{ route('products.create') }}" class="btn btn-warning">+ 商品を追加</a>
    </div>

    <div class="row">
        <!-- サイドバー (検索フォーム) -->
        <div class="col-md-3">
            <div class="sidebar">
                <form action="{{ route('products.index') }}" method="GET" class="search-bar">
                    <h4>商品検索</h4>
                    <input type="text" name="search" placeholder="商品名で検索" value="{{ $search ?? '' }}" class="form-control mb-3">
                    <button type="submit" class="btn btn-warning btn-block">検索</button>
                </form>

                <form action="{{ route('products.index') }}" method="GET" class="sort-dropdown mt-4">
                    <input type="hidden" name="search" value="{{ $search ?? '' }}">
                    <h4>価格順で表示</h4>
                    <select name="sort" class="form-control" onchange="this.form.submit()">
                        <option value="" disabled {{ $sort ? '' : 'selected' }}>価格で並び替え</option>
                        <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>価格の安い順</option>
                        <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>価格の高い順</option>
                    </select>
                </form>

                <!-- 並び替えリセット -->
                @if(request('sort'))
                <div class="sort-tag mt-3">
                    <span>
                        @if(request('sort') == 'asc')
                            価格の安い順
                        @elseif(request('sort') == 'desc')
                            価格の高い順
                        @endif
                    </span>
                    <a href="{{ route('products.index', array_merge(request()->except('sort'))) }}" class="reset-sort text-danger ms-2">
                        ×
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- 商品一覧 -->
        <div class="col-md-9">
            <div class="product-grid">
                @foreach ($products as $product)
                <div class="product-card">
                    <a href="{{ route('products.edit', $product->id) }}">
                        <img src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                    </a>
                    <div class="product-info">
                        <p class="product-name">{{ $product->name }}</p>
                        <p class="product-price">¥{{ number_format($product->price) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- ページネーション -->
            <div class="pagination mt-4">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
