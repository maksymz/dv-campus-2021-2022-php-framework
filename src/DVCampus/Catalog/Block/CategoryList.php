<?php

declare(strict_types=1);

namespace DVCampus\Catalog\Block;

use DVCampus\Catalog\Model\Category\Entity as CategoryEntity;
use DVCampus\Catalog\Model\Category\Repository as CategoryRepository;
use DVCampus\Catalog\Model\Product\Repository as ProductRepository;

class CategoryList extends \DVCampus\Framework\View\Block
{
    private \DVCampus\Catalog\Model\Category\Repository $categoryRepository;

    protected string $template = '../src/DVCampus/Catalog/view/category_list.php';

    /**
     * @param \DVCampus\Catalog\Model\Category\Repository $categoryRepository
     */
    public function __construct(\DVCampus\Catalog\Model\Category\Repository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return CategoryEntity[]
     */
    public function getCategories(): array
    {
        $select = $this->categoryRepository->select()
            ->distinct(true)
            ->fields(CategoryRepository::TABLE . '.*', true)
            ->innerJoin(ProductRepository::TABLE_CATEGORY_PRODUCT, '', 'USING(`category_id`)');

        return $this->categoryRepository->fetchEntities($select);
    }
}
