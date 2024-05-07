<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $guarded = ['id'];

    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function pesanan(){
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
