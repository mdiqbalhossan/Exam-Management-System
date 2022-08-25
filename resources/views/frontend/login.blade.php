@extends('layouts.frontend')

@section('title', 'Amuse Exam - Login')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4"></div>
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
                    <hr>
                    @include('partials.error')
                    <hr />
                    <p class="text-success text-center">
                        রেজিষ্ট্রেশন করার পরে প্রাপ্ত ইউজার আইডি দিয়ে লগইন করুন। ইউজার
                        আইডি ভূলে গেলে "Forgot User Id" এই লিংকে ক্লিক করুন।
                    </p>
                    <form action="{{ route('user.login.post') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input name="user_id" class="form-control" placeholder="Enter your Id" type="text" />
                            </div>
                            <!-- input-group.// -->
                        </div>
                        <!-- form-group// -->

                        <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Login
                            </button>
                        </div>
                        <!-- form-group// -->
                        <p class="text-center">
                            <a href="forgot.html" class="">Forgot User Id?</a>
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