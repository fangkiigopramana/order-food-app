<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'id_kategori' => 1, 
                'nama' => 'Mie Goreng',
                'gambar' => 'menu/1715485456_1715425990_nasi-goreng.jpg',
                'harga' => 7000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 1, 
                'nama' => 'Mie Rebus',
                'gambar' => 'menu/1715485492_1715426034_mie-rebus.jpg',
                'harga' => 7000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 1, 
                'nama' => 'Nasi Omelet',
                'gambar' => 'menu/1715485633_1715426192_nasi-omelet.jpg',
                'harga' => 12000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 1, 
                'nama' => 'Nasi Ayam Bali',
                'gambar' => 'menu/1715485508_1715426063_nasi-ayam-bali.jpg',
                'harga' => 13000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 1, 
                'nama' => 'Nasi Ayam Geprek',
                'gambar' => 'menu/1715485526_1715426089_nasi-ayam-geprek.jpg',
                'harga' => 14000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 1, 
                'nama' => 'Nasi Gongso',
                'gambar' => 'menu/1715485545_1715426126_nasi-ayam-gongso.jpg',
                'harga' => 12000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 1, 
                'nama' => 'Nasi Goreng Telur',
                'gambar' => 'menu/1715485611_1715426173_nasi-goreng-telur.jpg',
                'harga' => 12000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 1, 
                'nama' => 'Nasi Goreng Ayam',
                'gambar' => 'menu/1715485576_1715426153_nasi-goreng-ayam.jpg',
                'harga' => 15000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 2, 
                'nama' => 'Es Teh Manis',
                'gambar' => 'menu/1715485326_1715425866_es-teh-manis.jpg',
                'harga' => 3000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 2, 
                'nama' => 'Air Es',
                'gambar' => 'menu/1715485312_1715425849_air-es.jpg',
                'harga' => 1000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 2, 
                'nama' => 'Es Teh Tawar',
                'gambar' => 'menu/1715485339_1715425890_es-teh-tawar.jpg',
                'harga' => 2000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 2, 
                'nama' => 'Kopi',
                'gambar' => 'menu/1715485384_1715425948_kopi.jpg',
                'harga' => 4000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 2, 
                'nama' => 'Teh Tarik',
                'gambar' => 'menu/1715485709_1715426449_teh-tarik.jpg',
                'harga' => 5000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 2, 
                'nama' => 'Nutrisari',
                'gambar' => 'menu/1715485652_1715426228_nutrisari.jpg',
                'harga' => 4000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 2, 
                'nama' => 'Susu',
                'gambar' => 'menu/1715485672_1715426262_susu.jpg',
                'harga' => 4000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 2, 
                'nama' => 'Susu Jahe',
                'gambar' => 'menu/1715485690_1715426427_susu-jahe.jpg',
                'harga' => 4000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 3, 
                'nama' => 'Krupuk',
                'gambar' => 'menu/1715485399_1715425965_krupuk.jpg',
                'harga' => 2000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 3, 
                'nama' => 'Gorengan Bakwan',
                'gambar' => 'menu/1715485354_1715425911_gorengan-bakwan.jpg',
                'harga' => 1000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 3, 
                'nama' => 'Gorengan Tempe',
                'gambar' => 'menu/1715485369_1715425929_gorengan-tempe.jpg',
                'harga' => 1000.00,
                'ketersediaan' => 1
            ],
            [
                'id_kategori' => 3, 
                'nama' => 'Wafer',
                'gambar' => 'menu/1715485759_1715426465_wafer.jpg',
                'harga' => 3000.00,
                'ketersediaan' => 1
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create([
                'id_kategori' => $menu['id_kategori'],
                'nama' => $menu['nama'],
                'gambar' => $menu['gambar'],
                'harga' => $menu['harga'],
                'ketersediaan' => $menu['ketersediaan'],
            ]);
        }
    }
}
