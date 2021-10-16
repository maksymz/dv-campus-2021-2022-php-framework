<?php

declare(strict_types=1);

namespace DVCampus\Catalog\Model\Product;

class Repository
{
    private \DI\FactoryInterface $factory;

    /**
     * @param \DI\FactoryInterface $factory
     */
    public function __construct(\DI\FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return Entity[]
     */
    public function getList(): array
    {
        return [
            1 => $this->makeEntity()->setProductId(1)
                ->setName('Product 1')
                ->setUrl('product-1')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPrice(11.99),
            2 => $this->makeEntity()->setProductId(2)
                ->setName('Product 2')
                ->setUrl('product-2')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPrice(22.99),
            3 => $this->makeEntity()->setProductId(3)
                ->setName('Product 3')
                ->setUrl('product-3')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPrice(33.99),
            4 => $this->makeEntity()->setProductId(4)
                ->setName('Product 4')
                ->setUrl('product-4')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPrice(44.99),
            5 => $this->makeEntity()->setProductId(5)
                ->setName('Product 5')
                ->setUrl('product-5')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPrice(55.99),
            6 => $this->makeEntity()->setProductId(6)
                ->setName('Product 6')
                ->setUrl('product-6')
                ->setDescription('Lorem ipsum dolor sit amet')
                ->setPrice(66.99)
        ];
    }

    /**
     * @param string $url
     * @return ?Entity
     */
    public function getByUrl(string $url): ?Entity
    {
        $data = array_filter(
            $this->getList(),
            static function ($product) use ($url) {
                return $product->getUrl() === $url;
            }
        );

        return array_pop($data);
    }

    /**
     * @param array $productIds
     * @return Entity[]
     */
    public function getByIds(array $productIds)
    {
        return array_intersect_key(
            $this->getList(),
            array_flip($productIds)
        );
    }

    /**
     * @return Entity
     */
    private function makeEntity(): Entity
    {
        return $this->factory->make(Entity::class);
    }
}