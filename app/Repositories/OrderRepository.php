<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll(?string $search, ?int $limit, bool $execute)
    {
        $query = Order::where(function ($query) use ($search) {
            if($search) {
                $query->search($search);
            }
        });

        if($limit) {
            $query->limit($limit);
        }

        if($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getById(string $id)
    {
        $query = Order::where('id', $id);
        return $query->first();
    }
}