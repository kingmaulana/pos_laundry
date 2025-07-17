<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use SoftDeletes, UUID;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'tgl',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
