<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamBatch;
use App\Models\Note;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $total = [
            'student' => Student::count(),
            'exam' => Exam::count(),
            'exam_batch' => ExamBatch::count(),
            'pending_payment' => Student::where('status','pending')->count(),
            'note' => Note::count(),
            'class' => StudentClass::count(),
            'subject' => Subject::count(),
        ];

        return view('backend.dashboard',compact('total'));
    }
}
