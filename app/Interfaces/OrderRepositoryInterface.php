<?php 

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    );
}