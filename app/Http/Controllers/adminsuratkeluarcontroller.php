<?php

namespace App\Http\Controllers;

use App\Models\divisi;
use App\Models\kategori;
use App\Models\surat_keluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class adminsuratkeluarcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='suratkeluar';
        $datas=surat_keluar::orderBy('tgl','desc')
        ->paginate();
        return view('pages.admin.suratkeluar.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='suratkeluar';
        $kategori=kategori::where('prefix','suratkeluar')->get();
        $divisi=divisi::get();
        return view('pages.admin.suratkeluar.create',compact('pages','kategori','divisi'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tgl'=>'required',
            'perihal'=>'required',
        ],
        [
            'tgl.required'=>'Nama Harus diisi',

        ]);
        DB::table('surat_keluar')->insert(
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
    return redirect()->route('suratkeluar')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
        // dd($request);
    }

    public function cetak(surat_keluar $id){
        // dd($id);
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.suratkeluar.cetak',compact('id'))->setPaper('a4', 'landscape');
        return $pdf->stream('surat'.$tgl.'-pdf');
    }
}
