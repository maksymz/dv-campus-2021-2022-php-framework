<?php

namespace DVCampus\Catalog\Controller;

use DVCampus\Framework\Http\ControllerInterface;

class Product implements ControllerInterface
{
    private \DVCampus\Framework\Http\Request $request;

    /**
     * @param \DVCampus\Framework\Http\Request $request
     */
    public function __construct(
        \DVCampus\Framework\Http\Request $request
    ) {
        $this->request = $request;
    }

    public function execute(): string
    {
        $product = $this->request->getParameter('product');
        $page = 'product.php';

        ob_start();
        require_once "../src/page.php";
        return ob_get_clean();
    }
}