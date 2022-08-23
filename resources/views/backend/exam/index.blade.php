@extends('layouts.backend')

@section('title', 'Exam')

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
                <h1 class="m-0">Exam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Exam</li>
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
                        <h3 class="card-title">Exam</h3>
                        <a href="{{ route('exam.create') }}" class="btn btn-success float-right" id="create"><i
                                class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="showData">
                        @if ($msg = Session::get('success'))
                        @include('partials.success')
                        @endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Batch</th>
                                    <th>Duration</th>
                                    <th>Total Mark</th>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($exams as $ex)
                                <tr>
                                    <td>{{ $ex->title }}</td>
                                    <td>{{ $ex->batch->name }}</td>
                                    <td>{{ $ex->duration }}</td>
                                    <td>{{ $ex->total_marks }}</td>
                                    <td>{{ $ex->total_question }} &nbsp; &nbsp; <a href="#"
                                            class="btn btn-success btn-sm"><i class="fa fa-plus-circle"
                                                aria-hidden="true"></i></a>
                                    </td>
                                    <td>@if ($ex->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Deactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $ex->start_date }}</td>
                                    <td>
                                        <a href="{{ route('exam.edit',$ex->id) }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm dltBtn"
                                            id="{{ $ex->id }}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Batch</th>
                                    <th>Duration</th>
                                    <th>Total Mark</th>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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

<script>
    $(function () {     
        datatable("#example1"); 

        // Delete Data
        $(document).on('click', '.dltBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        let url = 'exam/' + id;
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
        $.ajax({
        url: url,
        method: 'delete',
        data: {
        id: id,
        _token: csrf
        },
        success: function(response) {
        console.log(response);
        Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
        setTimeout(() => {
        window.location = '{{ route('exam.index') }}';
        }, 2000);
        }
        });
        }
        })
        });
        

    });
</script>
@endpush