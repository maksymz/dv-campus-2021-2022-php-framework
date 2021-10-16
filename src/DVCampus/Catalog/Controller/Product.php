<?php

namespace DVCampus\Catalog\Controller;

use DVCampus\Framework\Http\ControllerInterface;

class Product implements ControllerInterface
{
    private \DVCampus\Framework\View\Renderer $renderer;

    /**
     * @param \DVCampus\Framework\View\Renderer $renderer
     */
    public function __construct(
        \DVCampus\Framework\View\Renderer $renderer
    ) {
        $this->renderer = $renderer;
    }

    public function execute(): string
    {
        return (string) $this->renderer->setContent(\DVCampus\Catalog\Block\Product::class);
    }
}