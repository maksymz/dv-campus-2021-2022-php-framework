<?php

declare(strict_types=1);

namespace DVCampus\Install\Command;

use DVCampus\Catalog\Model\Category\Repository as CategoryRepository;
use DVCampus\Catalog\Model\Product\Repository as ProductRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateData extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'install:generate-data';

    private \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter;

    private OutputInterface $output;

    private const PRODUCTS_COUNT = 250;

    private const ORDERS_COUNT = 1000;

    private const MAX_ITEMS_PER_ORDER = 10;

    /**
     * @param \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter
     * @param string|null $name
     */
    public function __construct(
        \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter,
        string $name = null
    ) {
        parent::__construct($name);
        $this->adapter = $adapter;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Generate demo data for shop testing');

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $output;
        $this->generateData();
        $output->writeln('Completed!');

        return self::SUCCESS;
    }

    /**
     * Generate test data
     *
     * @return void
     */
    private function generateData(): void
    {
        $this->profile([$this, 'truncateTables']);
        $this->profile([$this, 'generateCategories']);
        $this->profile([$this, 'generateProducts']);
        $this->profile([$this, 'generateProductCategories']);
        $this->profile([$this, 'generateOrders']);
        $this->profile([$this, 'generateOrderItems']);
    }

    /**
     * Truncate (empty) tables before inserting new data
     *
     * @return void
     */
    private function truncateTables(): void
    {
        $tables = [
            ProductRepository::TABLE_CATEGORY_PRODUCT,
            'order_item',
            'order',
            CategoryRepository::TABLE,
            ProductRepository::TABLE,
        ];
        $connection = $this->adapter->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');

        foreach ($tables as $table) {
            $connection->query("TRUNCATE TABLE `$table`");
            $this->output->writeln("Truncated table: $table");
        }

        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Insert seven categories. Add data to random 5 of them
     *
     * @return void
     */
    private function generateCategories(): void
    {
        $categories = [
            'Apple', 'Samsung', 'Xiaomi', 'Google', 'LG', 'OnePlus', 'Oppo'
        ];
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO category (`name`, `url`)
                VALUES (:name, :url);
            SQL);

        foreach ($categories as $category) {
            $statement->bindValue(':name', $category);
            $statement->bindValue(':url', strtolower($category));
            $statement->execute();
        }
    }

    /**
     * @return void
     */
    private function generateProducts(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO product (`sku`, `name`, `url`, `description`, `qty`, `price`)
                VALUES (:sku, :name, :url, :description, :qty, :price);
            SQL);

        for ($i = 1; $i <= self::PRODUCTS_COUNT; $i++) {
            $name = "Product $i";
            $url = str_replace(' ', '_', strtolower($name));
            $statement->bindValue(':sku', uniqid('', true));
            $statement->bindValue(':name', $name);
            $statement->bindValue(':url', $url);
            $statement->bindValue(':description', "$name short description text");
            $statement->bindValue(':qty', random_int(0, 10), \PDO::PARAM_INT);
            $statement->bindValue(':price', random_int(10, 100000) / 100, \PDO::PARAM_STR);
            $statement->execute();
        }
    }

    /**
     * @return void
     */
    private function generateProductCategories(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO category_product (`category_id`, `product_id`)
                VALUES (:category_id, :product_id);
            SQL);
        // Get only 5 random categories of total 7
        $categoryIds = array_rand(array_flip(range(1, 7)), 5);

        for ($i = 1; $i <= self::PRODUCTS_COUNT; $i++) {
            if (random_int(1, 3) === 1) {
                continue;
            }

            $productCategories = (array) array_rand(array_flip($categoryIds), random_int(1, 5));

            foreach ($productCategories as $categoryId) {
                $statement->bindValue(':category_id', $categoryId);
                $statement->bindValue(':product_id', $i);
                $statement->execute();
            }
        }
    }

    /**
     * @return void
     */
    private function generateOrders(): void
    {}

    /**
     * @return void
     */
    private function generateOrderItems(): void
    {}

    /**
     * @param callable $callback
     * @return void
     */
    private function profile(callable $callback): void
    {
        $start = microtime(true);
        $callback();
        $totalTime = number_format(microtime(true) - $start, 4);
        $this->output->writeln("Executing <info>$callback[1]</info> took <info>$totalTime</info>");
    }
}