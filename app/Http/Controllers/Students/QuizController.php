<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repositories\Student\ExamRepositoryInterface;
use App\Repositories\Student\QuizRepositoryInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $Quiz;

    public function __construct(QuizRepositoryInterface $Quiz)
    {
        $this->Quiz =$Quiz;
    }

    public function index()
    {
        return $this->Quiz->index();
    }

    public function create()
    {
        return $this->Quiz->create();
    }


    public function store(Request $request)
    {
        return $this->Quiz->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->Quiz->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Quiz->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Quiz->destroy($request);
    }
}
