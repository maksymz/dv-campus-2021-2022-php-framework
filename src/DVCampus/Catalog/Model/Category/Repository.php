<?php

declare(strict_types=1);

namespace DVCampus\Catalog\Model\Category;

class Repository extends \DVCampus\Framework\Database\AbstractRepository
{
    public const TABLE = 'category';

    public const ENTITY = Entity::class;

    /**
     * @param string $url
     * @return Entity|object|null
     */
    public function getByUrl(string $url)
    {
        return $this->fetchOne(
            $this->select()->where('url = :url'),
            [
                ':url' => $url
            ]
        );
    }
}
