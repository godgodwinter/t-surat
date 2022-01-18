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
    return redirect()->route('suratkeluar')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
        // dd($request);
    }

    public function cetak(surat_keluar $id){
        // dd($id);
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.suratkeluar.cetak',compact('id'))->setPaper('a4', 'landscape');
        return $pdf->stream('surat'.$tgl.'-pdf');
    }

    public function cetakperdivisi(surat_keluar $id,divisi $divisi){
        // dd($id,$divisi);
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.suratkeluar.cetakperdivisi',compact('id','divisi'))->setPaper('a4', 'landscape');
        return $pdf->stream('surat'.$tgl.'-pdf');
    }
    public function destroy(surat_keluar $id){

        surat_keluar::destroy($id->id);
        return redirect()->route('suratkeluar')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
