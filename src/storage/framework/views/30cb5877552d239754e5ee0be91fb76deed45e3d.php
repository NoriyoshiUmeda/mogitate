<?php $__env->startSection('styles'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/sanitize.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/products.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="page-title">商品一覧</h1>
    <div class="add-product-button">
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-warning">+ 商品を追加</a>
    </div>

    <div class="row">
        <!-- サイドバー (検索フォーム) -->
        <div class="col-md-3">
            <div class="sidebar">
                <form action="<?php echo e(route('products.index')); ?>" method="GET" class="search-bar">
                    <h4>商品検索</h4>
                    <input type="text" name="search" placeholder="商品名で検索" value="<?php echo e($search ?? ''); ?>" class="form-control mb-3">
                    <button type="submit" class="btn btn-warning btn-block">検索</button>
                </form>

                <form action="<?php echo e(route('products.index')); ?>" method="GET" class="sort-dropdown mt-4">
                    <input type="hidden" name="search" value="<?php echo e($search ?? ''); ?>">
                    <h4>価格順で表示</h4>
                    <select name="sort" class="form-control" onchange="this.form.submit()">
                        <option value="" disabled <?php echo e($sort ? '' : 'selected'); ?>>価格で並び替え</option>
                        <option value="asc" <?php echo e($sort == 'asc' ? 'selected' : ''); ?>>価格の安い順</option>
                        <option value="desc" <?php echo e($sort == 'desc' ? 'selected' : ''); ?>>価格の高い順</option>
                    </select>
                </form>

                <!-- 並び替えリセット -->
                <?php if(request('sort')): ?>
                <div class="sort-tag mt-3">
                    <span>
                        <?php if(request('sort') == 'asc'): ?>
                            価格の安い順
                        <?php elseif(request('sort') == 'desc'): ?>
                            価格の高い順
                        <?php endif; ?>
                    </span>
                    <a href="<?php echo e(route('products.index', array_merge(request()->except('sort')))); ?>" class="reset-sort text-danger ms-2">
                        ×
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- 商品一覧 -->
        <div class="col-md-9">
            <div class="product-grid">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card">
                    <a href="<?php echo e(route('products.edit', $product->id)); ?>">
                        <img src="<?php echo e(asset('storage/fruits-img/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="product-image">
                    </a>
                    <div class="product-info">
                        <p class="product-name"><?php echo e($product->name); ?></p>
                        <p class="product-price">¥<?php echo e(number_format($product->price)); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- ページネーション -->
            <div class="pagination mt-4">
                <?php echo e($products->links('pagination::bootstrap-4')); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/index.blade.php ENDPATH**/ ?>