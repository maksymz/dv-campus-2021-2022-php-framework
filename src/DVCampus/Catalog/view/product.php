<?php
/** @var \DVCampus\Catalog\Block\Product $block */
$product = $block->getProduct();
?>
<div class="product-page">
    <div class="product-media">
        <figure class="product-image">
            <img src="/images/product-placeholder.png" alt="<?= $product->getName() ?>"/>
        </figure>
        <div class="product-description">
            <h1 class="product-title page-title"><?= $product->getName() ?></h1>
            <p class="product-description"><?= $product->getDescription() ?></p>
            <p class="product-price"><span>$<?= $product->getPrice() ?></span></p>
            <button type="button" class="add-to-cart-button button-hover">Add To Cart</button>
        </div>
    </div>

    <section title="Recently Viewed Products">
        <h2>Recently Viewed Products</h2>
        <div class="product-list recently-viewed-slider-wrapper">
            <div class="recently-viewed-slider">
                <div class="product">
                    <a href="/product-1-url" title="Product 1" class="product-item-image">
                        <img src="/images/product-placeholder.png" alt="Product 1"/>
                    </a>
                    <a href="/product-1-url" title="Product 1" class="product-item-title">Product 1</a>
                    <p class="product-item-price">$33.33</p>
                    <button type="button" class="add-to-cart-button button-hover">Add To Cart</button>
                </div>
                <div class="product">
                    <a href="/product-2-url" title="Product 2" class="product-item-image">
                        <img src="/images/product-placeholder.png" alt="Product 2"/>
                    </a>
                    <a href="/product-2-url" title="Product 2" class="product-item-title">Product 2</a>
                    <p class="product-item-price">$66.66</p>
                    <button type="button" class="add-to-cart-button button-hover">Add To Cart</button>
                </div>
                <div class="product">
                    <a href="/product-3-url" title="Product 3" class="product-item-image">
                        <img src="/images/product-placeholder.png" alt="Product 3"/>
                    </a>
                    <a href="/product-3-url" title="Product 3" class="product-item-title">Product 3</a>
                    <p class="product-item-price">$99.99</p>
                    <button type="button" class="add-to-cart-button button-hover">Add To Cart</button>
                </div>
            </div>
            <button class="slider-control-prev slider-control button-hover" type="button">
                <span class="slider-control-prev-icon"><i class="fas fa-chevron-left"></i></span>
                <span class="slider-control-prev-title">Previous</span>
            </button>
            <button class="slider-control-next slider-control button-hover" type="button">
                <span class="slider-control-next-icon"><i class="fas fa-chevron-right"></i></span>
                <span class="slider-control-prev-title">Next</span>
            </button>
        </div>
    </section>
</div>