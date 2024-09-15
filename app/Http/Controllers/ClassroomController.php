<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\Grade;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = classroom::with('grade')->get();
        return view('pages.classrooms.classrooms',compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.classrooms.add-classroom',compact(['grades', 'teachers']));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            try{
                $validated = $request->validate([
                    'Name' => 'required|string|max:255',
                    'grade_id' => 'required|exists:grades,id',
                    'teacher_ids' => 'required|array',
                    'teacher_ids.*' => 'exists:teachers,id',
                ]);

                $classroom = classroom::create([
                    'Name' => $validated['Name'],
                    'grade_id' => $validated['grade_id'],
                ]);

                $classroom->teachers()->attach($validated['teacher_ids']);


            }catch(Exception $e){
                return redirect()->route('classrooms.index')->with('error', 'something went wrong while adding new classroom.');
            }

            return redirect()->route('classrooms.index')->with('success', 'classroom added successfully.');
        }

    /**
     * Display the specified resource.
     */
    public function show(classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classroom = classroom::with('teachers')->findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.classrooms.update-classroom',compact(['classroom', 'grades', 'teachers']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{

            $validated = $request->validate([
                'Name' => 'required|string|max:255',
                'grade_id' => 'required|exists:grades,id',
                'teacher_ids' => 'required|array',
                'teacher_ids.*' => 'exists:teachers,id',
            ]);

            $classroom = classroom::findOrFail($id);

            $classroom->update([
                'Name' => $request->Name,
                'grade_id' => $request->grade_id
            ]);

            $classroom->teachers()->sync($validated['teacher_ids']);

        }catch(Exception $e){
            return redirect()->route('classrooms.index')->with('error', 'something went wrong while updating new classroom.');
        }

        return redirect()->route('classrooms.index')->with('success', 'classroom updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $classroom = classroom::findOrFail($id);

            $classroom->delete();

        }catch(Exception $e){
            return redirect()->route('classrooms.index')->with('error', 'something went wrong');
        }

       return redirect()->route('classrooms.index')->with('success', 'classroom deleted successfully');

    }
}
