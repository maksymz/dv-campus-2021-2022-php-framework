<?php

declare(strict_types=1);

namespace DVCampus\Framework\Http;

class RequestDispatcher
{
    /**
     * @var RouterInterface[] $routers
     */
    private array $routers;

    /**
     * @param array $routers
     */
    public function __construct(
        array $routers
    ) {
        foreach ($routers as $router) {
            if (!($router instanceof RouterInterface)) {
                throw new \InvalidArgumentException('Routers must implement ' . RouterInterface::class);
            }
        }

        $this->routers = $routers;
    }

    public function dispatch()
    {
        $requestUri = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routers as $router) {
            if ($controllerClass = $router->match($requestUri)) {
                $controller = new $controllerClass;

                if (!($controller instanceof ControllerInterface)) {
                    throw new \InvalidArgumentException(
                        "Controller $controller must implement " . ControllerInterface::class
                    );
                }

                $html = $controller->execute();
            }
        }

        if (!isset($html)) {
            header("HTTP/1.0 404 Not Found");
            exit(0);
        }

        header('Content-Type: text/html; charset=utf-8');
        echo $html;
    }
}