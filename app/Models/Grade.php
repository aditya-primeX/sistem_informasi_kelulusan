<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'subject_name',
        'score',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }}
