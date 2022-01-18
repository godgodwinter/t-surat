<?php

namespace App\Http\Controllers;

use App\Models\surat_masuk;
use Illuminate\Http\Request;

class direksisuratmasukcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='suratmasuk';
        $datas=surat_masuk::orderBy('tgl_arsip','desc')
        ->paginate();
        return view('pages.direksi.suratmasuk.index',compact('datas','request','pages'));
    }
    public function acc(surat_masuk $id)
    {
        // dd($id);
        surat_masuk::where('id',$id->id)
        ->update([
            'status'     =>   'ok',
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


        return redirect()->route('direksi.suratmasuk')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
    }

    public function dec(surat_masuk $id)
    {
        // dd($id);
        surat_masuk::where('id',$id->id)
        ->update([
            'status'     =>   'dec',
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


        return redirect()->route('direksi.suratmasuk')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
    }
}
