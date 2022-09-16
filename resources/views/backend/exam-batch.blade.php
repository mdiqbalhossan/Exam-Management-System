@extends('layouts.backend')

@section('title', 'Exam Batch')

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
                <h1 class="m-0">Exam Batch</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Exam Batch</li>
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
                        <h3 class="card-title">Exam Batch</h3>
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
                        <label for="batch_name">Batch Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Batch Name"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" id="description" name="description"
                            placeholder="Enter Description" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Exam Start Date</label>
                                <input type="date" class="form-control" name="exam_start_date" id="exam_start_date"
                                    placeholder="Enter Exam Start Date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Exam Validate For <span class="text-danger">(In Days)</span></label>
                                <input type="text" class="form-control" name="exam_validate" id="exam_validate"
                                    placeholder="30" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="active">Active</option>
                                    <option value="deactive">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Group</label>
                                <select class="form-control" name="group" id="group" required>
                                    <option value="science">Science</option>
                                    <option value="humanities">Humanities</option>
                                    <option value="business_studies">Business Studies</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam_fees">Exam Fees</label>
                                <input type="number" class="form-control" name="exam_fees" id="exam_fees"
                                    placeholder="Enter Exam Fees" required>
                            </div>
                        </div>
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
<!-- Summernote -->
<script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>

<script>
    $(function () {     
        $('#description').summernote({
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman',
        'Verdana', "Noto Serif Bengali"],
        fontNamesIgnoreCheck: ["Noto Serif Bengali"]
        });
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchData();
        function fetchData(){
        $.ajax({
        url: '{{ route('admin.exam-batches.fetch') }}',
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
            $('.modal-title').html("Create New Batch");
            $('#custom_modal').modal('show');
            $('#description').summernote('reset');;
        });

        $('#save_btn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        
        $.ajax({
        data: $('#custom_form').serialize(),
        url: "{{ route('exam-batches.store') }}",
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
        $.get("{{ route('exam-batches.index') }}" +'/' + id +'/edit', function (data) {
        $('.modal-title').html("Edit Batch");
        $('#save_btn').text("Edit Data");
        $('#custom_modal').modal('show');
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#description').summernote('editor.pasteHTML', data.description);
        // $ ('#description').code();
        $('#exam_start_date').val(data.exam_start_date);
        $('#exam_validate').val(data.exam_validate);
        $('#status').val(data.status).trigger('change');
        $('#group').val(data.group).trigger('change');
        $('#exam_fees').val(data.exam_fees);
        })
        });

        $("body").on("click", ".dlt", function(e) {
        e.preventDefault();
        id = $(this).attr("id");
        let url = 'exam-batches' + '/' + id;
        let csrf = "{{ csrf_token() }}";
        deleteData(url, fetchData);
        });
        

    });
</script>
@endpush