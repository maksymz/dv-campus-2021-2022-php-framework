<?php
declare(strict_types=1);

namespace DVCampus\Catalog\Block;

use DVCampus\Catalog\Model\Category\Entity as CategoryEntity;
use DVCampus\Catalog\Model\Product\Entity as ProductEntity;

class Category extends \DVCampus\Framework\View\Block
{
    private \DVCampus\Framework\Http\Request $request;

    private \DVCampus\Catalog\Model\Product\Repository $productRepository;

    protected string $template = '../src/DVCampus/Catalog/view/category.php';

    /**
     * @param \DVCampus\Framework\Http\Request $request
     * @param \DVCampus\Catalog\Model\Product\Repository $productRepository
     */
    public function __construct(
        \DVCampus\Framework\Http\Request $request,
        \DVCampus\Catalog\Model\Product\Repository $productRepository
    ) {
        $this->request = $request;
        $this->productRepository = $productRepository;
    }

    /**
     * @return CategoryEntity
     */
    public function getCategory(): CategoryEntity
    {
        return $this->request->getParameter('category');
    }

    /**
     * @return ProductEntity[]
     */
    public function getCategoryProducts(): array
    {
        return $this->productRepository->getByIds(
            $this->getCategory()->getProductIds()
        );
    }
}
