<?php

namespace App\Repositories\Student;

interface FeesRepositoryInterface
{
    public function getAllGrades();
    public function getSpecificFee($id);
    public function storeNewFee($validatedData);
    public function updateNewFee($validatedData, $id);
    public function destroyFee($id);
}
