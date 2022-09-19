@extends('layouts.backend')

@section('title', 'Student Class')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.css">
@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Student Class</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">StudentClass</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Student Class Add</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="" method="post" id="custom_form">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name">Class Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter class Name" required>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" id="save_btn">Save changes</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Student Class</h3>
                        <a href="#" class="btn btn-success float-right" id="create"><i class="fa fa-plus-circle"
                                aria-hidden="true"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="showData">

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('backend') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('backend') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>

<script>
    $(function () {     
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchData();
        function fetchData(){
        $.ajax({
        url: '{{ route('admin.class.fetch') }}',
        method: 'get',
        success: function(response) {
        $("#showData").html(response);
        // datatable("#example1")
        }
        });
        }

        $('#create').click(function () {
            $('#save_btn').text("Save");
            $('#id').val('');
            $('#custom_form').trigger("reset");
            $('.card-title').html("Student Class Add");          
        });

        $('#save_btn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        
        $.ajax({
        data: $('#custom_form').serialize(),
        url: "{{ route('classes.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
        if(data.status == 200){
            Toast.fire({
                icon: 'success',
                title: 'Data Added Or Updated Succesfully'
            })
            $('#custom_form').trigger("reset");
            fetchData();
        }
        
        },
        error: function (data) {
        console.log('Error:', data);
        $('#save_btn').html('Save Changes');
        }
        });
        });

        $('body').on('click', '.edit', function () {
        var id = $(this).attr('id');
        $.get("{{ route('classes.index') }}" +'/' + id +'/edit', function (data) {
        $('.card-title').html("Edit Student Class");
        $('#save_btn').text("Edit Data");
        $('#id').val(data.id);
        $('#name').val(data.name);
        })
        });

        $("body").on("click", ".dlt", function(e) {
        e.preventDefault();
        id = $(this).attr("id");
        let url = 'classes' + '/' + id;
        let csrf = "{{ csrf_token() }}";
        deleteData(url, fetchData);
        });
        

    });
</script>
@endpush