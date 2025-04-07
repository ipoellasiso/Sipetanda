<div class="modal fade" id="tambahrekening">
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
                            <input type="text" name="id_rekening" id="id_rekening">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Akun</label>
                                        <input type="text" class="form-control" name="ket4" id="ket4" value="" placeholder="Akun ...." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelompok</label>
                                        <input type="text" class="form-control" name="ket1" id="ket1" value="" placeholder="Kelompok ...." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <input type="text" class="form-control" name="ket2" id="ket2" value="" placeholder="Jenis ...." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Objek</label>
                                        <input type="text" class="form-control" name="ket3" id="ket3" value="" placeholder="Objek ....">
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Rekening</label>
                                        <input type="text" class="form-control" name="no_rekening" id="no_rekening" value="" placeholder="Nomor Rekening ...." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Rekening</label>
                                        <input type="text" class="form-control" name="rekening" id="rekening" value="" placeholder="Rekening ...." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Rekening 2</label>
                                        <input type="text" class="form-control" name="rekening2" id="rekening2" value="" placeholder="Rekening 2 ...." required>
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
