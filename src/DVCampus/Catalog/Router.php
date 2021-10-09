<?php

declare(strict_types=1);

namespace DVCampus\Catalog;

use DVCampus\Catalog\Controller\Category;
use DVCampus\Catalog\Controller\Product;

class Router implements \DVCampus\Framework\Http\RouterInterface
{
    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
//        require_once '../src/data.php';
//
//        if ($data = catalogGetCategoryByUrl($requestUrl)) {
//            return Category::class;
//        }
//
//        if ($data = catalogGetProductByUrl($requestUrl)) {
//            return Product::class;
//        }

        return '';
    }
}
