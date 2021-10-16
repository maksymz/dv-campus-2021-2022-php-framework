<?php

declare(strict_types=1);

namespace DVCampus\Cms\Controller;

use DVCampus\Framework\Http\Response\Raw;
use DVCampus\Framework\View\Block;

class Page implements \DVCampus\Framework\Http\ControllerInterface
{
    private \DVCampus\Framework\Http\Request $request;

    private \DVCampus\Framework\View\PageResponse $pageResponse;

    /**
     * @param \DVCampus\Framework\Http\Request $request
     * @param \DVCampus\Framework\View\PageResponse $pageResponse
     */
    public function __construct(
        \DVCampus\Framework\Http\Request $request,
        \DVCampus\Framework\View\PageResponse $pageResponse
    ) {
        $this->pageResponse = $pageResponse;
        $this->request = $request;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        return $this->pageResponse->setBody(
            Block::class,
            '../src/DVCampus/Cms/view/' . $this->request->getParameter('page') . '.php'
        );
    }
}
