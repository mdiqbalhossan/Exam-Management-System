@extends('layouts.frontend')

@section('title', 'Amuse Exam - Note')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            @if (count($notes)>0)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="display: inline;">All Note List</h3>
                    <div class="float-right">
                        <h3 class="badge badge-info p-2 mr-2">{{ $subject->name }}</h3>
                        <h3 class="badge badge-success p-2 mr-2">{{ $class->name }}</h3>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Title</th>
                                <th>demo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notes as $key => $note)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><a href="">{{ $note->title }}</a></td>
                                <td>{{ ($note->demo == null) ? "No demo available" : "<a href=''>".$note->demo."</a>" }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm"><i class="fa fa-download"
                                            aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            @else
            <h4 class="text-danger text-center">No Notes Available Here!</h4>
        </div>
        @endif
    </div>
    <!-- row.// -->
</div>
<!--container end.//-->
@endsection

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush