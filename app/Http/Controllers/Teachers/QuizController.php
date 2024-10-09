<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('teacher_id',auth()->user()->id)->get();
        return view('pages.teachers.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.teachers.quizzes.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $quizzes = new Quiz();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->save();

            return redirect()->route('quizzes.create');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $quizz = Quiz::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.teachers.quizzes.edit', $data, compact('quizz'));
    }

    public function show($id)
    {
        $questions = Question::where('quiz_id',$id)->get();
        $quizz = Quiz::findorFail($id);
        return view('pages.teachers.quizzes.questions.index',compact('questions','quizz'));
    }

    public function update(Request $request)
    {
        try {
            $quizz = Quiz::findorFail($request->id);
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->teacher_id = auth()->user()->id;
            $quizz->save();

            return redirect()->route('quizzes.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Quiz::destroy($id);

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Get_classrooms($id)
    {
        $list_classes = classroom::where("grade_id", $id)->pluck("Name", "id");

        return response()->json($list_classes);
    }

}
