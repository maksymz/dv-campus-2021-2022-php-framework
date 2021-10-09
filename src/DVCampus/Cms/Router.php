<?php

declare(strict_types=1);

namespace DVCampus\Cms;

use DVCampus\Cms\Controller\Page;

class Router implements \DVCampus\Framework\Http\RouterInterface
{
    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if ($requestUrl === '') {
            return Page::class;
        }

        return '';
    }
}
