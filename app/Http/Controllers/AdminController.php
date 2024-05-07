<?php
namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function pesanan()
    {
        $pesanans = Pesanan::with(['menus','detailPesanan'])->get();
        $menus = Menu::all();
        return view('admin.pesanan', compact('pesanans','menus'));
    }
    public function menu()
    {
        $menus = Menu::all();
        return view('admin.menu', compact('menus'));
    }
    public function addPesanan(Request $request){
        $validatedData = $request->validate([
            'nama_pemesan' => 'required|string|min:3|max:255',  
            'no_meja' => 'required|integer|min:1|max:1000',     
            'makanan-select' => 'required|exists:menus,id',   
            'makanan_quantity' => 'required|integer|min:1',      
            'minuman-select' => 'required|exists:menus,id',   
            'minuman_quantity' => 'required|integer|min:1',      
            'camilan-select' => 'required|exists:menus,id',   
            'camilan_quantity' => 'required|integer|min:1',      
        ]);
        $pesanan = new Pesanan;
        $pesanan->nama_pemesan = $validatedData['nama_pemesan'];
        $pesanan->no_meja = $validatedData['no_meja'];
        $pesanan->metode = 'qris';
        $pesanan->status = 'proses';
        $hargaMakanan = Menu::select('harga')->where('id', $validatedData['makanan-select'])->first()->harga * $validatedData['makanan_quantity'];
        $hargaMinuman = Menu::select('harga')->where('id', $validatedData['minuman-select'])->first()->harga * $validatedData['minuman_quantity'];
        $hargaCamilan = Menu::select('harga')->where('id', $validatedData['camilan-select'])->first()->harga * $validatedData['camilan_quantity'];
        // dd($hargaCamilan+$hargaMakanan+$hargaMinuman);
        $pesanan->total_harga = $hargaCamilan+$hargaMakanan+$hargaMinuman;
        $pesanan->save();
        $menus = [
            [
                'id' => $validatedData['makanan-select'],
                'kuantitas' => $validatedData['makanan_quantity'],
                'total_harga' => $hargaMakanan,
            ],
            [
                'id' => $validatedData['minuman-select'],
                'kuantitas' => $validatedData['minuman_quantity'],
                'total_harga' => $hargaMinuman,
            ],
            [
                'id' => $validatedData['camilan-select'],
                'kuantitas' => $validatedData['camilan_quantity'],
                'total_harga' => $hargaCamilan,
            ],
        ];
        foreach ($menus as $menu) {
            DetailPesanan::create([
                'id_menu' => $menu['id'],
                'id_pesanan' => $pesanan->id, 
                'kuantitas' => $menu['kuantitas'],
                'total_harga' => $menu['total_harga'],
            ]);
        }
        return redirect()->back();
    }
    public function updateMenu(Request $request, $id_menu){
        // dd($request);
        $rules = [
            'nama' => 'required|max:255',
            'id_kategori' => 'required|numeric',  
            'harga' => 'required|numeric',  
            'ketersediaan' => 'required|in:1,0',  
        ];
        $validatedData = $request->validate($rules);
        $updateData = [
            'nama' => $validatedData['nama'],
            'harga' => $validatedData['harga'],
            'id_kategori' => $validatedData['id_kategori'],
            'ketersediaan' => $validatedData['ketersediaan'],
        ];
        if ($request->hasFile('gambar')) {
            $imageRules = [
                'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'  
            ];
            $request->validate($imageRules);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/menu', $filename);
            $publicFilePath = str_replace('public/', '', $filePath);
            $updateData['gambar'] = $publicFilePath;

        }
        Menu::where('id', $id_menu)->update($updateData);
        return redirect()->back();
    }
}
