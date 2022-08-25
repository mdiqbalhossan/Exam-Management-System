@extends('layouts.frontend')

@section('title', 'Amuse Exam - Registration')

@section('content')
<div class="container h-100 mb-5 register">
    <div class="row h-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
                <div class="text-center mt-4">
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
                            <a href="login.php">here</a>
                        </span>
                    </p>
                    <hr>
                    @include('partials.error')
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <form method="POST" action="{{ route('user.register.post') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control form-control-lg" type="text" name="name"
                                        placeholder="Enter your name" id="name" />
                                </div>
                                <div class="form-group">
                                    <label>College Name</label>
                                    <input class="form-control form-control-lg" type="text" name="clg_name"
                                        placeholder="Enter your College name" id="clg_name" />
                                </div>
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input class="form-control form-control-lg" type="text" name="phone"
                                        placeholder="Enter contact number" id="phone" />
                                </div>
                                <div class="form-group">
                                    <label>Number that you used to payment for register</label>
                                    <input class="form-control form-control-lg" type="text" name="payment_number"
                                        placeholder="Enter number that you used to payment" id="payment_number" />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Batch</label>
                                            <select class="form-control form-control-lg" name="batch_id"
                                                id="batch_name">
                                                <?php foreach($category as $cat): ?>
                                                <option value="<?= $cat['id'] ?>">
                                                    <?= $cat['name'] ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Group</label>
                                            <select class="form-control form-control-lg" name="group" id="group_name">
                                                <option value="science">Science</option>
                                                <option value="humanities">Humanities</option>
                                                <option value="business_studies">Business Studies</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <!-- <a href="index.html" class="btn btn-lg btn-primary"
                      >Sign up</a
                    > -->
                                    <button type="submit" class="btn btn-lg btn-primary">Sign
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