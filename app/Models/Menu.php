<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $table = 'menus';
    protected $guarded = 'id';

    public function category(){
        return $this->BelongsTo(Kategori::class, 'id_kategori');
    }

    public function pesanans(){
        return $this->belongsToMany(
            Pesanan::class,
            'detail_pesanans',
            'id_menu',
            'id_pesanan'
        );
    }

    public function detailPesanans(){
        return $this->hasMany(DetailPesanan::class, 'id_menu');
    }
}
