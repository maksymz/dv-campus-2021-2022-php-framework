<?php

declare(strict_types=1);

namespace DVCampus\Framework\Database\Adapter;

class MySQL implements AdapterInterface
{
    private array $connectionParams;

    public const DB_NAME = 'database';
    public const DB_USER = 'user';
    public const DB_PASSWORD = 'password';
    public const DB_HOST = 'host';
    public const DB_PORT = 'port';

    private static \PDO $connection;

    /**
     * @param array $connectionParams
     */
    public function __construct(
        array $connectionParams
    ) {
        $this->connectionParams = $connectionParams;
    }

    /**
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        if (!isset(self::$connection)) {
            self::$connection = new \PDO(
                sprintf(
                    "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4;",
                    $this->connectionParams[self::DB_HOST],
                    $this->connectionParams[self::DB_PORT],
                    $this->connectionParams[self::DB_NAME]
                ),
                $this->connectionParams[self::DB_USER],
                $this->connectionParams[self::DB_PASSWORD],
                [
                    \PDO::ERRMODE_EXCEPTION
                ]
            );
        }

        return self::$connection;
    }
}
