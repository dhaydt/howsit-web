<!-- Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Update Saldo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('saldos.store') }}" method="POST" id="createSaldo">
            {{ csrf_field() }}

        <div class="modal-body">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Select User</label>
                            <select class="form-control" id="user_id" name="input">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}-{{ $user->name }}" id="name">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="saldo">Add Saldo</label>
                    <h5 class="my-0">
                        IDR
                        <input id="saldo" type="number" class="wallet-balance-per-date" name="saldo">
                    </h5>
                </div>

                {{-- <div class="row mb-3">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-success">+</button>
                            </div>
                            <input type="number" name="plus" class="form-control" placeholder="Addition">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-danger">-</button>
                            </div>
                            <input type="number" name="minus" class="form-control" placeholder="Substraction">
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="form-group">
                    <label for="">New Saldo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">IDR</div>
                        </div>
                        <input type="number" name="saldo" class="form-control nominal">
                    </div>
                </div> --}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Save
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $('#user_id').change( function() {
    $(this).find(":selected").each(function () {
        var name['#name'] = $(this).val();
        $('input').val(name);
    });
});
</script>
