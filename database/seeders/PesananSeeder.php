<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pesanans = [
            [
                'no_meja' => 22,
                'nama_pemesan' => 'Susanti',
                'total_harga' => 12000,
                'metode' => 'qris',
                'status' => 'proses',
                'menus' => [
                    [
                        'id' => 1,
                        'kuantitas' => 3,
                        'total_harga' => Menu::select('harga')->where('id', 1)->first()->harga * 3,
                    ],
                ],
            ],
        ];
        foreach ($pesanans as $pesanan) {
            // Membuat pesanan dan mendapatkan ID yang dihasilkan
            $newPesanan = Pesanan::create([
                'no_meja' => $pesanan['no_meja'],
                'nama_pemesan' => $pesanan['nama_pemesan'],
                'total_harga' => $pesanan['total_harga'],
                'metode' => $pesanan['metode'],
                'status' => $pesanan['status'],
            ]);
        
            // Memastikan pesanan telah berhasil dibuat
            if ($newPesanan) {
                foreach ($pesanan['menus'] as $menu) {
                    DB::table('detail_pesanans')->insert([
                        'id_menu' => $menu['id'],
                        'id_pesanan' => $newPesanan->id, // menggunakan ID pesanan yang baru dibuat
                        'kuantitas' => $menu['kuantitas'],
                        'total_harga' => $menu['total_harga'],
                    ]);
                }
            } else {
                
            }
        }
    }
}
