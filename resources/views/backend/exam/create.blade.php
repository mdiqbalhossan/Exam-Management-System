@extends('layouts.backend')

@section('title', 'Exam Create')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/datetimepicker-master/jquery.datetimepicker.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.css">
@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Exam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Create Exam</li>
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
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Create Exam</h3>
                        <a href="{{ route('exam.create') }}" class="btn btn-success float-right" id="create"><i
                                class="fa fa-step-backward" aria-hidden="true"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('exam.store') }}">
                        @csrf
                        <div class="card-body">
                            @include('partials.error')
                            <div class="form-group">
                                <label for="exam_title">Exam Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter exam title">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Batch</label>
                                        <select class="form-control" name="batch_id">
                                            @foreach($batches as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Type</label>
                                        <select class="form-control" name="type">
                                            <option value="Combined Exam">Cobined Exam</option>
                                            <option value="Chapter Wise Exam">Chapter Wise Exam</option>
                                            <option value="Subject Wise Exam">Subject Wise Exam</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Exam Type</label>
                                        <select class="form-control" name="exam_type">
                                            <option value="Paid">Paid</option>
                                            <option value="Free">Free</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exam_title">Exam Duration (In Minute)</label>
                                        <input type="number" class="form-control" name="duration"
                                            placeholder="Enter exam duration">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exam_title">Total Marks</label>
                                        <input type="number" class="form-control" name="total_marks"
                                            placeholder="Enter total marks">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exam_title">Total Question</label>
                                        <input type="number" class="form-control" name="total_question"
                                            placeholder="Enter Total Question">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exam_title">Negetive marks (In Parcentage)</label>
                                        <input type="number" class="form-control" name="negetive_marks"
                                            placeholder="Enter negetive marks">
                                        <span class="text-danger">If no negative marks. Leave blank this field.</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exam_title">Pass Marks (In Parcentage)</label>
                                        <input type="number" class="form-control" name="pass_percentage"
                                            placeholder="Enter passed Marks">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Exam Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date and time:</label>
                                        <input type="text" class="form-control" name="start_date" id="start_date"
                                            placeholder="Enter start date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date and time:</label>
                                        <input type="text" class="form-control" name="end_date" id="end_date"
                                            placeholder="Enter end date">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea id="summernote" name="description">
                                                Place <em>some</em> <u>text</u> <strong>here</strong>
                                              </textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('backend/plugins/datetimepicker-master/build/jquery.datetimepicker.full.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
        $('#start_date').datetimepicker();
        $('#end_date').datetimepicker();
        $('#summernote').summernote()
    });
</script>
@endpush