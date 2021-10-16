<?php

declare(strict_types=1);

namespace DVCampus\Framework\Http;

use DVCampus\Framework\Http\Response\NotFound;

class RequestDispatcher
{
    /**
     * @var RouterInterface[] $routers
     */
    private array $routers;

    private \DVCampus\Framework\Http\Request $request;

    private \DI\FactoryInterface $factory;

    /**
     * @param array $routers
     * @param Request $request
     * @param \DI\FactoryInterface $factory
     */
    public function __construct(
        array $routers,
        \DVCampus\Framework\Http\Request $request,
        \DI\FactoryInterface $factory
    ) {
        foreach ($routers as $router) {
            if (!($router instanceof RouterInterface)) {
                throw new \InvalidArgumentException('Routers must implement ' . RouterInterface::class);
            }
        }

        $this->routers = $routers;
        $this->request = $request;
        $this->factory = $factory;
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function dispatch(): void
    {
        $requestUrl = $this->request->getRequestUrl();

        foreach ($this->routers as $router) {
            if ($controllerClass = $router->match($requestUrl)) {
                $controller = $this->factory->make($controllerClass);

                if (!($controller instanceof ControllerInterface)) {
                    throw new \InvalidArgumentException(
                        "Controller $controller must implement " . ControllerInterface::class
                    );
                }

                $response = $controller->execute();
            }
        }

        if (!isset($response)) {
            $response = $this->factory->make(NotFound::class);
        }

        $response->send();
    }
}