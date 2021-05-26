<!-- Modal -->
<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="showSaldo">
                {{ csrf_field() }}
                {{-- <input type="hidden" name="user_id" value=""> --}}

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="my-0 text-capitalize" id="show-name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="hidden" data-mask="0000-00-00" class="form-control flatpickr-input"
                                data-balance-date="1" data-max-date="{{ null }}" data-picker="1" id="input-date" value="{{ null }}">
                            <input type="text" class="form-control input" value="{{ date('d / m / Y  H:i:s') }}" tab-index="0" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <h5 class="my-0">
                        {{-- <span balance="{{ null }}" class="wallet-balance-per-date">{{ $saldo->user->email }}</span> --}}
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

                <div class="form-group">
                    <label for="">Saldo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">IDR</div>
                        </div>
                        <input type="number" name="nominal" id="show-saldo" class="form-control nominal">
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            Update Saldo
        </button> --}}
        </div>
      </div>
    </div>
  </div>

  <script>
    // $(document).ready(function () {
    //     var table = $('#datatable').DataTable();

    //     table.on('click', '.show', function() {

    //         $tr = $(this).closest('tr');
    //         if ($($tr).hasClass('child')) {
    //             $tr = $tr.prev('parent');
    //         }

    //         var data = table.row($tr).data();
    //         console.log(data);

    //         $('#show-name').val(data[2]);
    //         $('#show-saldo').val(data[3]);

    //         // $('#showSaldo').attr('action', '/saldos/'+data[1]);
    //         // $('#edit-modal').modal('show');
    //     })
    // });
  </script>
