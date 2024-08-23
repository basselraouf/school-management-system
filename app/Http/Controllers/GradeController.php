<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.grades',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.grades.add-grade');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Notes' => 'nullable|string'
        ]);
        Grade::Create($validated);

        return redirect()->route('grades.index')->with('success', 'Grade added successfully.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        return view('pages.grades.update-grade',compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->update([
            'Name'=>$request->Name,
            'Notes'=>$request->Notes
        ]);
        return redirect()->route('grades.index')->with('success', 'تم تعديل الصف بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);

        $grade->delete();

       return redirect()->route('grades.index')->with('success', 'تم حذف الصف بنجاح.');
    }
}
