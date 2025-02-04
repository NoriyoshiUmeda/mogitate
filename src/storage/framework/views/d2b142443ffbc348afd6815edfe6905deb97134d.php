<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', '商品一覧'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
   <header class="header">
    <div class="container">
        <a href="<?php echo e(route('products.index')); ?>" class="logo">mogitate</a>
    </div>
   </header>
   <main class="main">
    <?php echo $__env->yieldContent('content'); ?>
   </main>
</body>
</html>


<?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>