<?php

namespace DVCampus\Catalog\Controller;

use DVCampus\Framework\Http\ControllerInterface;
use DVCampus\Framework\Http\Response\Raw;

class Product implements ControllerInterface
{
    private \DVCampus\Framework\View\PageResponse $pageResponse;

    /**
     * @param \DVCampus\Framework\View\PageResponse $pageResponse
     */
    public function __construct(
        \DVCampus\Framework\View\PageResponse $pageResponse
    ) {
        $this->pageResponse = $pageResponse;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        return $this->pageResponse->setBody(\DVCampus\Catalog\Block\Product::class);
    }
}