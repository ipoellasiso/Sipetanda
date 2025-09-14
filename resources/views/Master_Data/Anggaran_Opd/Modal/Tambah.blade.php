<div class="modal fade" id="tambahanggaranopd">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div> -->
            <div class="modal-body">
            <form id="userForm1" name="userForm1" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id_anggaranopd" id="id_anggaranopd1">
                            <div class="row">
                                <div class="col-12">
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
                                    <label>Rincian Objek</label>
                                    <select class="form-select" name="id_rincianobjek" id="id_rincianobjek" style="width: 100%" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Rincian Objek</label>
                                    <select class="form-select" name="id_subrincianobjek" id="id_subrincianobjek" style="width: 100%" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Uraian</label>
                                    <input class="form-control" id="uraian" name="uraian" required>
                                    </input>
                                </div>
                                <div class="form-group">
                                    <label>Nilai Anggaran</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" class="form-control amount1" name="nilai_anggaranopd" id="nilai_anggaranopd"
                                            aria-label="Amount (to the nearest dollar)"
                                            placeholder="000.000.000">
                                        <span class="input-group-text">,00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="fa fa-save"></i> Close
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
