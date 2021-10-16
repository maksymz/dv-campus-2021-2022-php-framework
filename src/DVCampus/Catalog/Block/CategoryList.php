<?php
declare(strict_types=1);

namespace DVCampus\Catalog\Block;

use DVCampus\Catalog\Model\Category\Entity as CategoryEntity;

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
        return $this->categoryRepository->getList();
    }
}
