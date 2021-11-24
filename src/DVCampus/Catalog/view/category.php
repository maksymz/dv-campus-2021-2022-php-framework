<?php
/** @var \DVCampus\Catalog\Block\Category $block */
?>
<div title="category-wrapper" class="category-page">
    <h1 class="category-page-title"><?= $block->getCategory()->getName() ?></h1>
    <div class="product-list">
        <?php foreach ($block->getCategoryProducts() as $product) : ?>
            <div class="product">
                <a href="/<?= $product->getUrl() ?>" title="<?= $product->getName() ?>" class="product-item-image">
                    <img src="/images/product-placeholder.png" alt="<?= $product->getName() ?>" />
                </a>
                <a href="/<?= $product->getUrl() ?>" title="<?= $product->getName() ?>" class="product-item-title"><?= $product->getName() ?></a>
                <p class="product-item-price">$<?= number_format($product->getPrice(), 2) ?></p>
                <button type="button" class="add-to-cart-button button-hover">Add To Cart</button>
            </div>
       <?php endforeach; ?>
    </div>
</div>