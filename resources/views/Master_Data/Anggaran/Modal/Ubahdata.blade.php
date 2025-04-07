@extends('Template.Layout')
@section('content')


<div class="card">
<!-- <div class="card-body"> -->
<ul class="nav nav-tabs nav-justified" id="myTabJustified" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#pajakls" role="tab" aria-controls="home-justified" aria-selected="true">{{ $title }}</a>
    </li>
</ul>

<div class="tab-content m-t-15" id="myTabContentJustified">
    <div class="tab-pane fade show active" id="pajakls" role="tabpanel" aria-labelledby="home-tab-justified">
        
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    {{-- <h4 class="card-title">{{ $title }}</h4>
                    <a class="btn btn-secondary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createPajakls" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                        <i class="fas fa-pencil-alt"></i>
                    </a> --}}
                </div>
                {{-- class="m-t-25" --}}
                <div class="modal-body">
                <form method="POST" action="/pajakls1/update/{{ $dtpajakls->id }}" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        <input type="text" name="id" value="{{ $dtpajakls->id }}">
                        <input type="text" name="id_potonganls" value="{{ $dtpajakls->id_potonganls }}">
                        <div class="row">
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    {{-- <label>Pilih Pajak</label>
                                    <button class="btn btn-tone btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" data-dismiss="modal">
                                        <i class="anticon anticon-sync"></i>
                                    </button> --}}
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>Nama NPWP</label>
                                    <input type="text" class="form-control" name="nama_npwp" id="nama_npwp" value="{{ $dtpajakls->nama_npwp }}" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nomor NPWP</label>
                                    <input type="text" class="form-control" name="nomor_npwp" id="nomor_npwp" value="{{ $dtpajakls->nomor_npwp }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label for="akun_pajak">Akun Pajak</label>
                                        <select class="select2" id="akun_pajak" name="akun_pajak">
                                            <option value="{{ $dtpajakls->akun_pajak }}">{{ $dtpajakls->akun_pajak }}</option>
                                        </select>
                                    
                                    <!-- <label for="akun_pajak">Akun Pajak:</label>
                                    <select class="select2" id="akun_pajak" name="akun_pajak">
                                        <option value="0">Pilih Akun Pajak</option>
                                        <option value="1">411211</option>
                                        <option value="2">411121</option>
                                        <option value="3">411122</option>
                                        <option value="4">411124</option>
                                        <option value="5">411128</option> -->
                                    <!-- </select> -->
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Jenis Pajak:</label>
                                    <select class="select2" id="jenis_pajak" name="jenis_pajak">
                                        <option value="{{ $dtpajakls->jenis_pajak }}">{{ $dtpajakls->jenis_pajak }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>Ebilling</label>
                                    <input type="text" class="form-control" name="ebilling" id="ebilling" value="{{ $dtpajakls->ebilling }}" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Rekening Belanja</label>
                                    <input type="text" class="form-control" name="rek_belanja" id="rek_belanja" value="{{ $dtpajakls->rek_belanja }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>NTPN</label>
                                    <input type="text" class="form-control" name="ntpn" id="ntpn" value="{{ $dtpajakls->ntpn }}" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nilai Pajak</label>
                                    <input type="text" class="form-control amount" name="nilai_pajak" id="nilai_pajak" value="{{ $dtpajakls->nilai_pajak }}" placeholder="" required>
                                </div>
                            </div>
                            
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>Upload Foto</label>
                                    <input type="file" class="form-control" name="bukti_pemby" id="bukti_pemby" value="{{ $dtpajakls->bukti_pemby }}" accept="image/*" onchange="readURL(this);">
                                    <input type="hidden" name="hidden_image" id="hidden_image">
                                    <small>Upload Foto Harus Format JPG,JPEG / PNS dan Max File 5MB </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <img id="modal-preview" src="https://via/placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/tampilpajakls1" type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="anticon anticon-undo"></i> Close
                        </a>
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-save"></i>  Simpan
                        </button>
    
                    </div>
                </form>
            </div>
            </div>
        </div>
</div>
</div>
</div>

@include('Penatausahaan.Pajakls1.Fungsi.Fungsipajaklssipd')
@include('Penatausahaan.Pajakls1.Modal.Datapajakls')
@include('Penatausahaan.Pajakls1.Modal.Tambah')
@include('Penatausahaan.Pajakls1.Fungsi.Fungsi')
@endsection