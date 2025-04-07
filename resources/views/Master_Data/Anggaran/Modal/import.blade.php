<div class="modal fade" id="tambahimportanggaran">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Import BKU</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm1" name="userForm1" enctype="multipart/form-data" action="{{ route('anggaran.import') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-12">
                                {{-- <div class="form-group">
                                    <label>Pilih File</label>
                                    <br>
                                    <input type="file" class="form-control" name="file">
                                </div> --}}
                                <div class="input-group">
                                    <input type="file" class="form-control" id="inputGroupFile04"
                                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    <button class="btn btn-primary" type="submit"
                                        id="inputGroupFileAddon04">Import</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-save"></i>  Import
                        </button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
