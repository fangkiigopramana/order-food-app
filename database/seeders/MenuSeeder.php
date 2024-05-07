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
            // Makanan
            ['nama' => 'Mie Goreng', 'id_kategori' => 1, 'harga' => 7000, 'ketersediaan' => true],
            ['nama' => 'Mie Rebus', 'id_kategori' => 1, 'harga' => 7000, 'ketersediaan' => true],
            ['nama' => 'Nasi Omelet', 'id_kategori' => 1, 'harga' => 12000, 'ketersediaan' => true],
            ['nama' => 'Nasi Ayam Bali', 'id_kategori' => 1, 'harga' => 13000, 'ketersediaan' => true],
            ['nama' => 'Nasi Ayam Geprek', 'id_kategori' => 1, 'harga' => 14000, 'ketersediaan' => true],
            ['nama' => 'Nasi Gongso', 'id_kategori' => 1, 'harga' => 12000, 'ketersediaan' => true],
            ['nama' => 'Nasi Goreng Telur', 'id_kategori' => 1, 'harga' => 12000, 'ketersediaan' => true],
            ['nama' => 'Nasi Goreng Ayam', 'id_kategori' => 1, 'harga' => 15000, 'ketersediaan' => true],
        
            // Minuman
            ['nama' => 'Es Teh Manis', 'id_kategori' => 2, 'harga' => 3000, 'ketersediaan' => true],
            ['nama' => 'Air Es', 'id_kategori' => 2, 'harga' => 1000, 'ketersediaan' => true],
            ['nama' => 'Es Teh Tawar', 'id_kategori' => 2, 'harga' => 2000, 'ketersediaan' => true],
            ['nama' => 'Kopi', 'id_kategori' => 2, 'harga' => 4000, 'ketersediaan' => true],
            ['nama' => 'Teh Tarik', 'id_kategori' => 2, 'harga' => 5000, 'ketersediaan' => true],
            ['nama' => 'Nutrisari', 'id_kategori' => 2, 'harga' => 4000, 'ketersediaan' => true],
            ['nama' => 'Susu', 'id_kategori' => 2, 'harga' => 4000, 'ketersediaan' => true],
            ['nama' => 'Susu Jahe', 'id_kategori' => 2, 'harga' => 4000, 'ketersediaan' => true],
        
            // Camilan
            ['nama' => 'Krupuk', 'id_kategori' => 3, 'harga' => 2000, 'ketersediaan' => true],
            ['nama' => 'Gorengan Bakwan', 'id_kategori' => 3, 'harga' => 1000, 'ketersediaan' => true],
            ['nama' => 'Gorengan Tempe', 'id_kategori' => 3, 'harga' => 1000, 'ketersediaan' => true],
            ['nama' => 'Wafer', 'id_kategori' => 3, 'harga' => 3000, 'ketersediaan' => true],
        ];
        foreach ($menus as $menu) {
            Menu::create([
                'id_kategori' => $menu['id_kategori'],
                'nama' => $menu['nama'],
                'harga' => $menu['harga'],
                'ketersediaan' => $menu['ketersediaan'],
            ]);
        }
    }
}
