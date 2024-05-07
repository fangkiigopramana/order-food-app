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
            'harga' => 'required|numeric',
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
        Session::flash('add-menu-successfully', 'Menu telah berhasil ditambahkan!');
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
        ->with(['menu', 'menu.category']) 
        ->groupBy('id_menu') 
        ->get();
        return view('superadmin.laporan', compact('laporans'));
    }

    public function printLaporan(Request $request){
        // dd($request);
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $datas = DetailPesanan::whereBetween('created_at', [$startDate, $endDate])->get();
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
}
