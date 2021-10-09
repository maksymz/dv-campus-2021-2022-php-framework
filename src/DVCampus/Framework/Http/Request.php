<?php

declare(strict_types=1);

namespace DVCampus\Framework\Http;

class Request
{

    private array $parameters = [];

    /**
     * @return string
     */
    public function getRequestUrl(): string
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getParameter(string $key)
    {
        return $this->parameters[$key] ?? null;
    }

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function setParameter(string $key, $value): void
    {
        $this->parameters[$key] = $value;
    }
}