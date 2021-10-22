<?php

declare(strict_types=1);

namespace DVCampus\Framework\Database\Adapter;

interface AdapterInterface
{
    public function getConnection();
}
