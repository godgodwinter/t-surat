<?php

namespace App\Http\Controllers;

use App\Models\divisi;
use Illuminate\Http\Request;

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
}
