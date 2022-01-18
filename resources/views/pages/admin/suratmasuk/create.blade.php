@extends('layouts.gentella')

@section('title')
Tambah
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>@yield('title')
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{route('suratmasuk.store')}}" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Arsip <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input name="tgl_arsip" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)" value="{{date('Y-m-d')}}">
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function() {
                                        input.type = 'text';
                                    }, 60000);
                                }
                            </script>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Perihal <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text"  required="required" class="form-control @error('perihal') is-invalid @enderror" name="perihal">
                            @error('perihal')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kategori Surat <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select id="heard" class="form-control @error('prefix') is-invalid @enderror" required name="kategori_id">
                                <option value="">Pilih Kategori ...</option>
                                @forelse ($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @empty

                                @endforelse
                            </select>
                            @error('prefix')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Lampiran <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text"  required="required" class="form-control @error('lampiran') is-invalid @enderror" name="lampiran">
                            @error('lampiran')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Upload Files <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="file" name="file" required="required" class="form-control @error('file') is-invalid @enderror" >
                            @error('file')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tujuan / Penerima <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="js-example-basic-single form-control-sm @error('tujuan')
                                is-invalid
                            @enderror" name="tujuan[]"  style="width: 100%" multiple="multiple">
                                <option disabled  value=""> Pilih Divisi</option>
                                @foreach ($divisi as $item)
                                    <option value="{{ $item->id }}"> {{ $item->nama }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>

                      <script type="text/javascript">
                        $(document).ready(function() {
                            console.log('test');
                            // In your Javascript (external .js resource or <script> tag)
                                $(document).ready(function() {
                                    $('.js-example-basic-single').select2({
                                        // theme: "classic",
                                        // allowClear: true,
                                        width: "resolve"
                                    });
                                });
                        });
                       </script>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <a class="btn btn-dark" type="button" href="{{route('divisi')}}">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
