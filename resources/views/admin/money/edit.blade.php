<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Money Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/money/{{ $mon->id ?? 0 }}" method="POST" id="editMoney" name="bene" oninput="calculate()">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">

                    {{-- <input type="hidden" name="user_id" id="edit-id" value=""> --}}

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Money Name</label>
                                <input class="my-0 text-capitalize" id="edit-name"
                                    style="border: none; background-color: transparent;" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="hidden" data-mask="0000-00-00" class="form-control flatpickr-input"
                                    data-balance-date="1" data-max-date="{{ null }}" data-picker="1" id="input-date"
                                    value="{{ null }}">
                                <input type="text" class="form-control input" value="{{ date('d / m / Y  H:i:s') }}"
                                    tab-index="0" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Old Money</label>
                        <h5 class="my-0">
                            USD
                            <input id="edit-money" class="wallet-balance-per-date"
                                style="border: none; background-color: transparent;" name="oldmoney">
                        </h5>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-success" disabled>+</button>
                                </div>
                                <input type="number" name="plus" class="form-control" placeholder="Addition">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-danger" disabled>-</button>
                                </div>
                                <input type="number" name="minus" class="form-control" placeholder="Substraction">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">New Money</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">USD</div>
                            </div>
                            <input type="number" name="money" id="newmoney" class="form-control money" readonly>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-save">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Update Money
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var form = document.forms.bene,
        old = form.oldmoney,
        add = form.plus,
        min = form.minus,
        output = form.money;

    window.calculate = function () {
        var q = parseInt(old.value, 10) || 0,
            c = parseFloat(add.value) || 0;
            m = parseFloat(min.value) || 0;
        output.value = (q + c - m);
    };


    $(document).ready(function () {
        var table = $('#moneytable').DataTable({

        });

        table.on('click', '.edit', function() {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#edit-name').val(data[2]);
            $('#edit-money').val(data[3]);
            // $('#edit-id').val(data[1]);

            $('#editMoney').attr('action', '/money/'+data[1]);
            $('#edit-modal').modal('show');
        })
    });
</script>