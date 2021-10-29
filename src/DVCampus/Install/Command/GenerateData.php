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
        $this->truncateTables();
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

        foreach ($tables as $table) {
            $connection->query("TRUNCATE TABLE $table");
            $this->output->writeln("Truncated table: $table");
        }
    }
}