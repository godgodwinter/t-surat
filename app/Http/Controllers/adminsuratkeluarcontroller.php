<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\surat_keluar;
use Illuminate\Http\Request;

class adminsuratkeluarcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='suratkeluar';
        $datas=surat_keluar::orderBy('tgl_arsip','desc')
        ->paginate();
        return view('pages.admin.suratkeluar.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='suratkeluar';
        $kategori=kategori::where('prefix','suratkeluar')->get();
        return view('pages.admin.suratkeluar.create',compact('pages','kategori'));
    }
    public function store(Request $request)
    {
        dd($request);
    }
}
