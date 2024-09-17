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

}
