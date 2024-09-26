<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function f_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'from_grade');
    }

    public function f_classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'from_Classroom');
    }

    public function t_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'to_grade');
    }

    public function t_classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'to_Classroom');
    }

}