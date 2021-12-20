<?php

/** @var \DVCampus\Catalog\Block\Product\RecentlyViewed $block */

if (!($products = $block->getProducts())) {
    return;
}
?>
<section title="Recently Viewed Products">
    <div class="recently-viewed-slider-wrapper content-wrapper">
        <h2>Recently Viewed Products</h2>
        <div class="product-list recently-viewed-slider-wrapper campus-slider">
            <?php foreach ($products as $product) : ?>
                <div class="product">
                    <a href="/<?= $product->getUrl() ?>" title="<?= $product->getName() ?>" class="product-item-image">
                        <img src="/images/product-placeholder.png" alt="<?= $product->getName() ?>"/>
                    </a>
                    <a href="/<?= $product->getUrl() ?>"
                       title="<?= $product->getName() ?>"
                       class="product-item-title"
                    ><?= $product->getName() ?></a>
                    <p class="product-item-price"><?= $product->getPrice() ?></p>
                    <button type="button" class="add-to-cart-button button-hover">Add To Cart</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>