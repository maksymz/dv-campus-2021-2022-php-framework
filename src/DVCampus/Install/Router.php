<?php

declare(strict_types=1);

namespace DVCampus\Install;

use DVCampus\Install\Controller\Index;

class Router implements \DVCampus\Framework\Http\RouterInterface
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

    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if ($this->request->getRequestUrl() === 'install') {
            return Index::class;
        }

        return '';
    }
}
