<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laravel 10 Ajax DataTables CRUD (Create Read Update and Delete) - Cairocoders</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" >
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<link  href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 10 Ajax DataTables CRUD (Create Read Update and Delete) </h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Pegawai</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card-body">
        <table class="table table-bordered" id="ajax-crud-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Created at</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
 
<!-- boostrap employee model -->
<div class="modal fade" id="pegawai-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="PegawaiForm" name="PegawaiForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Address" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10"><br/>
                        <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- end bootstrap model -->
<script type="text/javascript">
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
    $('#ajax-crud-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('ajax-crud-datatable') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama_pegawai', name: 'nama_pegawai' },
            { data: 'email', name: 'email' },
            { data: 'alamat', name: 'alamat' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false},
        ],
        order: [[0, 'desc']]
    });
});
 
function add(){
    $('#PegawaiForm').trigger("reset");
    $('#PegawaiModal').html("Add Pegawai");
    $('#pegawai-modal').modal('show');
    $('#id').val('');
}   
     
function editFunc(id){
    $.ajax({
        type:"POST",
        url: "{{ url('edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#PegawaiModal').html("Edit Pegawai");
            $('#pegawai-modal').modal('show');
            $('#id').val(res.id);
            $('#nama_pegawai').val(res.nama_pegawai);
            $('#alamat').val(res.alamat);
            $('#email').val(res.email);
        }
    });
}  
 
function deleteFunc(id){
    if (confirm("Delete Record?") == true) {
        var id = id;
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('delete') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
            }
        });
    }
}
 
$('#PegawaiForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "{{ url('store')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            $("#pegawai-modal").modal('hide');
            var oTable = $('#ajax-crud-datatable').dataTable();
            oTable.fnDraw(false);
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
        },
        error: function(data){
            console.log(data);
        }
    });
});
</script>
</body>
</html>