<?php
/** @var \DVCampus\Framework\View\Renderer $this */
/** @var \DVCampus\Catalog\Block\Product $block */
$product = $block->getProduct();
?>
<div class="product-page content-wrapper">
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

    <?= $this->render(\DVCampus\Catalog\Block\Product\RecentlyViewed::class) ?>

    <section class="special-products-section">
        <div class="content-wrapper">
            <h2>Special products</h2>
            <div class="special-products-section-items">

                <!-- 1 -->
                <div class="special-products-section-item">
                    <div class="product">
                        <a href="/product-1-url" title="Product 1" class="product-item-image">
                            <img src="/images/product-placeholder.png" alt="Product 1"/>
                        </a>
                        <a href="/product-1-url" title="Product 1" class="product-item-title">Product 1</a>
                    </div>

                    <div class="product-description">
                        <h3>Ipsum dolor sit amet</h3>
                        <p>Nam accumsan nunc sit amet elementum sollicitudin.
                            Integer vel lacus eget tortor lobortis tincidunt sed eu dolor.
                            Phasellus cursus augue ac pulvinar cursus.</p>
                        <p>Quisque ut erat ornare, feugiat turpis a, fringilla felis.
                            Nulla molestie lorem et orci sagittis, et accumsan ex porta.</p>
                        <button class="button-hover" type="submit">Sign up</button>
                    </div>
                </div>

                <!-- 2 -->
                <div class="special-products-section-item">
                    <div class="product">
                        <a href="/product-1-url" title="Product 2" class="product-item-image">
                            <img src="/images/product-placeholder.png" alt="Product 2"/>
                        </a>
                        <a href="/product-1-url" title="Product 1" class="product-item-title">Product 2</a>
                    </div>

                    <div class="product-description">
                        <h3>Ipsum dolor sit amet</h3>
                        <p>Nam accumsan nunc sit amet elementum sollicitudin.
                            Integer vel lacus eget tortor lobortis tincidunt sed eu dolor.
                            Phasellus cursus augue ac pulvinar cursus.</p>
                        <p>Quisque ut erat ornare, feugiat turpis a, fringilla felis.
                            Nulla molestie lorem et orci sagittis, et accumsan ex porta.</p>
                        <button class="button-hover" type="submit">Sign up</button>
                    </div>
                </div>

                <div class="special-products-section-item">
                    <div class="product">
                        <a href="/product-1-url" title="Product 2" class="product-item-image">
                            <img src="/images/product-placeholder.png" alt="Product 2"/>
                        </a>
                        <a href="/product-1-url" title="Product 1" class="product-item-title">Product 2</a>
                    </div>

                    <div class="product-description">
                        <h3>Ipsum dolor sit amet</h3>
                        <p>Nam accumsan nunc sit amet elementum sollicitudin.
                            Integer vel lacus eget tortor lobortis tincidunt sed eu dolor.
                            Phasellus cursus augue ac pulvinar cursus.</p>
                        <p>Quisque ut erat ornare, feugiat turpis a, fringilla felis.
                            Nulla molestie lorem et orci sagittis, et accumsan ex porta.</p>
                        <button class="button-hover" type="submit">Sign up</button>
                    </div>
                </div>

                <div class="special-products-section-item">
                    <div class="product">
                        <a href="/product-1-url" title="Product 2" class="product-item-image">
                            <img src="/images/product-placeholder.png" alt="Product 2"/>
                        </a>
                        <a href="/product-1-url" title="Product 1" class="product-item-title">Product 2</a>
                    </div>

                    <div class="product-description">
                        <h3>Ipsum dolor sit amet</h3>
                        <p>Nam accumsan nunc sit amet elementum sollicitudin.
                            Integer vel lacus eget tortor lobortis tincidunt sed eu dolor.
                            Phasellus cursus augue ac pulvinar cursus.</p>
                        <p>Quisque ut erat ornare, feugiat turpis a, fringilla felis.
                            Nulla molestie lorem et orci sagittis, et accumsan ex porta.</p>
                        <button class="button-hover" type="submit">Sign up</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>