<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'batch_id',
        'type',
        'description',
        'duration',
        'total_marks',
        'total_question',
        'negative_marks',
        'pass_percentage',
        'status',
        'start_date',
        'end_date',
        'exam_type',
    ];
    
    public function batch()
    {
        return $this->belongsTo(ExamBatch::class, 'batch_id');
    }
}
