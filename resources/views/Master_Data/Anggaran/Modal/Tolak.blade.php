
<div class="modal fade bd-example-modal-sm" id="edittolak_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">

                <form id="userFormtolak" name="userFormtolak" enctype="multipart/form-data">
                    {{-- @method('get') --}}
                    @csrf
                  <div class="card">
                    <h5 class="modal-title text-centre">Anda Yakin !!</h5>
                    <div class="card-body flex flex-col p-6">
                      <div class="card-text h-full space-y-4">
    
                          <div class="input-area">
                              <label class="form-label">id</label>
                              <input name="id" type="text" class="form-control" id="id" readonly>
                          </div>
    
                          <div class="input-area">
                              <label class="form-label">E-Billing</label>
                              <input name="ebilling" type="text" class="form-control" id="ebilling" readonly>
                          </div>
    
                          <div class="input-area">
                              <label class="form-label">NTPN</label>
                              <input name="ntpn" type="text" class="form-control" id="ntpn" readonly>
                          </div>
    
                      </div>
                    </div>
                  </div>
                  
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" id="saveBtntolak" value="create" class="btn btn-danger">
                    <i class="anticon anticon-dislike"></i>  Tolak
                </button>
              </div>
            </form>

            </div>
        </div>
    </div>
</div>
