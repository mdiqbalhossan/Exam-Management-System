<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'group',
        'exam_fees',
        'syllabus',
        'exam_validate',
        'exam_start_date'
    ];
}
