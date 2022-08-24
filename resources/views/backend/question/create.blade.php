@extends('layouts.backend')

@section('title', 'Question Create')

@push('css')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Question</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Create Question</li>
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
                        <h3 class="card-title">Create Question</h3>
                        <strong class="ml-5">Total Question: </strong><span class="badge badge-lg badge-success ml-2">{{
                            $total_question
                            }}</span>
                        <a href="{{ route('question.index',Session::get('exam_id')) }}"
                            class="btn btn-success float-right" id="create"><i class="fa fa-step-backward"
                                aria-hidden="true"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('question.store') }}">
                        @csrf
                        <div class="card-body">
                            @include('partials.error')
                            @if ($msg = Session::get('success'))
                            @include('partials.success')
                            @endif
                            <div class="form-group">
                                <label>Question:</label>
                                <textarea id="question" name="question"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Option 1:</label>
                                        <textarea id="option1" name="options[]"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Option 2:</label>
                                        <textarea id="option2" name="options[]"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Option 3:</label>
                                        <textarea id="option3" name="options[]"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Option 4:</label>
                                        <textarea id="option4" name="options[]"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group clearfix">
                                        <label for="">Correct Answer</label>
                                        <div class="icheck-primary">
                                            <input type="radio" value="1" id="radioPrimary1" name="correct_answer">
                                            <label for="radioPrimary1">Option 1
                                            </label>
                                        </div>
                                        <div class="icheck-primary">
                                            <input type="radio" value="2" id="radioPrimary2" name="correct_answer">
                                            <label for="radioPrimary2">Option 2
                                            </label>
                                        </div>
                                        <div class="icheck-primary">
                                            <input type="radio" value="3" id="radioPrimary3" name="correct_answer">
                                            <label for="radioPrimary3">Option 3
                                            </label>
                                        </div>
                                        <div class="icheck-primary">
                                            <input type="radio" value="4" id="radioPrimary4" name="correct_answer">
                                            <label for="radioPrimary4">Option 4
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Answer:</label>
                                        <textarea id="answer" name="answer"></textarea>
                                    </div>
                                </div>
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
<script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>

<script>
    $(function () {
        var config = {
        height:'100',
        toolbarGroups:[
        { name: "insert" },
        { name: "basicstyles", groups: ["basicstyles"] },
        ]
        };

        var config1 = {
            height: '50',
        };
        CKEDITOR.replace( 'question',config1);
        CKEDITOR.replace( 'answer',config1);
        CKEDITOR.replace('option1', config);
        CKEDITOR.replace('option2', config);
        CKEDITOR.replace('option3', config);
        CKEDITOR.replace('option4', config);
    });
</script>
@endpush