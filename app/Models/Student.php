<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'nis',
        'date_of_birth',
        'graduation_status',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }}
