<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $guarded = 'id';

    public function menus(){
        return $this->belongsToMany(
            Menu::class,
            'detail_pesanans',
            'id_pesanan',
            'id_menu'
        );
    }

    public function detailPesanan(){
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }
}
