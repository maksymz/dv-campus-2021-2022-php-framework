<?php

namespace DVCampus\Framework\Http;

interface ControllerInterface
{
    public function execute(): string;
}
