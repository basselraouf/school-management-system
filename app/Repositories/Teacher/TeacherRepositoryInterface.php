<?php

namespace App\Repositories\Teacher;

interface TeacherRepositoryInterface
{
    public function getAllTeachers();
    public function createTeacher(array $data);
    public function getSpecializations();
    public function getGenders();
    public function editTeachers($id);
    public function updateTeacher($data, $id);
    public function deleteTeacher($id);

}
