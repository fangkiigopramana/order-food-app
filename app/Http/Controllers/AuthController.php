<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\DetailPesanan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function validation(Request $request)
    {
        $request->flashOnly(['username']);

        // Definisi aturan validasi
        $rules = [
            'username' => ['required', 'string'], // Menjamin bahwa username tidak kosong
            'password' => ['required', 'string']  // Menjamin bahwa password tidak kosong
        ];

        $messages = [
            'username.required' => 'Input Username Wajib Diisi', // Pesan khusus untuk aturan 'required' pada username
            'password.required' => 'Input Password Wajib Diisi', // Pesan khusus untuk aturan 'required' pada password
        ];

        // Validasi request berdasarkan aturan yang didefinisikan
        try {
            $validated = $request->validate($rules, $messages);

            $credentials = [
                'username' => $validated['username'],
                'password' => $validated['password']
            ];

            // Cek apakah kredensial yang diberikan benar
            if (Auth::attempt($credentials)) {
                // Jika benar, mulai session dan redirect ke dashboard
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            }

            // Jika salah, kembalikan pesan error
            throw ValidationException::withMessages([
                'credentials' => ['Username atau password salah.'] // Pesan saat username atau password salah
            ]);
            
        } catch (ValidationException $e) {
            // Tangani kesalahan validasi dan kembalikan pesan error yang spesifik
            return back()
                ->withErrors($e->errors()) // Mengembalikan pesan kesalahan
                ->withInput(); // Memastikan input sebelumnya tetap ada pada form
        }
    }

    public function dashboard()
    {
        $menus = Menu::all();
        $makanans = Menu::where('id_kategori', 1)
                ->where('ketersediaan', '>', 0)
                ->get();
        $minumans = Menu::where('id_kategori', 2)
                ->where('ketersediaan', '>', 0)
                ->get();
        $camilans = Menu::where('id_kategori', 3)
                ->where('ketersediaan', '>', 0)
                ->get();
        $pesanans = Pesanan::all();
        $karyawans = User::role('admin')->get();

        $revenue_datas = Pesanan::selectRaw('SUM(total_harga) AS total_revenue, EXTRACT(YEAR FROM created_at) AS year, EXTRACT(WEEK FROM created_at) AS week')
            ->groupBy('year', 'week') // Mengelompokkan berdasarkan tahun dan minggu
            ->orderBy('year') // Urutkan berdasarkan tahun
            ->orderBy('week') // Urutkan berdasarkan minggu dalam tahun yang sama
            ->get();
        // dd($revenue_datas);

        $total_revenues = [];

        foreach ($revenue_datas as $revenue) {
            $total_revenues[] = $revenue->total_revenue; 
        }

        $detail_pesanans = DetailPesanan::with(['menu','pesanan'])->get();
        return view('admin.dashboard', compact('menus', 'pesanans', 'karyawans', 'makanans', 'minumans', 'camilans','detail_pesanans','total_revenues'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
