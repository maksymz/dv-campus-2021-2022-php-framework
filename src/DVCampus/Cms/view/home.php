<?php
/** @var \DVCampus\Framework\View\Renderer $this */
?>
<section class="welcome-section">
    <div class="content-wrapper">
        <div class="content">
            <div class="welcome-section-title">
                <h1>Lorem ipsum dolor sit amet</h1>
                <h2>consectetur adipisicing elit.</h2>
            </div>
            <div class="welcome-section-items">

                <!-- 1 -->
                <div class="welcome-section-item">
                    <div class="welcome-section-item-image"></div>
                    <h3>Lorem ipsum dolor</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolore illo nisi optio
                        repudiandae? Architecto cumque exercitationem, facilis minima nesciunt nisi recusandae tempora
                        voluptas.</p>
                </div>

                <!-- 2 -->
                <div class="welcome-section-item">
                    <div class="welcome-section-item-image"></div>
                    <h3>Lorem ipsum dolor</h3>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non, tempora voluptate? A dolor earum
                        eveniet excepturi fugit incidunt laudantium magni maiores, veniam?</p>
                </div>

                <!-- 3 -->
                <div class="welcome-section-item">
                    <div class="welcome-section-item-image"></div>
                    <h3>Lorem ipsum dolor</h3>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, consequatur cum debitis
                        distinctio dolorem eius est hic ipsum molestiae natus omnis porro sit.</p>
                </div>
            </div>
            <a href="javascript: void(0)" class="read-more-btn button-hover">
                Read More
            </a>
        </div>
    </div>
</section>
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