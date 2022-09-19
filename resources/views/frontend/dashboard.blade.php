@extends('layouts.frontend')

@section('title', 'Dashboard')

@section('content')
<div class="container my-5">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin"
                                class="rounded-circle p-1 bg-primary" width="110" />
                            <div class="mt-3">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p class="text-success mb-1">User Id: {{ Auth::user()->user_id }}</p>
                                <p class="text-success mb-1">
                                    College Name: {{ Auth::user()->clg_name }}
                                </p>
                                <p class="text-success mb-1">
                                    Phone Name: {{ Auth::user()->phone }}
                                </p>
                                @if (Auth::user()->status === 'accepted')
                                <p class="text-success mb-1">
                                    Status: {{ 'Accepted' }}
                                </p>
                                @elseif(Auth::user()->status == 'pending')
                                <p class="text-warning mb-1">
                                    Status: {{ 'Pending' }}
                                </p>
                                @else
                                <p class="text-danger mb-1">
                                    Status: {{ 'Cancelled' }}
                                </p>
                                @endif

                                <p class="text-success mb-1">
                                    Batch Name: {{ Auth::user()->batch->name}}
                                </p>

                            </div>
                        </div>
                        <hr class="my-4" />
                        <button class="btn btn-primary btn-block">Update Profile</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">

                <div class="row">
                    @if(Auth::user()->status != 'accepted')
                    <div class="alert alert-danger">
                        <p>আপনার একাউন্ট এখনো Approve হয়নাই। পেমেন্ট স্টাটাস সঠিক হলে আমাদের এডমিন ২৪ ঘন্টার মধ্যেই
                            আপনার একাউন্ট Approve করে দিবেন।</p>
                        <p>পেমেন্ট স্টাটাস সঠিক হওয়ার পরেও ২৪ ঘন্টার মধ্যে Approve না হলে Contact সেকশান এ দেওয়া নাম্বার
                            এ যোগাযোগ করার জন্য অনুরোধ করা হইলো।</p>
                    </div>
                    @else
                    @if ($exams->count()>0)
                    @foreach ($exams as $exam)
                    <div class="col-xl-6 col-md-12">
                        <div class="card-content">
                            <div class="card-desc">
                                <h3>{{ $exam->title }}</h3>
                                <hr>
                                <p>
                                <div class="well" style="max-height: 300px;overflow: auto;">
                                    <ul class="list-group checked-list-box">
                                        <li class="list-group-item">Exam Type: {{ $exam->type }}</li>
                                        <li class="list-group-item">Exam Duration: {{ $exam->duration }}</li>
                                        <li class="list-group-item">Total Question: {{ $exam->total_question }}</li>
                                        <li class="list-group-item">Total Mark: {{ $exam->total_marks }}</li>
                                        <li class="list-group-item">Negative Mark: {{ $exam->negetive_marks }}</li>
                                        <li class="list-group-item">Passed Mark: {{ $exam->pass_parcentage }}</li>
                                        <li class="list-group-item">Start Exam: {{
                                            \Carbon\Carbon::parse($exam->start_date)->format('d-M-Y h:m:i')}}</li>
                                        <li class="list-group-item">End Exam: {{
                                            \Carbon\Carbon::parse($exam->end_date)->format('d-M-Y h:m:i')}}</li>
                                    </ul>
                                </div>
                                </p>
                                @php
                                $answer =
                                DB::table('answers')->where('user_id',Auth::user()->id)->where('exam_id',$exam->id)->first();
                                Helper::checkStartDate($exam->start_date)
                                @endphp
                                <h4 class="text-center text-secondary" id="countdown"></h4>
                                @if (!isset($answer) && Helper::checkStartDate($exam->start_date))
                                <a href="{{ route('exam',$exam->id) }}" id="start_btn" class="btn-card"
                                    style="display: none">Start Exam</a>
                                @elseif (!Helper::checkEndDate($exam->end_date))
                                <a href="{{ route('view.user.result',$exam->id) }}" class="btn-card">View Result</a>
                                @else
                                <span class="text-info">You already gave exam. Please wait for result until end
                                    exam.</span>
                                @endif

                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-danger">
                        <p>এখনো পরিক্ষা শুরু হইয়নাই, অথবা আপনি যে ব্যাচ এ রেজিষ্টেশন করেছেন এই ব্যাচ এ এই মুহূর্তে কোন
                            পরিক্ষা Available না।</p>
                        <p>অপেক্ষা করুন আমাদের এডমিন বিস্তারিত জানিয়ে দিবেন।</p>
                    </div>
                    @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    @if (Auth::user()->status == 'accepted')       
    
    var countdown = new Date("{{ Helper::getStartDate() }}").getTime();
    var x = setInterval(() => {
        var now = new Date().getTime();
        var distance = countdown - now;
        var days = Math.floor(distance/(1000*60*60*24));
        var hours = Math.floor((distance%(1000*60*60*24))/(1000*60*60));
        var minutes = Math.floor((distance%(1000*60*60))/(1000*60));
        var seconds = Math.floor((distance%(1000*60))/1000);
        document.getElementById("countdown").innerHTML = days + "Day : " + hours + "h " +
        minutes + "m " + seconds + "s ";
        // If the count down is over, write some text
        if (distance < 0) { clearInterval(x); document.getElementById("countdown").style.display = "none" ;document.getElementById("start_btn").style.display = "block" }
    }, 1000);
    @endif
</script>
@endpush