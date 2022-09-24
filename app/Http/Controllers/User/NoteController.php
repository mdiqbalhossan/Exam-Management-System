<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\Subject;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function class(){
        $classes = StudentClass::all();
        return view('frontend.note.class',compact('classes'));
    }

    public function group($slug){
        $class = StudentClass::where('slug',$slug)->first();
        $groups = StudentGroup::all();
        return view('frontend.note.group',compact('groups','class'));
    }

    public function subject($class_slug, $group_slug){
        $class = StudentClass::where('slug',$class_slug)->first();
        $group = StudentGroup::where('slug',$group_slug)->first();
        $class_id = $class->id;
        $group_id = $group->id;

        $subjects = Subject::where('class_id',$class_id)->whereIn('group_id',[$group_id,'0'])->get();
        return view('frontend.note.subject',compact('subjects','class','group'));
    }

    public function note($class_slug, $group_slug, $subject_slug){
        $class = StudentClass::where('slug',$class_slug)->first();
        $group = StudentGroup::where('slug',$group_slug)->first();
        $subject = Subject::where('slug',$subject_slug)->first();
        $id = $subject->id;
        $notes = Note::where('subject_id',$id)->get();
        return view('frontend.note.note',compact('notes','class','subject'));
    }
}
