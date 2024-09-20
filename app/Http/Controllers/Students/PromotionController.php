<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repositories\Student\PromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $promotion;

    public function __construct(PromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = $this->promotion->getAllGrades();

        return view('pages.students.promotions.promotion', compact('Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $promotions = $this->promotion->getAllPromotions();

        return view('pages.students.promotions.management',compact('promotions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Grade_id' => 'required|integer',
            'Classroom_id' => 'required|integer',
            'Grade_id_new' => 'required|integer',
            'Classroom_id_new' => 'required|integer',
        ]);

        $this->promotion->promoteStudents($validatedData);

        return redirect()->route('students.index')->with('success', trans('messages.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->promotion->rollbackAction($request);

        return redirect()->back();
    }
}
