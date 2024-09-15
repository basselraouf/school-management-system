<?php

namespace App\Repositories;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getSpecializations()
    {
        return Specialization::all();
    }

    public function getGenders()
    {
        return Gender::all();
    }

    public function createTeacher(array $data)
    {
        return Teacher::create($data);
    }

    public function editTeachers($id)
    {
        return Teacher::findOrFail($id);
    }

    public function updateTeacher($data, $id){
        $teacher = Teacher::findOrFail($id);
        return $teacher->update($data);
    }

    public function deleteTeacher($id){
        $teacher = Teacher::findOrFail($id);
        return $teacher->delete();
    }
}
