<?php


namespace App\Repositories\Student;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;

class QuizRepository implements QuizRepositoryInterface
{
    public function index()
    {
        $quizzes = Quiz::get();
        return view('pages.Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data['Grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.create', $data);
    }

    public function store($request)
    {
        try {

            $quiz = new Quiz();
            $quiz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quiz->subject_id = $request->subject_id;
            $quiz->grade_id = $request->Grade_id;
            $quiz->classroom_id = $request->Classroom_id;
            $quiz->teacher_id = $request->teacher_id;
            $quiz->save();

            return redirect()->route('Quizzes.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $quizz = Quiz::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }

    public function update($request)
    {
        try {
            $quizz = Quiz::findorFail($request->id);
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();

            return redirect()->route('Quizzes.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Quiz::destroy($request->id);

            return redirect()->back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
