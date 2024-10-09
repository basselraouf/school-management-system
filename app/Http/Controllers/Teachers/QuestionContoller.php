<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;

class QuestionContoller extends Controller
{
    public function store(Request $request)
    {
        try {
            $question = new Question();
            $question = new Question();
            $question->content = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quizz_id;
            $question->save();

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $quizz_id = $id;
        return view('pages.teachers.quizzes.questions.create', compact('quizz_id'));
    }

    public function edit($id)
    {
        $question = Question::findorFail($id);
        return view('pages.teachers.quizzes.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        try {
            $question = Question::findorfail($id);
            $question->content = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->save();

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Question::destroy($id);

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
