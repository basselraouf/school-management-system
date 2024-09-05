<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Exception;
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
        try{
            $validated = $request->validate([
                'Name' => 'required|string|max:255',
                'Notes' => 'nullable|string'
            ]);

            Grade::Create($validated);

        }catch(Exception $e){

            return redirect()->route('grades.index')->with('error', 'An error occurred: ' . $e->getMessage());

        }

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
        try {
            $grade = Grade::findOrFail($id);

            $grade->update([
                'Name'=>$request->Name,
                'Notes'=>$request->Notes
            ]);

        }catch(Exception $e){
            return redirect()->route('grades.index')->with('error', 'something went wrong');
        }

        return redirect()->route('grades.index')->with('success', 'grade updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{

            $grade = Grade::findOrFail($id);

            $grade->delete();

        }catch(Exception $e){

            return redirect()->route('grades.index')->with('error', 'something went wrong');

        }

       return redirect()->route('grades.index')->with('success', 'grade deleted successfully');
    }
}
