<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class SuperAdminController extends Controller
{
    public function menu()
    {
        $menus = Menu::all();
        $categories = Kategori::all();
        return view('superadmin.menu', compact('menus','categories'));
    }

    public function addMenu(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required|integer',
            'harga' => 'required|integer',
            'ketersediaan' => 'required|boolean',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/menu', $filename);
            $publicFilePath = str_replace('public/', '', $filePath);
        }
        $newMenu = new Menu();
        $newMenu->nama = $validatedData['nama'];
        $newMenu->id_kategori = $validatedData['id_kategori'];
        $newMenu->harga = $validatedData['harga'];
        $newMenu->ketersediaan = $validatedData['ketersediaan'];
        $newMenu->gambar = $publicFilePath;
        $newMenu->save();
        Session::flash('update-menu-successfully', 'Menu telah berhasil ditambahkan!');
        return redirect()->back();        
    }

    public function destroyMenu($id_menu){
        $menu = Menu::find($id_menu);
        if ($menu) {
            $menu->delete();
        }
        return redirect()->back();
    }

    public function laporan()
    {
        $laporans = DetailPesanan::select(
            'id_menu', 
            DB::raw('sum(total_harga) as total_harga'), 
            DB::raw('sum(kuantitas) as total_kuantitas') 
        )
        ->whereHas('pesanan', function ($query) {
            $query->where('status', 'sukses');
        })
        ->with(['menu', 'menu.category']) 
        ->groupBy('id_menu') 
        ->get();
        return view('superadmin.laporan', compact('laporans'));
    }

    public function printLaporan(Request $request){
        // dd($request);
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $datas = DetailPesanan::whereBetween('created_at', [$startDate, $endDate])
        ->whereHas('pesanan', function ($query) {
            $query->where('status', 'sukses');
        })
        ->get();

        $pdf = Pdf::loadView('superadmin.report', 
        [
            'datas' => $datas,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
        return $pdf->download('report.pdf');
        // return view('superadmin.report', compact('startDate','endDate','datas'));
    }

    public function karyawan()
    {
        $users = User::all();
        return view('superadmin.karyawan', compact('users'));
    }


    public function addAccount(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,super admin',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
        // dd($request);
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/photo-profile', $filename);
            $publicFilePath = str_replace('public/', '', $filePath);
        }

        if($validatedData['password'] === $validatedData['confirm_password']){
            $new_user = User::create([
                'nama' =>$validatedData['nama'],
                'username' =>$validatedData['username'],
                'email' =>$validatedData['email'],
                'password' =>$validatedData['password'],
                'profile_photo' =>$publicFilePath
            ]);
            $new_user->assignRole($validatedData['role']);
            Session::flash('add-account-successfully', 'Akun telah berhasil ditambahkan!');
        }

        return redirect()->back();


        
    }

    public function updateAccount(Request $request, $user_id){
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,super admin',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
        // dd($request);
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/photo-profile', $filename);
            $publicFilePath = str_replace('public/', '', $filePath);
        }

        $user = User::findOrFail($user_id);
        if($validatedData['password'] === $validatedData['confirm_password']){
            $user->nama =  $validatedData['nama'];
            $user->username = $validatedData['username'];
            $user->email = $validatedData['email'];
            $user->password = $validatedData['password'];
            $user->assignRole($validatedData['role']);
            if (isset($validatedData['foto_profil'])) {
                $user->profile_photo = $publicFilePath;
            }
            $user->save();
            Session::flash('update-account-successfully', 'Akun telah berhasil diubah!');
            return redirect()->back();
        }

        Session::flash('update-account-failed', 'Akun Gagal diubah!');
        return redirect()->back();
    }

    public function destroyAccount($id_account){
        $account = User::findOrFail($id_account);
        if ($account) {
            $account->delete();
        }
        return redirect()->back();
    }
}
