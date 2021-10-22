<?php

declare(strict_types=1);

namespace DVCampus\ContactUs\Controller;

use DVCampus\Framework\Http\ControllerInterface;
use DVCampus\Framework\Http\Response\Raw;
use DVCampus\Framework\View\Block;

class Form implements ControllerInterface
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
        return $this->pageResponse->setBody(
            Block::class,
            '../src/DVCampus/ContactUs/view/contact-us.php'
        );
    }
}
