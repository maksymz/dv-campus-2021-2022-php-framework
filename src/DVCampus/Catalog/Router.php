<?php

declare(strict_types=1);

namespace DVCampus\Catalog;

use DVCampus\Catalog\Controller\Category;
use DVCampus\Catalog\Controller\Product;

class Router implements \DVCampus\Framework\Http\RouterInterface
{
    private \DVCampus\Framework\Http\Request $request;

    private Model\Category\Repository $categoryRepository;

    /**
     * @param \DVCampus\Framework\Http\Request $request
     * @param Model\Category\Repository $categoryRepository
     */
    public function __construct(
        \DVCampus\Framework\Http\Request $request,
        \DVCampus\Catalog\Model\Category\Repository $categoryRepository
    ) {
        $this->request = $request;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        require_once '../src/data.php';

        if ($category = $this->categoryRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('category', $category);
            return Category::class;
        }

        if ($data = catalogGetProductByUrl($requestUrl)) {
            $this->request->setParameter('product', $data);
            return Product::class;
        }

        return '';
    }
}
