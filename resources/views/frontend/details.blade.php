@extends('layouts.frontend')

@section('title', 'Details')

@section('content')
<div class="container mt-5">
    <div class="row">
        <h4>
            <span class="details_header">HSC Batch</span>
            <a href="" class="btn btn-info ml-5"><i class="fa fa-download"></i> Download Syllabus</a>
            <button class="button">
                <a href="register.php">Register Now</a>
            </button>
        </h4>
    </div>
    <hr />
    <div class="row row-margin-bottom">
        <div class="col-md-12 no-padding lib-item" data-category="ui">
            <div class="lib-panel">
                <div class="row box-shadow">
                    <div class="col-md-5">
                        <img class="lib-img" src="assets/img/details1.jpg" alt="" />
                    </div>
                    <div class="col-md-7">
                        <div class="lib-row lib-header">
                            <span class="details_header">নিৰ্দেশনাসমূহ</span>
                            <div class="lib-header-seperator"></div>
                        </div>
                        <div class="lib-row lib-desc">
                            <ul style="list-style-type: none" class="details_list">
                                <li>
                                    ১. প্রত্যেকটি পরিক্ষায় ২৩ টি এমসিকিউ থাকবে।
                                    প্রত্যেকটিতে ১ নাম্বার করে থাকবে। ২৩ মিনিট এর ভিতর উত্তর
                                    করতে হবে।
                                </li>
                                <li>
                                    ২. আপনি এক্সাম দু’বার কি পাঁচবারও দিতে পারবেন।কিন্তু
                                    আপনার প্রথমবার দেওয়া এক্সামের নাম্বার গ্রহনযোগ্য হবে।
                                </li>
                                <li>
                                    ৩. মডেল টেস্ট বা অলিম্পিয়াডের এক্সাম হোক অংশগ্রহন করতে
                                    অবশ্যই আপনাকে লগইন করতে হবে।
                                </li>
                                <li>
                                    ৪. রুটিন অনুযায়ী ৪ অধ্যায়ের উপর চারটি মডেল টেস্ট
                                    এক্সাম নেওয়া হবে। ৪ টি এক্সামের সর্বোচ্চ স্কোর যে করবে
                                    তার জন্য রয়েছে একটি মিস্টিরিয়াস বক্স।
                                </li>
                                <li>
                                    ৫.একটি আইডি দিয়ে প্রশ্ন ওপেন করার পর ২৩ মিনিট এর ভিতর
                                    আপনাকে উত্তর করতে হবে।এর পরে উত্তর জমা দিতে পারবেন না
                                    কোনো ভাবেই। সুতরাং একবার প্রশ্ন ওপেন করলে যেভাবেই হোক
                                    আপনাকে এই ২৩ মিনিট এর ভিতর উত্তর করতে হবে।
                                </li>
                                <li>
                                    ৬. মডেল টেস্ট এক্সাম এর প্রশ্ন প্রকাশ হবে দুপুর ১২ টায়।
                                    আর অংশগ্রহণ করার শেষ সময় থাকবে রাত ১২ টা। অলিম্পিয়াডের
                                    প্রশ্ন প্রকাশ হবে ১৩ই জুলাই রাত ৯ টায়। রাত ১২ টা
                                    পর্যন্ত অংশগ্রহন করতে পারবেন।
                                </li>
                            </ul>
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
                                    ১. প্রথমে বিকাশ থেকে 01827816062 এই নাম্বারা এ ২७ টাকা
                                    সেন্ড মানি করতে হবে।একসাথে ২৩ টাকা এর বেশি পাঠালে তা
                                    ডোনেশন হিসেবে নেওয়া হবে।তাই দুজনের রেজিষ্ট্রেশনে দু’বার
                                    সেন্ড মানি করুন।
                                </li>
                                <li>
                                    ২. তারপর ওয়েবসাইটে প্রবেশ করে রেজিষ্ট্রেশন পেইজে গিয়ে
                                    যাবতীয় ইনফরমেশন দিন।কোনো সমস্যা পরলে অবশ্যই পেইজে
                                    যোগায়োগ করুন।
                                </li>
                                <li>
                                    ৩. তারপর ‘জয়েন গ্রুপ’ বাটনে ক্লিক করে আপনার নাম (যেই
                                    নাম ওয়েবসাইটে দিয়েছেন) দিয়ে রিকোয়েস্ট পাঠিয়ে
                                    রাখবেন।১ ঘন্টার ভিতর এপ্রুভ হয়ে যাবে৷
                                </li>
                                <li>৪. গ্রুপে মডেল টেস্ট পরিক্ষার আগে নোট দেওয়া হবে।</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img class="lib-img" src="assets/img/details2.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection