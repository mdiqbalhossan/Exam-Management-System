@extends('layouts.frontend')

@section('title', 'Exam')
@push('css')
<style>
    label {
        display: -webkit-inline-box;
        padding: 0px;
        position: relative;
        padding-left: 20px;
    }

    input[type="radio"] {
        width: 30px;
        height: 30px;
        border-radius: 15px;
        border: 2px solid #1fbed6;
        background-color: white;
        -webkit-appearance: none;
        /*to disable the default appearance of radio button*/
        -moz-appearance: none;
    }

    input[type="radio"]:focus {
        /*no need, if you don't disable default appearance*/
        outline: none;
        /*to remove the square border on focus*/
    }

    input[type="radio"]:checked {
        /*no need, if you don't disable default appearance*/
        background-color: #1fbed6;
    }

    input[type="radio"]:checked~span:first-of-type {
        color: white;
    }

    label strong:first-of-type {
        position: relative;
        left: -22px;
        top: -9px;
        font-size: 15px;
        color: #1fbed6;
    }

    label strong {
        position: relative;
        top: -12px;
    }


    .icon-result {
        position: relative;
        top: -12px;
        left: 10px;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <div class="card border border-info" id="exam">
        <div class="card-header border-bottom border-info fixed">
            <h3>
                {{ $exam->title }}<strong id="timer" class="float-right"></strong>
            </h3>
        </div>
        <form action="{{ route('exam.result.store', $exam->id) }}" id="question_form" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
            <div class="card-body">
                @if ($question)
                @php
                $i = 1
                @endphp
                @foreach ($question as $val)

                @php
                $options = json_decode($val->options);
                $label = ['ক','খ','গ','ঘ'];
                @endphp

                <div class="question d-flex">
                    {{ $i++ }}. {!! $val['question'] !!}
                </div>
                @foreach ($options as $key=>$option)
                <label for="">
                    <input type="radio" value="{{ $key+1 }}" name="{{ $val->id }}">
                    <strong>{{ $label[$key] }}</strong>
                    {!! $option !!}
                </label><br>
                @endforeach
                @endforeach
                @else
                <h1 class="text-danger text-center">You have no question.</h1>
                @endif
            </div>
            <div class="card-footer border-top border-info">
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
                <input type="submit" value="Finish Exam" class="btn btn-info float-right" id="question_submit_btn">
                <!-- <a href="exam.php" class="btn btn-info float-right">Finish Exam</a> -->
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    var duration = '{{ $exam->duration }}';
        var c = 60 * duration;
        var t;
        timedCount();
    
        function timedCount() {
            var hours = parseInt(c / 3600) % 24;
            var minutes = parseInt(c / 60) % 60;
            var seconds = c % 60;
    
            var result =
            (hours < 10 ? "0" + hours : hours) +
            ":" +
            (minutes < 10 ? "0" + minutes : minutes) +
            ":" +
            (seconds < 10 ? "0" + seconds : seconds);
    
            $("#timer").html(result);
            if (c == 0) {
                $.ajax({
                    type: "POST",
                    url: "lib/action.php",
                    data: $("#question_form").serialize() + "&action=submit_question",
                    success: function(response) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "ধন্যবাদ। রাত ১০ টায় ওয়েবসাইট এ রেজাল্ট প্রকাশ করা হবে।",
                            showConfirmButton: false,
                            timer: 3000
                        });                    
                        setTimeout(() => {
                            window.location = "index.php";
                        }, 3000);
                    }
                });            
            }
            c = c - 1;
            t = setTimeout(function() {
            timedCount();
            }, 1000);
      }
</script>
@endpush