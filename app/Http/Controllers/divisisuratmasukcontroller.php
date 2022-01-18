<?php

namespace App\Http\Controllers;

use App\Models\divisi;
use App\Models\kategori;
use App\Models\surat_keluar;
use App\Models\surat_masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class divisisuratmasukcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='suratmasuk';
        $datas=surat_masuk::orderBy('tgl_arsip','desc')
        ->paginate();
        return view('pages.divisi.suratmasuk.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='suratmasuk';
        $kategori=kategori::where('prefix','suratmasuk')->get();
        $divisi=divisi::get();
        return view('pages.divisi.suratmasuk.create',compact('pages','kategori','divisi'));
    }
    public function store(Request $request)
    {
        // dd($request,count($request->tujuan));
        $request->validate([
            'tgl_arsip'=>'required',
            'perihal'=>'required',
            'file' => 'max:2000|mimes:pdf,png,jpeg,xml', //2MB
        ],
        [
            'tgl_arsip.required'=>'Nama Harus diisi',

        ]);
        // dd($request);
        $files = $request->file('file');

        // dd($request);
        $namafileku=null;
        if($files!=null){
            // dd(!Input::hasFile('files'));
            // dd($files,'aaa');
            $namafilebaru=date('YmdHis');

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');
                      // nama file
            echo 'File Name: '.$file->getClientOriginalName();
            echo '<br>';

                      // ekstensi file
            echo 'File Extension: '.$file->getClientOriginalExtension();
            // dd()
            echo '<br>';

                      // real path
            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';

                      // ukuran file
            echo 'File Size: '.$file->getSize();
            echo '<br>';

                      // tipe mime
            echo 'File Mime Type: '.$file->getMimeType();

                      // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'suratmasuk/';

                    // upload file
            $file->move($tujuan_upload,"suratmasuk/".$namafilebaru.'.'.$file->getClientOriginalExtension());
                $namafileku="suratmasuk/".$namafilebaru.'.'.$file->getClientOriginalExtension();
            }

        $surat_masuk_id=DB::table('surat_masuk')->insertGetId(
            array(
                   'tgl_arsip'     =>   $request->tgl_arsip,
                   'perihal'     =>   $request->perihal,
                   'lampiran'     =>   $request->lampiran,
                    'file' => $namafileku,
                    'kategori_id' => $request->kategori_id,
                    'users_id' => Auth::user()->id,
                    'status' => 'waiting',
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

            if(count($request->tujuan)>0){
                for($i=0;$i<count($request->tujuan);$i++){
                    // dd($request->tujuan[$i]);
            DB::table('surat_masuk_distribusi')->insert(
                array(
                       'surat_masuk_id'     =>   $surat_masuk_id,
                       'divisi_id'     =>   $request->tujuan[$i],
                        'users_id' => null,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));
                }
            }


    return redirect()->route('divisi.suratmasuk')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
    }
}
