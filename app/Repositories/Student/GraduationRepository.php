<?php

namespace App\Repositories\Student;

use App\Models\Grade;
use App\Models\Student;

class GraduationRepository implements GraduationRepositoryInterface
{
    public function allGrades()
    {
        return Grade::all();
    }

    public function SoftDelete($request)
    {
        $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student){
            Student::where('id', $student->id)->Delete();
        }

    }

    public function TrashedStudents()
    {
        return Student::onlyTrashed()->get();
    }

    public function ReturnData($request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->restore();
    }

    public function destroy($request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
    }
}
