<?php

namespace App\Helpers;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;
use Carbon\Carbon;

class Helper 
{
    protected static $start_time = '';

    public static function checkEndDate($date){
        $date1 = Carbon::createFromFormat('Y-m-d H:i:s',$date);
        $date2 = Carbon::now();
        $date2 = Carbon::createFromFormat('Y-m-d H:i:s',$date2);
        $result = $date1->gt($date2);
        return $result;
    }

    public static function checkStartDate($date){
        self::$start_time = $date;
        $date1 = Carbon::createFromFormat('Y-m-d H:i:s',$date);
        $date2 = Carbon::now();
        $date2 = Carbon::createFromFormat('Y-m-d H:i:s',$date2);
        $result = $date1->lt($date2);
        return $result;
    }

    public static function getStartDate(){
        $date_time = Carbon::createFromFormat('Y-m-d H:i:s',self::$start_time);
        return $date_time;
    }


    public static function result($exam_id, $user_id){
        $exam = Exam::find($exam_id);
        $total_mark = $exam->total_marks;
        $negative_mark = $exam->negative_marks;
        $pass_mark = $exam->pass_percentage;
        $total_question = $exam->total_question;

        $question_per_marks = $total_mark / $total_question;

        $answer = Answer::where('user_id',$user_id)->where('exam_id',$exam_id)->first();

        $total_correct_ans = 0;
        $total_incorrect_ans = 0;

        $result = json_decode($answer->answer, true);

        foreach($result as $key => $val){
            $question = Question::where('id',$key)->first();
            if($question->correct_ans == $val){
                $total_correct_ans++;
            }else{
                $total_incorrect_ans++;
            }
        }

        $gained_marks = $total_correct_ans * $question_per_marks;
        $neg_marks = $total_incorrect_ans * ($negative_mark/100);
        $final_marks = $gained_marks - $neg_marks;

        if($final_marks >= $total_mark*($pass_mark/100)){
            $status = "Passed";
        }else{
            $status = "Failed";
        }

        Result::insert([
            'exam_id' => $exam_id,
            'user_id' => $user_id,
            'correct_ans' => $total_correct_ans,
            'incorrect_ans' => $total_incorrect_ans,
            'total_marks' => $gained_marks,
            'neg_marks' => $neg_marks,
            'final_marks' => $final_marks,
            'status' => $status
        ]);

    }

    
}