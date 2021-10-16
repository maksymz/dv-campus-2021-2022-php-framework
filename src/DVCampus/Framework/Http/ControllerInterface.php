<?php

declare(strict_types=1);

namespace DVCampus\Framework\Http;

interface ControllerInterface
{
    public function execute(): string;
}
