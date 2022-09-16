@extends('layouts.frontend')

@section('title', Str::ucfirst($exam_batch->name) .'-'. Str::ucfirst($exam_batch->group))

@section('content')
<div class="container mt-5">
    <div class="row">
        <h4>
            <span class="details_header">{{ Str::ucfirst($exam_batch->name) }} {{ Str::ucfirst($exam_batch->group)
                }}</span>
            <a href="" class="btn btn-info ml-5"><i class="fa fa-download"></i> Download Syllabus</a>
            <button class="button">
                <a href="{{ route('user.register') }}">Register Now</a>
            </button>
        </h4>
    </div>
    <hr />
    <div class="row row-margin-bottom">
        <div class="col-md-12 no-padding lib-item" data-category="ui">
            <div class="lib-panel">
                <div class="row box-shadow">
                    <div class="col-md-5">
                        <img class="lib-img" src="{{ asset('frontend/img/details1.jpg') }}" alt="" />
                    </div>
                    <div class="col-md-7">
                        <div class="lib-row lib-header">
                            <span class="details_header">নিৰ্দেশনাসমূহ</span>
                            <div class="lib-header-seperator"></div>
                        </div>
                        <div class="lib-row lib-desc">
                            {!! $exam_batch->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 no-padding lib-item" data-category="ui">
            <div class="lib-panel">
                <div class="row box-shadow">
                    <div class="col-md-7">
                        <div class="lib-row lib-header">
                            <span class="details_header">পেমেন্ট সংক্রান্ত</span>
                            <div class="lib-header-seperator"></div>
                        </div>
                        <div class="lib-row lib-desc">
                            <ul style="list-style-type: none" class="details_list">
                                <li>
                                    ১. প্রথমে বিকাশ থেকে 01679487265 এই নাম্বারা এ {{ $exam_batch->exam_fees }} টাকা
                                    সেন্ড মানি করতে হবে।একসাথে {{ $exam_batch->exam_fees }} টাকা এর বেশি পাঠালে তা
                                    ডোনেশন হিসেবে নেওয়া হবে।তাই দুজনের রেজিষ্ট্রেশনে দু’বার
                                    সেন্ড মানি করুন।
                                </li>
                                <li>
                                    ২. তারপর ওয়েবসাইটে প্রবেশ করে রেজিষ্ট্রেশন পেইজে গিয়ে
                                    যাবতীয় ইনফরমেশন দিন।কোনো সমস্যা পরলে অবশ্যই পেইজে
                                    যোগায়োগ করুন।
                                </li>
                                <li>
                                    ৩. তারপর আমাদের পেইজে বা আমাদের আইডি তে মেসেজ দিয়ে
                                    রাখবেন। ১ ঘন্টার ভিতর প্রাইভেট গ্রুপ এ এড করা হবে।
                                </li>
                                <li>৪. গ্রুপে এবং ওয়েবসাইট এর Dashboard এ পরিক্ষার আগে নোট দেওয়া হবে।</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img class="lib-img" src="{{ asset('frontend/img/details2.jpg') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection