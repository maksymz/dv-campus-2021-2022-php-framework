<?php

declare(strict_types=1);

namespace DVCampus\Framework\Database;

class AbstractRepository
{
    public const TABLE = '';

    public const ENTITY = '';

    private \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter;

    private \DI\FactoryInterface $factory;

    private static array $tableInfo = [];

    /**
     * @param \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter
     * @param \DI\FactoryInterface $factory
     */
    public function __construct(
        \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter,
        \DI\FactoryInterface $factory
    ) {
        $this->factory = $factory;
        $this->adapter = $adapter;
    }

    /**
     * Get clean select for further modification
     *
     * @return MySQLSelectQuery
     */
    public function select(): MySQLSelectQuery
    {
        return $this->factory->make(MySQLSelectQuery::class)
            ->from(static::TABLE);
    }

    /**
     * FEtch entities with ability to filter data with WHERE clause
     *
     * @param MySQLSelectQuery|null $query
     * @param array $bind
     * @return array
     */
    public function fetchEntities(MySQLSelectQuery $query = null, array $bind = []): array
    {
        if (!$query) {
            $query = $this->select();
        }

        $statement = $this->adapter->getConnection()->prepare((string) $query);
        $statement->execute($bind);
        $this->describeTable();
        $result = [];

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $this->hydrate($row);
        }

        return $result;
    }

    /**
     * @param MySQLSelectQuery|null $query
     * @param array $where
     * @return object|null
     */
    public function fetchOne(MySQLSelectQuery $query = null, array $where = []): ?object
    {
        if (!$query) {
            $query = $this->select();
        }

        $query->limit(1);
        $result = $this->fetchEntities($query, $where);

        return $result ? $result[0] : null;
    }

    /**
     * @return void
     */
    private function describeTable(): void
    {
        if (isset($this->tableInfo[static::TABLE])) {
            return;
        }

        $statement = $this->adapter->getConnection()->prepare('DESCRIBE ' . static::TABLE);
        $statement->execute();
        self::$tableInfo[static::TABLE] = [];

        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $columnMetadata) {
            preg_match('/[a-z]+/', $columnMetadata['Type'], $matches);

            switch ($matches[0]) {
                case 'int':
                case 'smallint':
                case 'timestamp':
                    $typecast = \Closure::fromCallable('intval');
                    break;
                case 'decimal':
                    $typecast = \Closure::fromCallable('floatval');
                    break;
                case 'char':
                case 'varchar':
                    $typecast = \Closure::fromCallable('strval');
                    break;
                default:
                    throw new \RuntimeException('Unknown DB data type: ' . $matches[0]);
            }

            self::$tableInfo[static::TABLE][$columnMetadata['Field']] = [
                'setter' => 'set' . str_replace('_', '', ucwords($columnMetadata['Field'], '_')),
                'typecast' => $typecast
            ];
        }
    }

    /**
     * @param array $row
     * @return object
     */
    private function hydrate(array $row): object
    {
        $entity = $this->makeEntity();

        foreach ($row as $columnName => $value) {
            if (isset(self::$tableInfo[static::TABLE][$columnName]['setter'])) {
                $entity->{self::$tableInfo[static::TABLE][$columnName]['setter']}(
                    self::$tableInfo[static::TABLE][$columnName]['typecast']($value)
                );
            }
        }

        return $entity;
    }

    /**
     * @return object
     */
    private function makeEntity(): object
    {
        return $this->factory->make(static::ENTITY);
    }
}
