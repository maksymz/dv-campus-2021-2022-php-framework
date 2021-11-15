<?php

declare(strict_types=1);

namespace DVCampus\Catalog;

use DVCampus\Catalog\Controller\Category;
use DVCampus\Catalog\Controller\Product;

class Router implements \DVCampus\Framework\Http\RouterInterface
{
    private \DVCampus\Framework\Http\Request $request;

    private Model\Category\Repository $categoryRepository;

    private Model\Product\Repository $productRepository;

    /**
     * @param \DVCampus\Framework\Http\Request $request
     * @param Model\Category\Repository $categoryRepository
     * @param Model\Product\Repository $productRepository
     */
    public function __construct(
        \DVCampus\Framework\Http\Request $request,
        \DVCampus\Catalog\Model\Category\Repository $categoryRepository,
        \DVCampus\Catalog\Model\Product\Repository $productRepository
    ) {
        $this->request = $request;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if (!$requestUrl) {
            return '';
        }

        if ($category = $this->categoryRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('category', $category);
            return Category::class;
        }

        if ($product = $this->productRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('product', $product);
            return Product::class;
        }

        return '';
    }
}
