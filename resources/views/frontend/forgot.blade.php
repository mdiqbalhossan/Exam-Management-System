@extends('layouts.frontend')

@section('title', 'Amuse Exam - Login')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4"></div>
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body" id="after_submit" style="display: none;">
                    <h2>অভিনন্দন!</h2>
                    <p>আপনার নামঃ <span id="name"></span></p>
                    <p>আপনার ইউজার আইডিঃ <span id="user_id"></span></p>

                    <p class="text-center">
                        Please Click Here For Login <a href="{{ route('user.login') }}" class="">Login?</a>
                    </p>
                </article>
                <article class="card-body" id="forgot_form">
                    <h4 class="card-title text-center mb-4 mt-1">Forgot User Id</h4>
                    <hr />
                    <p class="text-success text-center">
                        ইউজার আইডি উদ্ধার করতে হলে রেজিষ্ট্রেশন এর সময় দেওয়া মোবাইল
                        নাম্বার দিয়ে নিচে সাবমিট করুন।
                    </p>
                    <form id="forgot">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>
                                <input name="phone" class="form-control" placeholder="Enter your mobile number"
                                    type="text" />
                            </div>
                            <span class="text-danger" id="phone"></span>
                            <!-- input-group.// -->
                        </div>
                        <!-- form-group// -->

                        <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" id="forgot_btn" class="btn btn-primary btn-block">
                                Submit
                            </button>
                        </div>
                        <!-- form-group// -->
                    </form>
                    <p class="text-center">
                        <a href="{{ route('user.login') }}" class="">Login?</a>
                    </p>
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

@push('js')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        // Register
        $("#forgot_btn").click(function (e) { 
            e.preventDefault();
            $(this).html('Sending...');
            $.ajax({
                type: "POST",
                url: "{{ route('user.forgot.post') }}",
                data: $("#forgot").serialize(),
                success: function (response) {
                    $("#forgot_form").hide();
                    $("#after_submit").show();
                    $("#name").html(response.name);
                    $("#user_id").html(response.user_id);
                    console.log(response);
                },
                error: function (data) {
                    $("#forgot_btn").html('Sign Up');
                    data = JSON.parse(data.responseText)
                    $("#error").show();
                    $("#error").html(data.message);
                    if(data.errors.phone != undefined){
                        $("#phone").text(data.errors.phone)
                    }                    
                    console.log('Error:', data.errors);
                }
            });
        });
    });
</script>
@endpush