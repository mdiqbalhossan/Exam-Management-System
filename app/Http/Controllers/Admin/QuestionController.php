<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{

    public function index($id)
    {
        $exam = Exam::findOrFail($id);
        if($exam){
            Session::put('exam_id', $id);
            $exam_title = $exam->title;
            $questions = Question::all();
            return view('backend.question.index', compact('questions','exam_title'));

        }
    }

    public function create()
    {
        $total_question = Question::where('exam_id', Session::get('exam_id'))->count();
        return view('backend.question.create', compact('total_question'));
    }

    public function store(Request $request){
        $request->validate([
            'question' => 'required',
        ]);

        $options = json_encode($request->options);
        $question = new Question();
        $question->question = $request->question;
        $question->options = $options;
        $question->correct_ans = $request->correct_answer;
        $question->answer = $request->answer;
        $question->exam_id = Session::get('exam_id');
        $question->save();

        return redirect()->back()->with('success','Question Added Successfully');

    }

    // public function destroy($id)
    // {
    //     $question = Question::findOrFail($id);
    //     $question->delete();

    //    return response()->json(['success' => 'Member has been deleted successfully']);
    // }

}
