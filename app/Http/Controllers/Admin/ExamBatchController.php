<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamBatch;
use Illuminate\Http\Request;

class ExamBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.exam-batch');
    }


    public function fetchExamBatch()
    {
        $examBatches = ExamBatch::all();
        $output = '';
        if($examBatches->count() > 0){
            $output .= '<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Exam Start</th>
                                    <th>Exam Validate</th>
                                    <th>Status</th>
                                    <th>Group</th>
                                    <th>Exam Fees</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

            foreach($examBatches as $examBatch){
                $output .= '<tr>
                                    <td>'.$examBatch->name.'</td>
                                    <td>'.$examBatch->exam_start_date.'</td>
                                    <td>'.$examBatch->exam_validate.'&nbsp;Days</td>
                                    <td>'.ucfirst($examBatch->status).'</td>
                                    <td>'.ucfirst($examBatch->group).'</td>
                                    <td>'.$examBatch->exam_fees.'</td>
                                    <td>
                                        <a href="javascript:void(0)" id="'.$examBatch->id.'" class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm dlt" id="'.$examBatch->id.'"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>';
            }
            
            $output .= '</tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Exam Start</th>
                                    <th>Exam Validate</th>
                                    <th>Status</th>
                                    <th>Group</th>
                                    <th>Exam Fees</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>';
        }else{
            $output .= '<h3 class="text-danger text-center">No Data Found</h3>';
        }
        
        echo $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ExamBatch::updateOrCreate(['id' => $request->id], $request->all());        
   
        return response()->json(['status'=>200]);
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
        $examBatch = ExamBatch::find($id);
        return response()->json($examBatch);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExamBatch::find($id)->delete();
        return response()->json(['status'=>200]);
    }
}
