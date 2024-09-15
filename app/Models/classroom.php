<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    use HasFactory;

    protected $fillable = ['Name', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_classroom');
    }
}
