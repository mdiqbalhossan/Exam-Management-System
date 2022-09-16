<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamBatch;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $batches = ExamBatch::all();
        return view('frontend.index',compact('batches'));
    }
}
