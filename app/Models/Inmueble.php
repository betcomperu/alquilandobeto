<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    use HasFactory;

    protected $fillable = [
        'direccion',
        'provincia',
        'distrito',
        'detalles',
        'foto',
        'precio',
        'alias',
        'estado',
        'iduser',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
