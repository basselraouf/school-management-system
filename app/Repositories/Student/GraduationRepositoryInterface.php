<?php

namespace App\Repositories\Student;

interface GraduationRepositoryInterface
{
    public function allGrades();
    public function SoftDelete($request);
    public function TrashedStudents();
    public function ReturnData($request);
    public function destroy($request);
}
