<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk_model extends Model
{
    use HasFactory;

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $table="produk";
    protected $fillable = [
        'nama_produk', 'satuan', 'id_kategori'
    ];
}