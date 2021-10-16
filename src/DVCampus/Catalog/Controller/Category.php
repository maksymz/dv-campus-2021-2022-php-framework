<?php

namespace DVCampus\Catalog\Controller;

use DVCampus\Framework\Http\ControllerInterface;

class Category implements ControllerInterface
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
        $category = $this->request->getParameter('category');
        $page = 'category.php';

        ob_start();
        require_once "../src/page.php";
        return ob_get_clean();
    }
}