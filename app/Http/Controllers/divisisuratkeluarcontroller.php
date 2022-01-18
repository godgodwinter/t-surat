<?php

namespace App\Http\Controllers;

use App\Models\divisi;
use App\Models\kategori;
use App\Models\surat_keluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class divisisuratkeluarcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='suratkeluar';
        $datas=surat_keluar::orderBy('tgl','desc')
        ->paginate();
        return view('pages.divisi.suratkeluar.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='suratkeluar';
        $kategori=kategori::where('prefix','suratkeluar')->get();
        $divisi=divisi::get();
        return view('pages.divisi.suratkeluar.create',compact('pages','kategori','divisi'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'tgl'=>'required',
            'perihal'=>'required',
        ],
        [
            'tgl.required'=>'Nama Harus diisi',

        ]);
        $surat_id=DB::table('surat_keluar')->insertGetId(
            array(
                   'tgl'     =>   $request->tgl,
                   'perihal'     =>   $request->perihal,
                    'kategori_id' => $request->kategori_id,
                    'konten' => $request->konten,
                    'divisi_id' => $request->divisi_id,
                    'users_id' => Auth::user()->id,
                    'status' => 'waiting',
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

            if(count($request->tujuan)>0){
                for($i=0;$i<count($request->tujuan);$i++){
                    // dd($request->tujuan[$i]);
            DB::table('surat_keluar_distribusi')->insert(
                array(
                       'surat_keluar_id'     =>   $surat_id,
                       'divisi_id'     =>   $request->tujuan[$i],
                        'users_id' => null,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));
                }
            }
    return redirect()->route('divisi.suratkeluar')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
        // dd($request);
    }
}
