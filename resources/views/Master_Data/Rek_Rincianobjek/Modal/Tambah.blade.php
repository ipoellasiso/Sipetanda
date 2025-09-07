<div class="modal fade" id="tambahrekrincianobjek" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">Tambah Data BKU</h4>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div> --}}
            <div class="modal-body">
                <form id="userForm" name="userForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id_ro" id="id6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Akun</label>
                                    <select class="form-select" name="id_akun" id="id_akun" style="width: 100%" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kelompok</label>
                                    <select class="form-select" name="id_kelompok" id="id_kelompok" style="width: 100%" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <select class="form-select" name="id_jenis" id="id_jenis" style="width: 100%" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Objek</label>
                                    <select class="form-select" name="id_objek" id="id_objek" style="width: 100%" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" class="form-control" name="no_rek_ro" id="no_rek_ro" value="" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>Rekening</label>
                                    <input class="form-control" id="rek_ro" name="rek_ro" required>
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            <i class="anticon anticon-undo"></i> Close
                        </button>
                        <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary">
                            <i class="fa fa-save"></i>  Simpan
                        </button>
    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

