<?php


namespace App\Repositories\Student;
use App\Models\Question;
use App\Models\Quiz;
use Exception;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function index()
    {
        $questions = Question::get();
        return view('pages.questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quiz::get();
        return view('pages.questions.create',compact('quizzes'));
    }

    public function store($request)
    {
        try {
            $question = new Question();
            $question->content = $request->content;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quiz_id;
            $question->save();

            return redirect()->route('questions.index');

        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $question = Question::findorfail($id);
        $quizzes = Quiz::get();
        return view('pages.questions.edit',compact('question','quizzes'));
    }

    public function update($request)
    {
        try {
            $question = Question::findorfail($request->id);
            $question->content = $request->content;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quiz_id;
            $question->save();

            return redirect()->route('questions.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Question::destroy($request->id);

            return redirect()->back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
