<?php

declare(strict_types=1);

namespace DVCampus\Catalog\Model\Product;

class Repository extends \DVCampus\Framework\Database\AbstractRepository
{
    public const TABLE = 'product';

    public const TABLE_CATEGORY_PRODUCT = 'category_product';

    public const ENTITY = Entity::class;

    /**
     * @param string $url
     * @return Entity|object|null
     */
    public function getByUrl(string $url): ?Entity
    {
        return $this->fetchOne(
            $this->select()->where('url = :url'),
            [
                ':url' => $url
            ]
        );
    }

    /**
     * @param int $categoryId
     * @return Entity[]
     */
    public function getByCategoryId(int $categoryId): array
    {
        $query = $this->select()
            ->innerJoin(self::TABLE_CATEGORY_PRODUCT, '', ' USING(`product_id`)')
            ->where('category_id = :category_id')
            ->limit(100);

        return $this->fetchEntities(
            $query,
            [
                ':category_id' => $categoryId
            ]
        );
    }
}