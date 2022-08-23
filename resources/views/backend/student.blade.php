@extends('layouts.backend')

@section('title', 'Student')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Student</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Student</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Student</h3>
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

{{-- Add or Update Modal --}}
<div class="modal fade" id="custom_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="custom_form">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter student Name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="clg_name">College Name</label>
                        <input type="text" class="form-control" name="clg_name" id="clg_name"
                            placeholder="Enter college name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="payment_number">Number that you used to payment for exam</label>
                        <input type="text" class="form-control" name="payment_number" id="payment_number"
                            placeholder="Enter number that used to payment" required>
                    </div>
                    <div class="form-group">
                        <label>Select Batch</label>
                        <select class="form-control" name="batch_id" id="batch_id" required>
                            @foreach ($batch as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_btn">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- Add or Update Modal --}}
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
        url: '{{ route('admin.student.fetch') }}',
        method: 'get',
        success: function(response) {
        $("#showData").html(response);
        datatable("#example1")
        }
        });
        }

        $('#create').click(function () {
            $('#save_btn').text("Save");
            $('#id').val('');
            $('#custom_form').trigger("reset");
            $('.modal-title').html("Create New Student");
            $('#custom_modal').modal('show');
        });

        $('#save_btn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        
        $.ajax({
        data: $('#custom_form').serialize(),
        url: "{{ route('student.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
        if(data.status == 200){
            Toast.fire({
                icon: 'success',
                title: 'Data Added Or Updated Succesfully'
            })
            $('#custom_form').trigger("reset");
            $('#custom_modal').modal('hide');
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
        $.get("{{ route('student.index') }}" +'/' + id +'/edit', function (data) {
        $('.modal-title').html("Edit Student");
        $('#save_btn').text("Edit Student");
        $('#custom_modal').modal('show');
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#clg_name').val(data.clg_name);
        $('#phone').val(data.phone);
        $('#payment_number').val(data.payment_number);
        $('#batch_id').val(data.batch_id).trigger('change');
        })
        });

        $("body").on("click", ".dlt", function(e) {
        e.preventDefault();
        id = $(this).attr("id");
        let url = 'student' + '/' + id;
        let csrf = "{{ csrf_token() }}";
        deleteData(url, fetchData);
        });
        

    });
</script>
@endpush