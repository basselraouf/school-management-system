<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;
    protected $guarded = [];
    public $translatable = ['name'];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(classroom::class, 'Classroom_id');
    }

    public function Nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function myparent()
    {
        return $this->belongsTo(My_Parent::class, 'parent_id');
    }

    public function student_account()
    {
        return $this->hasMany('App\Models\StudentAccount', 'student_id');

    }

    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance', 'student_id');
    }
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($student) {
            foreach ($student->images as $image) {
                // Delete the file from storage
                Storage::disk('upload_attachments')->delete('attachments/students/' . $student->name . '/' . $image->filename);

                // Delete the image record
                $image->delete();
            }
        });
    }
}
