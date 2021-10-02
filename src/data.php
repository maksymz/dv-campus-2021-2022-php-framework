<?php

declare(strict_types=1);

function catalogGetCategory(): array
{
    return [
        1 => [
            'category_id' => 1,
            'name'        => 'Apple',
            'url'         => 'apple',
            'products'    => [1, 2, 3]
        ],
        2 => [
            'category_id' => 2,
            'name'        => 'Samsung',
            'url'         => 'samsung',
            'products'    => [3, 4, 5]
        ],
        3 => [
            'category_id' => 3,
            'name'        => 'Xiaomi',
            'url'         => 'xiaomi',
            'products'    => [2, 4, 6]
        ]
    ];
}

function catalogGetProduct(): array
{
    return [
        1 => [
            'product_id'  => 1,
            'name'        => 'Product 1',
            'url'         => 'product-1',
            'description' => 'Product 1 Description',
            'price'       => 11.99
        ],
        2 => [
            'product_id'  => 2,
            'name'        => 'Product 2',
            'url'         => 'product-2',
            'description' => 'Product 2 Description',
            'price'       => 22.99
        ],
        3 => [
            'product_id'  => 3,
            'name'        => 'Product 3',
            'url'         => 'product-3',
            'description' => 'Product 3 Description',
            'price'       => 33.99
        ],
        4 => [
            'product_id'  => 4,
            'name'        => 'Product 4',
            'url'         => 'product-4',
            'description' => 'Product 4 Description',
            'price'       => 44.99
        ],
        5 => [
            'product_id'  => 5,
            'name'        => 'Product 5',
            'url'         => 'product-5',
            'description' => 'Product 5 Description',
            'price'       => 55.99
        ],
        6 => [
            'product_id'  => 6,
            'name'        => 'Product 6',
            'url'         => 'product-6',
            'description' => 'Product 6 Description',
            'price'       => 67.00
        ]
    ];
}

function catalogGetCategoryProduct(int $categoryId): array
{
    $categories = catalogGetCategory();

    if (!isset($categories[$categoryId])) {
        throw new InvalidArgumentException("Category with ID $categoryId does not exist");
    }

    $productsForCategory = [];
    $products = catalogGetProduct();

    foreach ($categories[$categoryId]['products'] as $productId) {
        if (!isset($products[$productId])) {
            throw new InvalidArgumentException("Product with ID $productId from category $categoryId does not exist");
        }

        $productsForCategory[] = $products[$productId];
    }

    return $productsForCategory;
}

function catalogGetCategoryByUrl(string $url): ?array
{
    $data = array_filter(
        catalogGetCategory(),
        static function ($category) use ($url) {
            return $category['url'] === $url;
        }
    );

    return array_pop($data);
}

function catalogGetProductByUrl(string $url): ?array
{
    $data = array_filter(
        catalogGetProduct(),
        static function ($product) use ($url) {
            return $product['url'] === $url;
        }
    );

    return array_pop($data);
}
