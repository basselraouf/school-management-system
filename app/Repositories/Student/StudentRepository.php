<?php

namespace App\Repositories\Student;

use App\Models\classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Student;
use App\Models\Type_Blood;
use App\Repositories\Student\StudentRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface
{
    public function getAllStudents()
    {
        return Student::with(['gender', 'classroom', 'grade'])->get();
    }

    public function getSpecificStudent($id)
    {
        return Student::findOrFail($id);
    }

    public function createStuednt()
    {
        return [
            'my_classes' => Grade::with('classrooms')->get(),
            'parents' => My_Parent::all(),
            'Genders' => Gender::all(),
            'nationals' => Nationality::all(),
            'bloods' => Type_Blood::all(),
        ];
    }

    public function editStudent($id)
    {
        return [
            'Grades' => Grade::with('classrooms')->get(),
            'parents' => My_Parent::all(),
            'Genders' => Gender::all(),
            'nationals' => Nationality::all(),
            'bloods' => Type_Blood::all(),
            'students' => Student::findOrFail($id)
        ];
    }

    public function Get_classrooms($id)
    {
        try {
            $list_classes = classroom::where("grade_id", $id)->pluck("Name", "id");
            return response()->json($list_classes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeStudent(array $data)
    {
        $students = new Student();
        $students->name = ['en' => $data['name_en'], 'ar' => $data['name_ar']];

        $students->email = $data['email'];
        $students->password = Hash::make($data['password']);
        $students->gender_id = $data['gender_id'];
        $students->nationality_id = $data['nationalitie_id'];
        $students->blood_id = $data['blood_id'];
        $students->Date_Birth = $data['Date_Birth'];
        $students->Grade_id = $data['Grade_id'];
        $students->Classroom_id = $data['Classroom_id'];
        $students->parent_id = $data['parent_id'];
        $students->academic_year = $data['academic_year'];
        $students->save();
    }

    public function updateStudent(array $data, $id)
    {
        $student = Student::findOrFail($id);

        $student->update([
            'name' => ['en' => $data['name_en'], 'ar' => $data['name_ar']],
            'email' => $data['email'] . $id,
            'password' => Hash::make($data['password']),
            'gender_id' => $data['gender_id'],
            'nationality_id' => $data['nationalitie_id'],
            'blood_id' => $data['blood_id'],
            'Date_Birth' => $data['Date_Birth'],
            'Grade_id' => $data['Grade_id'],
            'Classroom_id' => $data['Classroom_id'],
            'parent_id' => $data['parent_id'],
            'academic_year' => $data['academic_year'],
        ]);
    }
}
