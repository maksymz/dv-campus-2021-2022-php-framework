<?php
/** @var \DVCampus\Catalog\Block\Category $block */
?>
<div title="category-wrapper">
    <h1><?= $block->getCategory()->getName() ?></h1>
    <div class="product-list">
        <?php foreach ($block->getCategoryProducts() as $product) : ?>
            <div class="product">
                <a href="/<?= $product->getUrl() ?>" title="<?= $product->getName() ?>">
                    <img src="/product-placeholder.png" alt="<?= $product->getName() ?>" width="200"/>
                </a>
                <a href="/<?= $product->getUrl() ?>" title="<?= $product->getName() ?>"><?= $product->getName() ?></a>
                <span>$<?= number_format($product->getPrice(), 2) ?></span>
                <button type="button">Add To Cart</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>