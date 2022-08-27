<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $batch_id = Auth::user()->batch_id;
        // $exams = Exam::orderBy('id','desc')->where('batch_id',$batch_id)->where('status',1)->get();
        $exams = Exam::orderBy('id','desc')->where('batch_id',$batch_id)->where('status',1)->get();
        return view('frontend.dashboard',compact('exams'));
    }
}
