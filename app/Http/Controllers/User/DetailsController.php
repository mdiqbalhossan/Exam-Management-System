<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamBatch;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function index($id)
    {
        $exam_batch = ExamBatch::find($id);
        return view('frontend.details',compact('exam_batch'));
    }
}
