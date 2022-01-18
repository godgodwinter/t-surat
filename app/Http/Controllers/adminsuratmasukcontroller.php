<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\surat_masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminsuratmasukcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='suratmasuk';
        $datas=surat_masuk::orderBy('tgl_arsip','desc')
        ->paginate();
        return view('pages.admin.suratmasuk.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='suratmasuk';
        $kategori=kategori::where('prefix','suratmasuk')->get();
        return view('pages.admin.suratmasuk.create',compact('pages','kategori'));
    }
    public function store(Request $request)
    {

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

        DB::table('surat_masuk')->insert(
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
    return redirect()->route('suratmasuk')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(surat_masuk $id){

        surat_masuk::destroy($id->id);
        return redirect()->route('suratmasuk')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

}
