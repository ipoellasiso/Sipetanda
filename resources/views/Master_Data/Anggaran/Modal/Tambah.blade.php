<div class="modal fade bd-example-modal-xl" id="tambahpajakls" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-xl">
  
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title h4">Extra large modal</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div> --}}
            <div class="modal-body">
                <form id="userForm" name="userForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" name="id" id="id5">
                        <input type="text" name="id_potonganls" id="id_potonganls5">
                        <div class="row">
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>Pilih Pajak</label>
                                    <button class="btn btn-tone btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" data-dismiss="modal">
                                        <i class="anticon anticon-sync"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>Nama NPWP</label>
                                    <input type="text" class="form-control" name="nama_npwp" id="nama_npwp" value="" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nomor NPWP</label>
                                    <input type="text" class="form-control" name="nomor_npwp" id="nomor_npwp" value="" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label for="akun_pajak">Akun Pajak</label>
                                        <select class="select2" id="akun_pajak" name="akun_pajak">
                                                <option value=""></option> 
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
                                    <input class="form-control" id="jenis_pajak" name="jenis_pajak" readonly>
                                        {{-- <option value="{{ $jenispajak1->jenis_pajak }}"></option> --}}
                                    </input>
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>Ebilling</label>
                                    <input type="text" class="form-control" name="ebilling" id="ebillingg" value="" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Rekening Belanja</label>
                                    <input type="text" class="form-control" name="rek_belanja" id="rek_belanja" value="" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>NTPN</label>
                                    <input type="text" class="form-control" name="ntpn" id="ntpn" value="" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nilai Pajak</label>
                                    <input type="text" class="form-control amount" name="nilai_pajak" id="nilai_pajak" value="" placeholder="" required>
                                </div>
                            </div>
                            
                            <div class="form-row col-12">
                                <div class="form-group col-md-6">
                                    <label>Upload Foto</label>
                                    <input type="file" class="form-control" name="bukti_pemby" id="bukti_pemby" accept="image/*" onchange="readURL(this);">
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="anticon anticon-undo"></i> Close
                        </button>
                        <button type="submit" id="saveBtn" value="create" class="btn btn-secondary">
                            <i class="fa fa-save"></i>  Simpan
                        </button>
    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

