@extends('layouts.gentella')

@section('title')
Surat Masuk
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
@push('after-style')
<link href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<!-- Datatables -->
<link href="{{asset('assets/gentella/vendors/')}}/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{asset('assets/gentella/vendors/')}}/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="{{asset('assets/gentella/vendors/')}}/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="{{asset('assets/gentella/vendors/')}}/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="{{asset('assets/gentella/vendors/')}}/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

@endpush

@push('after-script')
    <!-- Datatables -->
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/jszip/dist/jszip.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{asset('assets/gentella/vendors/')}}/pdfmake/build/vfs_fonts.js"></script>
@endpush
 <!-- page content -->
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>@yield('title')
        </h3>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              {{-- <a class="btn btn-sm btn-primary" href="{{route('divisi.suratmasuk.create')}}"> Tambah </a> --}}
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
              {{-- <p class="text-muted font-13 m-b-30">
                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
              </p> --}}
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th class="babeng-min-row">No</th>
                    <th>Tanggal Arsip</th>
                    <th>Perihal</th>
                    <th>Tujuan / Penerima</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Penerima Surat</th>
                    {{-- <th class="text-center">Aksi</th> --}}
                  </tr>
                </thead>


                <tbody>
                    @forelse ($datas as $data)
                    @php
                    //jika penerima surat masuk adalah akun ini maka tampil
                    //jika bukan akun ini maka yang ditampilkan hanya sesuai divisi akun ini.
                    if($data->users_id==Auth::user()->id){
                        $periksa=1;
                    }else{
                        $periksa=\App\Models\surat_masuk_distribusi::with('divisi')->where('surat_masuk_id',$data->id)->where('divisi_id',Auth::user()->divisi_id)->count();
                    }
                        // dd($periksa);
                    @endphp
                    @if($periksa>0)
                  <tr>
                    <td class="text-center">{{$loop->index+1}}</td>
                    <td>{{Fungsi::tanggalindo($data->tgl_arsip)}}</td>
                    {{-- <td>{{$data->tgl_arsip}}</td> --}}
                    <td>{{$data->perihal}}</td>
                    <td>
                        @php
                            $gettujuan=\App\Models\surat_masuk_distribusi::with('divisi')->where('surat_masuk_id',$data->id)->get();
                        @endphp
                        @forelse ($gettujuan as $item)
                            <button class="btn btn-info btn-sm">{{$item->divisi!=null?$item->divisi->nama:'Divisi tidak ditemukan'}}</button>
                        @empty

                        @endforelse
                    </td>
                    @php
                        $creator='-';
                        $getcreator=\App\Models\User::where('id',$data->users_id)->first();
                        $creator=$getcreator->name;
                    @endphp
                    <td><a href="{{asset($data->file)}}" class="btn btn-sm btn-info btn-rounded">Download</a></td>
                    @php
                        $status='waiting';
                        $warna='secondary';
                        if($data->status=='dec'){
                            $warna='danger';
                            $status='Ditolak/Dibatalkan';
                        }elseif($data->status=='ok'){
                            $warna='success';
                            $status='Ok';
                        }
                    @endphp
                    <td><button class="btn btn-{{$warna}} btn-sm">{{ucfirst($status)}}</button></td>
                    <td>{{$creator}}</td>
                    {{-- <td class="babeng-min-row">
                        @if($data->status!='waiting')
    <button class="btn btn-icon btn-dark btn-sm"
   data-toggle="tooltip" data-placement="top" title="Data tidak bisa dihapus!"><span
        class="pcoded-micon"> <i class="fas fa-trash"></i></span></button>
                        @else
                        <x-button-delete link="{{route('suratmasuk.destroy',$data->id)}}" />
                        @endif
                    </td> --}}
                  </tr>
                  @endif
                    @empty

                    @endforelse
                </tbody>
              </table>
            </div>
            </div>
        </div>
      </div>
          </div>
        </div>




            </div>
          </div>
        </div>
      </div>
          </div>
        </div>
      </div>
    </div>
  <!-- /page content -->
@endsection
