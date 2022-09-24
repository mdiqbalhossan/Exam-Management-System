<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'note',
        'demo',
        'status'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
