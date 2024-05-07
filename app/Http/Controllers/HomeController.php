<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

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
        $totalPrice = 0; 

        
        foreach ($carts as $item) {
            
            $itemTotal = $item['price'] * $item['quantity'];

            
            $totalPrice += $itemTotal;
        }
        return view('pelanggan.cart', compact('carts','totalPrice'));
    }

    public function addCart(Request $request, $menu_id){

        $validatedData = $request->validate([
            'nama_menu' => 'required',
            'kuantitas' => 'required|integer'
        ]);

        $cart = session()->get('cart', []);

        // Tambahkan item ke keranjang
        if(isset($cart[$menu_id])) {
            $cart[$menu_id]['quantity'] += 1; // Tambahkan jumlah jika item sudah ada
        } else {
            // Detail item yang ditambahkan
            $cart[$menu_id] = [
                'name' => $validatedData['nama_menu'],
                'price' => Menu::select('harga')->where('id', $menu_id)->first()->harga, 
                'quantity' => $validatedData['kuantitas'],
                'total_price' => Menu::select('harga')->where('id', $menu_id)->first()->harga * $validatedData['kuantitas'], 
            ];
        }

        // Simpan kembali ke dalam session
        session()->put('cart', $cart);
        return redirect()->back();
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
