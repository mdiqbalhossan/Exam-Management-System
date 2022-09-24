<?php

namespace App\Http\Controllers\Admin\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('backend.notes.note',compact('subjects'));
    }

    public function fetchNote()
    {
        $notes = Note::all();
        $output = '';
        if($notes->count() > 0){
            $output .= '<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Subject</th>
                                    <th>Title</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>';

            foreach($notes as $note){
                $output .= '<tr>
                                    <td>'.$note->id.'</td>
                                    <td>'.$note->subject->name.'</td>
                                    <td>'.$note->title.'</td>   
                                    <td><a target="_blank" href="'.asset('notes').'/'.$note->note.'">'.$note->note.'</a></td> 
                                    <td>'.Str::title($note->status).'</td>                                
                                    <td>
                                        <a href="javascript:void(0)" id="'.$note->id.'" class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm dlt" id="'.$note->id.'"><i class="fa fa-trash"></i></a>
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Note::find($request->id);
        if($request->file('note')){
            $file = $request->file('note');
            @unlink(asset('notes/'.$data->note));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('notes'),$filename);
        }else{
            $filename = $data->note;
        }
        Note::updateOrCreate(['id' => $request->id], [
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'note' => $filename,
            'demo' => $request->demo,
            'status' => $request->status,
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
        $note = Note::find($id);
        return response()->json($note);
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
        Note::find($id)->delete();
        return response()->json(['status'=>200]);
    }
}
