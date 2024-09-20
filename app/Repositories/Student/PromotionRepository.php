<?php

namespace App\Repositories\Student;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{
    public function getAllGrades()
    {
        return Grade::all();
    }
    public function getAllPromotions()
    {
        return promotion::all();
    }
    public function promoteStudents($validatedData)
    {
        DB::beginTransaction();
        try{
            $students = Student::where('Grade_id', $validatedData['Grade_id'])->where('Classroom_id', $validatedData['Classroom_id'])->get();
            $ids = $students->pluck('id');

            if ($students->isEmpty()) {
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            Student::whereIn('id', $ids)
            ->update([
                'Grade_id'=>$validatedData['Grade_id_new'],
                'Classroom_id'=>$validatedData['Classroom_id_new'],
            ]);

            foreach ($students as $student){
                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$validatedData['Grade_id'],
                    'from_Classroom'=>$validatedData['Classroom_id'],
                    'to_grade'=>$validatedData['Grade_id_new'],
                    'to_Classroom'=>$validatedData['Classroom_id_new'],
                ]);
            }
            DB::commit();

            return redirect()->back()->with('success', __('تمت ترقية الطلاب بنجاح'));

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function rollbackAction($request)
    {
        DB::beginTransaction();

        try {
            if($request->page_id ==1){
                $promotions = Promotion::all(); // Fetch all promotions

                foreach ($promotions as $promotion) {
                    $id = $promotion->student_id;

                    // Update student to the previous grade and classroom
                    Student::where('id', $id)
                        ->update([
                            'Grade_id' => $promotion->from_grade,
                            'Classroom_id' => $promotion->from_Classroom,
                        ]);
                }

                // Truncate the promotions table after the loop
                Promotion::truncate();
            }else{
                $promotion = Promotion::findorfail($request->id);
                student::where('id', $promotion->student_id)
                    ->update([
                        'Grade_id'=>$promotion->from_grade,
                        'Classroom_id'=>$promotion->from_Classroom,
                    ]);

                Promotion::destroy($request->id);
                DB::commit();
            }

            DB::commit(); // Commit the transaction if everything is successful
        } catch (Exception $e) {
            DB::rollback(); // Rollback in case of error
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
