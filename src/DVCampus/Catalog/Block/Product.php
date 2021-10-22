<?php

declare(strict_types=1);

namespace DVCampus\Catalog\Block;

use DVCampus\Catalog\Model\Product\Entity as ProductEntity;

class Product extends \DVCampus\Framework\View\Block
{
    private \DVCampus\Framework\Http\Request $request;

    protected string $template = '../src/DVCampus/Catalog/view/product.php';

    /**
     * @param \DVCampus\Framework\Http\Request $request
     */
    public function __construct(
        \DVCampus\Framework\Http\Request $request
    ) {
        $this->request = $request;
    }

    /**
     * @return ProductEntity
     */
    public function getProduct(): ProductEntity
    {
        return $this->request->getParameter('product');
    }
}
