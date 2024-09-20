<?php

namespace App\Repositories\Student;

use Illuminate\Http\Request;

interface PromotionRepositoryInterface
{
    public function getAllGrades();
    public function promoteStudents($validatedData);
    public function getAllPromotions();
    public function rollbackAction($request);

}
