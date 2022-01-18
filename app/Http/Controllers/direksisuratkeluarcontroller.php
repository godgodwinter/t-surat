<?php

namespace App\Http\Controllers;

use App\Models\surat_keluar;
use Illuminate\Http\Request;

class direksisuratkeluarcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='suratkeluar';
        $datas=surat_keluar::orderBy('tgl','desc')
        ->paginate();
        return view('pages.direksi.suratkeluar.index',compact('datas','request','pages'));
    }
    public function acc(surat_keluar $id)
    {
        // dd($id);
        surat_keluar::where('id',$id->id)
        ->update([
            'status'     =>   'ok',
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


        return redirect()->route('direksi.suratkeluar')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
    }

    public function dec(surat_keluar $id)
    {
        // dd($id);
        surat_keluar::where('id',$id->id)
        ->update([
            'status'     =>   'dec',
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


        return redirect()->route('direksi.suratkeluar')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
    }
}
