<?php

namespace App\Http\Controllers\Admin\Note;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.notes.class');
    }

    public function fetchClass()
    {
        $classes = StudentClass::all();
        $output = '';
        if($classes->count() > 0){
            $output .= '<table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>';

            foreach($classes as $class){
                $output .= '<tr>
                                    <td>'.$class->id.'</td>
                                    <td>'.$class->name.'</td>
                                    <td>'.$class->slug.'</td>                                    
                                    <td>
                                        <a href="javascript:void(0)" id="'.$class->id.'" class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm dlt" id="'.$class->id.'"><i class="fa fa-trash"></i></a>
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
        StudentClass::updateOrCreate(['id' => $request->id], [
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
        $class = StudentClass::find($id);
        return response()->json($class);
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
        StudentClass::find($id)->delete();
        return response()->json(['status'=>200]);
    }
}
