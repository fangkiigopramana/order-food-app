<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama' => 'Makanan',
                'deskripsi' => 'Kategori yang mencakup semua jenis makanan utama.'
            ],
            [
                'nama' => 'Minuman',
                'deskripsi' => 'Kategori yang mencakup semua jenis minuman.'
            ],
            [
                'nama' => 'Camilan',
                'deskripsi' => 'Kategori yang mencakup semua jenis makanan ringan atau camilan.'
            ]
        ];
        foreach ($categories as $category) {
            Kategori::create([
                'nama' => $category['nama'],
                'deskripsi' => $category['deskripsi'],
            ]);
        }
    }
}
