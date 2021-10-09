<?php

declare(strict_types=1);

namespace DVCampus\ContactUs;

use DVCampus\ContactUs\Controller\Form;

class Router implements \DVCampus\Framework\Http\RouterInterface
{
    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if ($requestUrl === 'contact-us') {
            return Form::class;
        }

        return '';
    }
}
