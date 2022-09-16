@extends('layouts.frontend')

@section('title', 'Amuse Exam - Registration')

@section('content')
<div class="container h-100 mb-5 register">
    <div class="row h-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
                <div class="text-center mt-4" id="info_text">
                    <h1 class="h2">Get started</h1>
                    <p class="lead text-secondary">
                        প্রত্যেকটি ঘর অবশ্যই আপনাকে পূরণ করতে হবে। "Contact Number"
                        Field এ আপনার মোবাইল নাম্বার দিতে হবে এই নাম্বার এ মেসেজ এর
                        মাধ্যমে আপনাকে পরিক্ষার রুটিন এবং তারিখ জানিয়ে দেওয়া হবে।
                        এমনকি ঠিক নিচের ঘরে আপনি যে নাম্বার থেকে পেমেন্ট সম্পন্ন
                        করেছেন নাম্বার টি দিতে হবে। ভূল নাম্বার প্রদান করলে
                        রেজিষ্ট্রেশন সম্পন্ন হবে না।
                    </p>
                    <hr />
                    <p>
                        <span>If you already Register. Please Click
                            <a href="{{ route('user.login') }}">here</a>
                        </span>
                    </p>
                    <hr>
                    <div class="alert alert-danger" id="error" style="display: none;"> </div>
                </div>

                <div class="card my-5" id="after_register" style="display: none;">
                    <div class="card-body">
                        <p>ধন্যবাদ আপনার রেজিষ্ট্রেশান সাকসেসফুলি কম্পিলিট হয়েছে</p>
                        <p>আপনার ইউজার আইডিঃ- <span id="user_id" class="text-success font-weight-bold"></span></p>
                        <p>আপনার পেমেন্ট নাম্বার চেক করে আমাদের এডমিন আপনার এনরোল এপ্রোভ করলেই আপনি পরিক্ষার
                            অংশগ্রহন
                            করতে পারবেন। লগইন করতে নিচের "Login" বাটনে ক্লিক করুন। উপরে দেওয়া ইউজার আইডি দিয়ে লগ ইন
                            করতে
                            পারবেন।</p>
                    </div>
                    <div class="card-footer">
                        <p>Please Click Here <a href="{{ route('user.login') }}" class="btn btn-info btn-sm">Login</a>
                        </p>
                    </div>
                </div>

                <div class="card" id="register_form">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <form method="POST" id="register">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control form-control-lg" type="text" name="name"
                                        placeholder="Enter your name" />
                                    <span class="text-danger" id="name"></span>
                                </div>
                                <div class="form-group">
                                    <label>College Name</label>
                                    <input class="form-control form-control-lg" type="text" name="clg_name"
                                        placeholder="Enter your College name" id="" />
                                    <span class="text-danger" id="clg_name"></span>
                                </div>
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input class="form-control form-control-lg" type="text" name="phone"
                                        placeholder="Enter contact number" id="" />
                                    <span class="text-danger" id="phone"></span>
                                </div>
                                <div class="form-group">
                                    <label>Number that you used to payment for register</label>
                                    <input class="form-control form-control-lg" type="text" name="payment_number"
                                        placeholder="Enter number that you used to payment" id="" />
                                    <span class="text-danger" id="payment_number"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Batch</label>
                                            <select class="form-control form-control-lg" name="batch_id" id="">
                                                <?php foreach($category as $cat): ?>
                                                <option value="<?= $cat['id'] ?>">
                                                    <?= $cat['name'] ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="text-danger" id="batch_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Group</label>
                                            <select class="form-control form-control-lg" name="group" id="">
                                                <option value="science">Science</option>
                                                <option value="humanities">Humanities</option>
                                                <option value="business_studies">Business Studies</option>
                                            </select>
                                            <span class="text-danger" id="group_name"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <!-- <a href="index.html" class="btn btn-lg btn-primary"
                      >Sign up</a
                    > -->
                                    <button type="submit" id="register_btn" class="btn btn-lg btn-primary">Sign
                                        up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
        $("#register_btn").click(function (e) { 
            e.preventDefault();
            $(this).html('Sending...');
            $.ajax({
                type: "POST",
                url: "{{ route('user.register.post') }}",
                data: $("#register").serialize(),
                success: function (response) {
                    $("#register_form").hide();
                    $('#info_text').hide();
                    $("#after_register").show();
                    $("#user_id").html(response.user_id);
                    console.log(response);
                },
                error: function (data) {
                    $("#register_btn").html('Sign Up');
                    data = JSON.parse(data.responseText)
                    $("#error").show();
                    $("#error").html(data.message);
                    if(data.errors.name != undefined){
                        $("#name").text(data.errors.name)
                    }
                    if(data.errors.clg_name != undefined){
                        $("#clg_name").text(data.errors.clg_name)
                    }
                    if(data.errors.phone != undefined){
                        $("#phone").text(data.errors.phone)
                    }
                    if(data.errors.payment_number != undefined){
                        $("#payment_number").text(data.errors.payment_number)
                    }
                    if(data.errors.batch_id != undefined){
                        $("#batch_id").text(data.errors.batch_id)
                    }
                    if(data.errors.group_name != undefined){
                        $("#group_name").text(data.errors.group_name)
                    }
                    console.log('Error:', data.errors);
                }
            });
        });
    });
</script>
@endpush