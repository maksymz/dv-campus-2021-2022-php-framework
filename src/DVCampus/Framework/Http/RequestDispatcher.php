<?php

declare(strict_types=1);

namespace DVCampus\Framework\Http;

class RequestDispatcher
{
    /**
     * @var RouterInterface[] $routers
     */
    private array $routers;

    private \DVCampus\Framework\Http\Request $request;

    private \DI\Container $container;

    /**
     * @param array $routers
     * @param Request $request
     * @param \DI\Container $container
     */
    public function __construct(
        array $routers,
        \DVCampus\Framework\Http\Request $request,
        \DI\Container $container
    ) {
        foreach ($routers as $router) {
            if (!($router instanceof RouterInterface)) {
                throw new \InvalidArgumentException('Routers must implement ' . RouterInterface::class);
            }
        }

        $this->routers = $routers;
        $this->request = $request;
        $this->container = $container;
    }

    public function dispatch()
    {
        $requestUrl = $this->request->getRequestUrl();

        foreach ($this->routers as $router) {
            if ($controllerClass = $router->match($requestUrl)) {
                $controller = $this->container->get($controllerClass);

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