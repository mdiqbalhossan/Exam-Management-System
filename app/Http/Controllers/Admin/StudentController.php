<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamBatch;
use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batch = ExamBatch::all();
        return view('backend.student', compact('batch'));
    }


    public function fetchStudent()
    {
        $students = Student::all();
        $output = '';
        if($students->count() > 0){
            $output .= '<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>College Name</th>
                                    <th>Phone</th>
                                    <th>Payment Number</th>
                                    <th>Batch</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

            foreach($students as $student){
                $output .= '<tr>
                                    <td>'.$student->user_id.'</td>
                                    <td>'.$student->name.'</td>
                                    <td>'.$student->clg_name.'</td>
                                    <td>'.$student->phone.'</td>
                                    <td>'.$student->payment_number.'</td>
                                    <td>'.$student->batch->name.'</td>
                                    <td>';
                                    if($student->status == 'accepted'){
            $output .= ucfirst($student->status);
            $output .= '<a href="#" class="text-danger ml-2 cancelled" id="'.$student->id.'"><i class="fa fa-times-circle"></i></a>';
        }else if($student->status == 'pending'){
            $output .= ucfirst($student->status);
            $output .= '<a href="#" class="text-success ml-2 accepted" id="'.$student->id.'"><i class="fa fa-check-circle"></i></a>';
        }else{
            $output .= "<span class='badge badge-danger'>".ucfirst($student->status)."</span>";
        }
                $output .=          '</td>
                                    <td>
                                        <a href="javascript:void(0)" id="'.$student->id.'" class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm dlt" id="'.$student->id.'"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>';
            }
            
            $output .= '</tbody>
                            <tfoot>
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>College Name</th>
                                    <th>Phone</th>
                                    <th>Payment Number</th>
                                    <th>Batch</th>
                                    <th>Status</th>
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Student::updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
            'clg_name' => $request->clg_name,
            'phone' => $request->phone,
            'payment_number' => $request->payment_number,
            'batch_id' => $request->batch_id,
            'status' => 'accepted'
        ]);        
   
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
        $student = Student::find($id);
        return response()->json($student);
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
        Student::find($id)->delete();
        return response()->json(['status'=>200]);
    }

    public function accepted($id)
    {
        $student = Student::find($id);
        $student->update([
            'status' => 'accepted'
        ]);
        return response()->json(['status' => 200]);
    }

    public function cancelled($id)
    {
        $student = Student::find($id);
        $student->update([
            'status' => 'cancelled'
        ]);
        return response()->json(['status' => 200]);
    }
}
