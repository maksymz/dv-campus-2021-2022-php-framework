<?php

declare(strict_types=1);

namespace DVCampus\Framework\Http\Response;

class Html extends Raw
{
    /**
     * @inheritDoc
     */
    public function send(): void
    {
        $this->setHeaders('Content-Type: text/html; charset=utf-8');
        parent::send();
    }
}
