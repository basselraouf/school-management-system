<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['Name'];
    protected $guarded = [];

    public function specializations()
    {
        return $this->belongsTo('App\Models\Specialization', 'specialization_id');
    }

    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'teacher_classroom');
    }
}
