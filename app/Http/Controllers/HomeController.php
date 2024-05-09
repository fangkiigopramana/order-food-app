<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Home or Menu For Guest
     */
    public function index() {
        $recommended_menus = Menu::all()->take(4);
        return view("pelanggan.beranda", compact('recommended_menus'));
    }

    public function menu(){
        $cart = session()->get('cart', []);
        $menus = Menu::where('ketersediaan', 1)->with('category')->get();
        return view('pelanggan.menu', compact('menus'));
    }

    public function cart(){
        $carts = session()->get('cart', []);
        $lastCart = [];
        $totalPrice = 0; 

        $no_meja = 0;
        
        foreach ($carts as $item) {
            $totalPrice += $item['total_price'];
        }

        return view('pelanggan.cart', compact('carts','totalPrice', 'no_meja', 'lastCart'));
    }

    public function addCart(Request $request, $menu_id){

        $validatedData = $request->validate([
            'nama_menu' => 'required',
            'kuantitas' => 'required|integer|min:1'
        ]);
    
        // Mendapatkan harga menu
        $menu = Menu::find($menu_id);
        if(!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan');
        }
    
        $cart = session()->get('cart', []);
    
        if(isset($cart[$menu_id])) {
            // Produk sudah ada di keranjang, tambah kuantitas dan perbarui total harga
            $cart[$menu_id]['quantity'] += $validatedData['kuantitas']; // Tambah kuantitas
            $cart[$menu_id]['total_price'] = $cart[$menu_id]['price'] * $cart[$menu_id]['quantity']; // Perbarui total harga
        } else {
            // Produk belum ada di keranjang, tambahkan sebagai item baru
            $cart[$menu_id] = [
                'name' => $validatedData['nama_menu'],
                'price' => $menu->harga,
                'quantity' => $validatedData['kuantitas'],
                'total_price' => $menu->harga * $validatedData['kuantitas'], 
            ];
        }
    
        // Simpan perubahan ke dalam sesi
        session()->put('cart', $cart);
    
        // Beri pesan konfirmasi penambahan item
        session()->flash('add-cart-successfully', 'Item berhasil ditambahkan ke keranjang');
    
        return redirect()->back();
    }

    public function removeItem(Request $request, $order_id) {
        // Ambil keranjang dari sesi
        $cart = session()->get('cart', []);
    
        // Hapus item dari keranjang jika ada
        if (isset($cart[$order_id])) {
            unset($cart[$order_id]); // Hapus item berdasarkan menu_id
        }
    
        // Simpan kembali ke dalam sesi
        session()->put('cart', $cart);
    
        // Beri pesan konfirmasi penghapusan item
        session()->flash('remove-cart-successfully', 'Item berhasil dihapus dari keranjang');
    
        return redirect()->back();
    }

    public function checkoutOrder(Request $request){
        $validatedData = $request->validate([
            'total_harga' => 'required|numeric',
            'nomor_meja' => 'required|numeric',
            'nomor_phone' => 'required|string',
            'nama_pemesan' => 'required|string',
        ]);
        $carts = session()->get('cart', []);
        $new_pesanan = new Pesanan();

        $new_pesanan->no_meja = $validatedData['nomor_meja'];
        $new_pesanan->nama_pemesan = $validatedData['nama_pemesan'];
        $new_pesanan->total_harga = $validatedData['total_harga'];
        $new_pesanan->metode = 'qris';
        $new_pesanan->status = 'proses';
        $new_pesanan->save();

        foreach ($carts as $index => $cart) {
            $menu = Menu::select('id')->where('nama', $cart['name']);

            DetailPesanan::create([
                'id_menu' => $menu->first()->id,
                'id_pesanan' => $new_pesanan->id, 
                'kuantitas' => $cart['quantity'],
                'total_harga' => $cart['total_price'],
            ]);
        }

        session()->forget('cart');

        $no_meja = $new_pesanan->no_meja;
        session()->flash('checkout-order-successfully', 'Terima kasih sudah memesan di Warmindo Aroma');
        return redirect()->route('pelanggan.cart')->with([
            'no_meja' => $no_meja,
            'lastCart' => $carts
        ]);


    }
    
    

    
    


    // public function invoice(Request $request)
    // {
    //     // $uuid = $request->cookie('UUID');

    //     // $orders = Checkout::where('uuid', $uuid)->get();

    //     // $groupedOrder = $orders->groupBy('menu_id');
    //     // // $latestGroupedOrder = collect();

    //     // foreach ($groupedOrder as $items => $item) {
    //     //     $latestItem = $item->sortByDesc('created_at')->first();
    //     //     $latestGroupedOrder->put($items, $latestItem);
    //     // }

    //     // return view("guest.pages.invoice", [
    //     //     'title' => 'Invoice',
    //     //     'groupedOrder' => $groupedOrder,
    //     //     'uuid' => $uuid
    //     // ]);
    // }

    // public function resetCookie()
    // {
    //     // return redirect(route('guest.menu'))->withCookie(Cookie::forget('UUID'));
    // }

}
