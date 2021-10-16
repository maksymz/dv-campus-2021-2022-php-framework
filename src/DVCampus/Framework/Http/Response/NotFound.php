<?php

declare(strict_types=1);

namespace DVCampus\Framework\Http\Response;

class NotFound extends Raw
{
    /**
     * @inheritDoc
     */
    public function send(): void
    {
        $this->setHeaders('HTTP/1.0 404 Not Found');
        parent::send();
    }
}
