@extends('layouts.frontend')

@section('title', 'Amuse Exam - Group')
@push('css')
<style>
    .order-card {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg, #4099ff, #73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg, #2ed8b6, #59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg, #FFB64D, #ffcb80);
    }

    .bg-c-pink {
        background: linear-gradient(45deg, #FF5370, #ff869a);
    }


    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 20px;
    }

    .order-card i {
        font-size: 26px;
    }

    .f-left {
        float: left;
    }

    .f-right {
        float: right;
    }

    .card-block .btn {
        margin-top: 30px;
        background: linear-gradient(12deg, #171818, #504c54);
        border: none;
        width: 200px;
    }
</style>
@endpush

@section('content')
<div class="container mt-5">
    <div class="row">
        @php
        $color = ['bg-c-blue','bg-c-green','bg-c-pink','bg-c-yellow'];
        @endphp
        @foreach ($groups as $key => $group)
        <div class="col-md-4 col-xl-3">
            <div class="card {{ $color[$key] }} order-card">
                <div class="card-block">
                    <h3 class="m-b-20 text-center">{{ $group->name }}</h3>
                    <a href="{{ route('user.subject',[$class->slug, $group->slug]) }}"
                        class="btn btn-dark d-block">Download Note</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- row.// -->
</div>
<!--container end.//-->
@endsection