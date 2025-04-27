@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        <div>
            <h4>Filter Data</h4>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group mb-3">
                    <label for="roundText">Pilih Opd</label>
                    <select class="form-select" name="id_opd" id="id_opd" style="width: 100%" required>
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <label for="roundText">Tanggal Awal</label>
                    <input type="date" class="form-control mb-3 flatpickr-no-config" placeholder="Select date..">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <label for="roundText">Tanggal Akhir</label>
                    <input type="date" class="form-control mb-3 flatpickr-no-config" placeholder="Select date..">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group mb-3">
                    <label for="roundText">Pilih Rekening</label>
                    <select class="form-select" name="id_rekening" id="id_rekening" style="width: 100%" required>
                        <option></option>
                    </select>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group mb-3">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group mb-3">
                    <button type="button" class="btn btn-outline-primary caribaru" data-bs-dismiss="modal">
                        <i class="fa fa-check"></i> Terapkan
                    </button>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group mb-3">
                    <button type="submit" id="saveBtn" value="create" class="btn btn-outline-danger">
                        <i class="fa fa-undo"></i>  Reset
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-body tampildata1">
        {{--Tampilan Data --}}
    </div>
</div>

@include('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek.Fungsi.Fungsi')


@endsection