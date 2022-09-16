@extends('layouts.frontend')

@section('title', 'Amuse Exam')

@section('content')
<section class="details-card">
    <div class="container">
        <div class="row">
            @foreach ($batches as $batch)
            <div class="col-xl-4 col-md-12">
                <div class="card-content">
                    <div class="card-img">
                        <img src="https://placeimg.com/380/230/tech" alt="" />
                        <span>
                            <h4>Exam Fee:- {{ $batch->exam_fees }} Tk</h4>
                        </span>
                    </div>
                    <div class="card-desc">
                        <h3>{{ $batch->name }} {{ Str::ucfirst($batch->group) }}</h3>
                        <p>
                        <div class="well" style="max-height: 300px;overflow: auto;">
                            <ul class="list-group checked-list-box">
                                <li class="list-group-item">Exam Validate: {{ $batch->exam_validate }} days</li>
                                <li class="list-group-item" data-checked="true">Exam Started: {{
                                    \Carbon\Carbon::parse($batch->exam_start_date)->format('d M, Y (D)')}}</li>
                            </ul>
                        </div>
                        </p>
                        <a href="{{ route('details', ['id'=>$batch->id]) }}" class="btn-card">Get Started</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection