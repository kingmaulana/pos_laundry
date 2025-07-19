<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;

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

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $order = Order::create($data);
            $order->user_id = $data['user_id'];
            $order->paket_id = $data['paket_id'];
            $order->status = $data['status'];
            $order->tgl = $data['tgl'];
            $order->berat = $data['berat'];
            $order->total_harga = $data['total_harga'];

            $order->save();
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();

        try {
            $order = Order::find($id);
            $order->user_id = $data['user_id'];
            $order->paket_id = $data['paket_id'];
            $order->status = $data['status'];
            $order->tgl = $data['tgl'];
            $order->berat = $data['berat'];
            $order->total_harga = $data['total_harga'];
            $order->save();

            $order->update($data);
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}