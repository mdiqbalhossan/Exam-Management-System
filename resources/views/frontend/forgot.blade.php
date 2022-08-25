@extends('layouts.frontend')

@section('title', 'Amuse Exam - Login')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4"></div>
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title text-center mb-4 mt-1">Forgot User Id</h4>
                    <hr />
                    <p class="text-success text-center">
                        ইউজার আইডি উদ্ধার করতে হলে রেজিষ্ট্রেশন এর সময় দেওয়া মোবাইল
                        নাম্বার দিয়ে নিচে সাবমিট করুন।
                    </p>
                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>
                                <input name="" class="form-control" placeholder="Enter your mobile number"
                                    type="text" />
                            </div>
                            <!-- input-group.// -->
                        </div>
                        <!-- form-group// -->

                        <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Submit
                            </button>
                        </div>
                        <!-- form-group// -->
                        <p class="text-center">
                            <a href="login.html" class="">Login?</a>
                        </p>
                    </form>
                </article>
            </div>
            <!-- card.// -->
        </aside>
        <!-- col.// -->
    </div>
    <!-- row.// -->
</div>
<!--container end.//-->
@endsection