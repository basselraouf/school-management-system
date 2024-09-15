<?php

namespace App\Repositories;

interface TeacherRepositoryInterface
{
    public function getAllTeachers();
    public function createTeacher(array $data);
    public function getSpecializations();
    public function getGenders();
    public function editTeachers($id);
    public function updateTeacher($data, $id);
    public function deleteTeacher($id);
    // public function getTeacherById($id);
    // public function createTeacher(array $data);
    // public function updateTeacher($id, array $data);
    // public function deleteTeacher($id);
}
