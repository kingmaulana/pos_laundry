<?php 

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(?string $search, ?int $limit, bool $execute)
    {
        $query = User::where(function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }        
            return $query;
        });
        if($limit) {
            $query->take($limit);
        }

        if($execute) {
            return $query->get();
        }

        return $query;
    }
}