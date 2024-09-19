<?php

namespace App\Repositories\Student;

interface StudentRepositoryInterface
{
    public function getAllStudents();
    public function getSpecificStudent($id);
    public function createStuednt();
    public function editStudent($id);
    public function storeStudent(array $data);
    public function updateStudent(array $data, $id);
    public function Get_classrooms($id);
    public function Upload_attachment($request);
    public function Download_attachment($studentId, $url);
    public function Delete_attachment($request);

}
