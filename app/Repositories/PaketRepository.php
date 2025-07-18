<?php

namespace App\Repositories;

use App\Interfaces\PaketRepositoryInterface;
use App\Models\Paket;
use Illuminate\Support\Facades\DB;

class PaketRepository implements PaketRepositoryInterface
{
    public function getAll(?string $search, ?int $limit, bool $execute) 
    {
        $query = Paket::where(function ($query) use ($search) {
            if($search) {
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');

        if($limit) {
            $query->take($limit);
        }

        if($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getById(string $id)
    {
        $query = Paket::where('id', $id);
        return $query->first();
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $paket = new Paket;
            $paket->nama = $data['nama'];
            $paket->deskripsi = $data['deskripsi'];
            $paket->harga = $data['harga'];
            $paket->tgl = $data['tgl'];
            $paket->save();
            DB::commit();
            return $paket;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();

        try {
            $paket = Paket::find($id);
            $paket->nama = $data['nama'];
            $paket->deskripsi = $data['deskripsi'];
            $paket->harga = $data['harga'];
            $paket->tgl = $data['tgl'];
            $paket->save();
            DB::commit();
            return $paket;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}