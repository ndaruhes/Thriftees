<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $fillable = [
        'id_barang',
        'id_owner',
        'id_pemesan',
        'jumlah_pesanan',
        'alamat',
        'kode_pos',
        'total_harga',
        'nomor_invoice',
        'status',
    ];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'id_barang', 'id');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'id_owner', 'id');
    }

    public function pemesan()
    {
        return $this->belongsTo('App\Models\User', 'id_pemesan', 'id');
    }
}
