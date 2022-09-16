@extends('layouts.frontend')

@section('title','Succesfully Done')

@section('content')
<div class="container">
    <div class="row text-center justify-content-md-center">
        <div class="col-sm-6">
            <br><br>
            <h2 style="color:#0fad00">Success</h2>
            <img src="{{ asset('frontend/img/checkbox.png') }}" width="64px">
            <h3>Dear, {{ Auth::user()->name }}</h3>
            <p style="font-size:20px;color:#5C5C5C;">ধন্যবাদ পরিক্ষায় অংশগ্রহন করার জন্য। নির্দিষ্ট সময় পরে মোবাইলে
                এসএমএস এর মাধ্যমে অথবা ওয়েবসাইটের মাধ্যমে ফলাফল জানতে পারবে। এবং ওয়েবসাইট থেকে প্রশ্নের উত্তর এর
                ব্যাখ্যা সহ ফলাফল দেখতে পারবে।</p>
            <a href="{{ route('home') }}" class="btn btn-success">     Home     </a>
            <br><br>
        </div>

    </div>
</div>
@endsection