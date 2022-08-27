<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamBatch;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::orderBy('id','desc')->get();
        return view('backend.exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $batches = ExamBatch::all();
        return view('backend.exam.create', compact('batches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'batch_id' => 'required',
            'type' => 'required',
            'exam_type' => 'required',
            'duration' => 'required',
            'total_marks' => 'required',
            'total_question' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
        ]);

        Exam::create($request->all());
        return redirect()->route('exam.index')->with('success','Exam Added Succesfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::find($id);
        $batches = ExamBatch::all();
        return view('backend.exam.edit',compact('exam','batches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'batch_id' => 'required',
            'type' => 'required',
            'exam_type' => 'required',
            'duration' => 'required',
            'total_marks' => 'required',
            'total_question' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
        ]);

        Exam::whereId($id)->update($validateData);
        return redirect()->route('exam.index')->with('success','Exam Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

       return response()->json(['success' => 'Member has been deleted successfully']);
    }

    public function activate($id)
    {
        $exam = Exam::find($id);
        $exam->update([
            'status' => 1
        ]);
        return response()->json(['status' => 200]);
    }

    public function deactivate($id)
    {
        $exam = Exam::find($id);
        $exam->update([
            'status' => 0
        ]);
        return response()->json(['status' => 200]);
    }
}
