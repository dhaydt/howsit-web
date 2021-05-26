<script>
    // $(document).ready(function () {
    //     var table = $('#datatable').DataTable();

    //     table.on('click', '.edit', function() {

    //         $tr = $(this).closest('tr');
    //         if ($($tr).hasClass('child')) {
    //             $tr = $tr.prev('parent');
    //         }

    //         var data = table.row($tr).data();
    //         console.log(data);

    //         $('#edit-name').val(data[2]);
    //         $('#edit-email').val(data[3]);
    //         $('#edit-phone').val(data[4]);
    //         $('#edit-role').val(data[5]);

    //         $('#editUser').attr('action', '/users/'+data[1]);
    //         $('#edit-modal').modal('show');
    //     })
    // });
    $(document).ready(function() {
    $('#datatable').DataTable();
} );
</script>
