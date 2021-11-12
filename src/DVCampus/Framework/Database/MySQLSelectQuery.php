<?php

declare(strict_types=1);

namespace DVCampus\Framework\Database;

class MySQLSelectQuery
{
    private bool $distinct = false;

    /**
     * @var string[] $fields
     */
    private array $fields = ['*'];

    /**
     * @var string
     */
    private string $from;

    /**
     * @var string[]
     */
    private array $join = [];

    /**
     * @var string[] $where
     */
    private array $where = [];

    /**
     * @var string[]
     */
    private array $order = [];

    /**
     * @var int
     */
    private int $limit = 0;

    /**
     * @return string
     */
    public function __toString(): string
    {
        $sql = 'SELECT ';
        $sql .= $this->distinct ? 'DISTINCT ' : '';
        $sql .= implode(', ', $this->fields) . ' ';
        $sql .= 'FROM ' . $this->from;

        if ($this->join) {
            $sql .= ' ' . implode(' ', $this->join);
        }

        if ($this->where) {
            $sql .= ' WHERE ' .  implode(' AND ', $this->where);
        }

        // Left variable here fpr debug
        $sql .= ($this->order === [] ? '' : ' ORDER BY ' . implode(', ', $this->order));
        $sql .= ($this->limit === 0 ? '' : ' LIMIT ' . $this->limit);

        return $sql;
    }

    /**
     * @param bool $distinct
     * @return $this
     */
    public function distinct(bool $distinct): self
    {
        $this->distinct = $distinct;

        return $this;
    }

    /**
     * @param string $field
     * @param bool $reset
     * @return $this
     */
    public function fields(string $field, bool $reset = false): self
    {
        if ($reset) {
            $this->fields = [];
        }

        $this->fields[] = $field;

        return $this;
    }

    /**
     * @param string $table
     * @param string $alias
     * @return $this
     */
    public function from(string $table, string $alias = ''): self
    {
        $this->from = $alias ? "${table} AS ${alias}" : $table;

        return $this;
    }

    /**
     * @param string $table
     * @param string $alias
     * @param string $condition
     * @return $this
     */
    public function leftJoin(string $table, string $alias, string $condition): self
    {
        return $this->join(sprintf(
            'LEFT JOIN %s%s %s',
            $table,
            $alias ? " AS $alias" : '',
            $condition
        ));
    }

    /**
     * @param string $table
     * @param string $alias
     * @param string $condition
     * @return $this
     */
    public function innerJoin(string $table, string $alias, string $condition): self
    {
        return $this->join(sprintf(
            'INNER JOIN %s%s %s',
            $table,
            $alias ? " AS $alias" : '',
            $condition
        ));
    }

    /**
     * @param string $join
     * @return $this
     */
    private function join(string $join): self
    {
        $this->join[] = $join;

        return $this;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public function where(string $condition): self
    {
        $this->where[] = $condition;

        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param string $order
     * @return $this
     */
    public function orderBy(string $order): self
    {
        $this->order[] = $order;

        return $this;
    }
}
