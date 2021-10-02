<section title="Products">
    <h1><?= $data['name'] ?></h1>
    <div class="product-list">
        <?php foreach (catalogGetCategoryProduct($data['category_id']) as $product) : ?>
            <div class="product">
                <a href="/<?= $product['url'] ?>" title="<?= $product['name'] ?>">
                    <img src="/product-placeholder.png" alt="<?= $product['name'] ?>" width="200"/>
                </a>
                <a href="/<?= $product['url'] ?>" title="<?= $product['name'] ?>"><?= $product['name'] ?></a>
                <span>$<?= number_format($product['price'], 2) ?></span>
                <button type="button">Add To Cart</button>
            </div>
        <?php endforeach; ?>
    </div>
</section>