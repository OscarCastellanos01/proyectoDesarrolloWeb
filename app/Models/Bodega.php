<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $table = 'tbl_bodega';
    protected $primaryKey = 'id_bodega';

    protected $fillable = [
        'nombre_bodega',
        'id_sucursal',
        'id_empresa'
    ];

}
