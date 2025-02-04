<?php $__env->startSection('styles'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/sanitize.css')); ?>" >
<link rel="stylesheet" href="<?php echo e(asset('css/edit.css')); ?>"> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <nav>
        <a href="<?php echo e(route('products.index')); ?>">商品一覧</a> &gt; <?php echo e($product->name); ?>

    </nav>

    <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- 左側: 商品画像 -->
        <div>
            <?php if($product->image): ?>
            <img src="<?php echo e(asset('storage/fruits-img/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="img-thumbnail">
            <?php endif; ?>
            <div class="form-group">
                <label for="image">商品画像</label>
                <input type="file" name="image" id="image" class="form-control-file">
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- 右側: 商品情報 -->
        <div>
            <div class="form-group">
                <label for="name">商品名</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name', $product->name)); ?>" class="form-control"  placeholder="商品名を入力">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="price">値段</label>
                <input type="text" name="price" id="price" value="<?php echo e(old('price', $product->price)); ?>" class="form-control" placeholder="値段を入力">
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label>季節</label>
                <div>
                    <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label>
                        <input type="checkbox" name="season[]" value="<?php echo e($season->id); ?>" 
                        <?php echo e(in_array($season->id, $product->seasons->pluck('id')->toArray() ?? []) ? 'checked' : ''); ?>>
                <?php echo e($season->name); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                 <?php $__errorArgs = ['season'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                    <p class="text-danger"><?php echo e($message); ?></p> 
                 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="description">商品説明</label>
                <textarea name="description" id="description" class="form-control" placeholder="商品の説明を入力"><?php echo e(old('description', $product->description)); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

    </form>
            <div class="form-group d-flex justify-content-between align-items-center">
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">戻る</a>
    <div class="button-group">
        <button type="submit" class="btn btn-warning">変更を保存</button>
        <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" class="d-inline-block">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
           <button type="submit" class="btn-danger">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
    削除
        </button>
         </form>
    </div>
</div>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/edit.blade.php ENDPATH**/ ?>