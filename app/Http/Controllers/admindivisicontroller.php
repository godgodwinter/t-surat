<?php

namespace App\Http\Controllers;

use App\Models\divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class admindivisicontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='divisi';
        $datas=divisi::
        paginate();
        return view('pages.admin.divisi.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='divisi';
        return view('pages.admin.divisi.create',compact('pages'));
    }

    public function store(Request $request)
    {
            $request->validate([
                'nama'=>'required|unique:divisi',
            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);
            DB::table('divisi')->insert(
                array(
                       'nama'     =>   $request->nama,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));
    return redirect()->route('divisi')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
    }

    public function edit(divisi $id)
    {
        $pages='divisi';
        return view('pages.admin.divisi.edit',compact('pages','id'));
    }
    public function update(divisi $id,Request $request)
    {

        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'nama harus diisi',
        ]);

            divisi::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);



    return redirect()->route('divisi')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(divisi $id){

        divisi::destroy($id->id);
        return redirect()->route('divisi')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

}
