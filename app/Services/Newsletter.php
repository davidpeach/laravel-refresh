<?php

declare(strict_types=1);

namespace App\Services;

interface Newsletter
{
    public function subscribe(string $email);
}

