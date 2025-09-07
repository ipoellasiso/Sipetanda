<div class="modal fade" id="tambahrekakun" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">"document"> --}}
        
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
                        <input type="hidden" name="id" id="id5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" class="form-control" name="no_rek" id="no_rek" value="" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>Rekening</label>
                                    <input class="form-control" id="rek" name="rek" required>
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

