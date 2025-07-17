<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, UUID;

    protected $fillable = [
        'status',
        'tgl',
        'berat',
        'total_harga'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function pakets()
    {
        return $this->belongsTo(Paket::class);
    }
}
