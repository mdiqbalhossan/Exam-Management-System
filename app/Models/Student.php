<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    

    protected $guarded = ['student'];

    protected $fillable = [
        'name', 'email', 'clg_name', 'phone', 'photo', 'user_id', 'payment_number', 'batch_id', 'status'
    ];

    public function batch()
    {
        return $this->belongsTo(ExamBatch::class, 'batch_id');
    }


    public static function boot() { 
        parent::boot(); 
        self::creating(function ($model) { 
            $model->user_id = UniqueIdGenerator::generate(['table' => $model->table, 'field' => 'user_id', 'length' => 6,'prefix' =>date('y')]); 
        }); 
    }
}
