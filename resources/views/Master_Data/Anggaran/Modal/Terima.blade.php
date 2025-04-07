
<div class="modal fade bd-example-modal-sm" id="editterima_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">

                <form id="userFormterima" name="userFormterima" enctype="multipart/form-data">
                    {{-- @method('get') --}}
                    @csrf
                  <div class="card">
                    <h5 class="modal-title text-centre">Anda Yakin !!</h5>
                    <div class="card-body flex flex-col p-6">
                      <div class="card-text h-full space-y-4">
    
                          <div class="input-area">
                              <label class="form-label">id</label>
                              <input name="id" type="text" class="form-control" id="id1" readonly>
                          </div>
    
                          <div class="input-area">
                              <label class="form-label">E-Billing</label>
                              <input name="ebilling" type="text" class="form-control" id="ebilling1" readonly>
                          </div>
    
                          <div class="input-area">
                              <label class="form-label">NTPN</label>
                              <input name="ntpn" type="text" class="form-control" id="ntpn1" readonly>
                          </div>
    
                      </div>
                    </div>
                  </div>
                  
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" id="saveBtnterima" value="create" class="btn btn-secondary">
                    <i class="anticon anticon-like"></i>  Terima
                </button>
              </div>
            </form>

            </div>
        </div>
    </div>
</div>
