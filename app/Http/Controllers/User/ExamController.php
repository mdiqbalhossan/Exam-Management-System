<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index($id)
    {
        $question = Question::where('exam_id',$id)->get();
        $exam = Exam::find($id);
        return view('frontend.exam',compact('question','exam'));
    }

    public function store(Request $request, $id){  
        // $data = $request->all();
        $data['user_id'] = $request->user_id;
        $data['exam_id'] = $request->exam_id;
        unset($request['_token']);
        unset($request['user_id']);
        unset($request['exam_id']);
        $data['answer'] = json_encode($request->all());
        
        Answer::insert($data);

        return redirect()->route('success');
    }

    public function success(){
        return view('frontend.success');
    }
}
