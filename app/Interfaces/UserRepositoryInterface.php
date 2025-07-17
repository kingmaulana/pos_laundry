<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    );
}