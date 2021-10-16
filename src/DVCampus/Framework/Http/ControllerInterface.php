<?php

declare(strict_types=1);

namespace DVCampus\Framework\Http;

use DVCampus\Framework\Http\Response\Raw;

interface ControllerInterface
{
    public function execute(): Raw;
}
