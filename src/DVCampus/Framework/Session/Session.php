<?php

declare(strict_types=1);

namespace DVCampus\Framework\Session;

class Session
{
    private static bool $isInitialized;

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function setData(string $key, $value): self
    {
        $this->start();
        $_SESSION[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getData(string $key)
    {
        $this->start();

        return $_SESSION[$key] ?? null;
    }

    /**
     * @return void
     */
    private function start(): void
    {
        if (!isset(self::$isInitialized)) {
            session_save_path();
            session_start();
            self::$isInitialized = true;
        }
    }
}
