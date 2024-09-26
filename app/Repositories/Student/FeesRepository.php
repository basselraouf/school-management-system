<?php


namespace App\Repositories\Student;


use App\Models\Fee;
use App\Models\Grade;
use Exception;

class FeesRepository implements FeesRepositoryInterface
{
    public function getAllGrades()
    {
        return [
            'fees' => Fee::all(),
            'Grades' => Grade::all(),
        ];
    }

    public function getSpecificFee($id)
    {
        return [
            'fee' => Fee::findOrFail($id),
            'Grades' => Grade::all(),
        ];
    }

    public function storeNewFee($validatedData)
    {
        try {
            $fees = new Fee();
            $fees->title = ['en' => $validatedData['title_en'], 'ar' => $validatedData['title_ar']];
            $fees->amount = $validatedData['amount'];
            $fees->Grade_id = $validatedData['Grade_id'];
            $fees->Classroom_id = $validatedData['Classroom_id'];
            $fees->description = $validatedData['description'];
            $fees->year = $validatedData['year'];
            $fees->Fee_type = $validatedData['Fee_type'];
            $fees->save();
        }

        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateNewFee($validatedData, $id)
    {
        try {
            $fees = Fee::findorfail($id);
            $fees->title = ['en' => $validatedData['title_en'], 'ar' => $validatedData['title_ar']];
            $fees->amount = $validatedData['amount'];
            $fees->Grade_id = $validatedData['Grade_id'];
            $fees->Classroom_id = $validatedData['Classroom_id'];
            $fees->description = $validatedData['description'];
            $fees->year = $validatedData['year'];
            $fees->Fee_type = $validatedData['Fee_type'];
            $fees->save();
        }

        catch (Exception $e) {
            
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroyFee($id)
    {
        $fee = Fee::findOrFail($id);
        $fee->forceDelete();
    }
}
