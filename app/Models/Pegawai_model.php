<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai_model extends Model
{
    use HasFactory;
    protected $table ="pegawai";
    protected $primaryKey="id";

    protected $fillable = [ 'nama_pegawai', 'alamat', 'email' ];
}
