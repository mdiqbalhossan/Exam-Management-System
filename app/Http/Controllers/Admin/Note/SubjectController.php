<?php

namespace App\Http\Controllers\Admin\Note;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        return view('backend.notes.subject',compact('classes','groups'));
    }

    public function fetchSubject()
    {
        $subjects = Subject::all();
        $output = '';
        if($subjects->count() > 0){
            $output .= '<table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>CLass</th>
                                    <th>Group</th>
                                    <th>Name</th>
                                    <th>Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>';

            foreach($subjects as $subject){
                $output .= '<tr>
                                    <td>'.$subject->id.'</td>
                                    <td>'.$subject->class->name.'</td>
                                    <td>'.(($subject->group_id != 0) ? $subject->group->name : "No Group").'</td>   
                                    <td>'.$subject->name.'</td>                                 
                                    <td>
                                        <a href="javascript:void(0)" id="'.$subject->id.'" class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm dlt" id="'.$subject->id.'"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>';
            }
            
            $output .= '</tbody>                            
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
        Subject::updateOrCreate(['id' => $request->id], [
            'class_id' => $request->class_id,
            'group_id' => $request->group_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
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
        $group = Subject::find($id);
        return response()->json($group);
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
        Subject::find($id)->delete();
        return response()->json(['status'=>200]);
    }
}
