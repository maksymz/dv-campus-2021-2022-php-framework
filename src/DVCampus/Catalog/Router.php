<?php

declare(strict_types=1);

namespace DVCampus\Catalog;

use DVCampus\Catalog\Controller\Category;
use DVCampus\Catalog\Controller\Product;

class Router implements \DVCampus\Framework\Http\RouterInterface
{
    private \DVCampus\Framework\Http\Request $request;

    /**
     * @param \DVCampus\Framework\Http\Request $request
     */
    public function __construct(
        \DVCampus\Framework\Http\Request $request
    ) {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        require_once '../src/data.php';

        if ($data = catalogGetCategoryByUrl($requestUrl)) {
            $this->request->setParameter('category', $data);
            return Category::class;
        }

        if ($data = catalogGetProductByUrl($requestUrl)) {
            $this->request->setParameter('product', $data);
            return Product::class;
        }

        return '';
    }
}
