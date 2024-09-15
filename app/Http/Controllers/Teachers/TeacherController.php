<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Repositories\TeacherRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Teachers =$this->teacherRepository->getAllTeachers();
        return view('pages.teachers.teacher', compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->teacherRepository->getSpecializations();
        $genders = $this->teacherRepository->getGenders();
        return view('pages.teachers.create', compact(['specializations','genders']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'Email' => 'required|email|unique:teachers,Email',
                'Password' => 'required|min:8',
                'Name_ar' => 'required|string|max:255',
                'Name_en' => 'required|string|max:255',
                'specialization_id' => 'required|exists:specializations,id',
                'gender_id' => 'required|exists:genders,id',
                'Joining_Date' => 'required|date',
                'Address' => 'required|string|max:500',
            ]);

            $data = $request->only([
                'Email',
                'specialization_id',
                'gender_id',
                'Joining_Date',
                'Address',
            ]);
            $data['Name'] = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $data['Password'] = bcrypt($request->Password);

            $this->teacherRepository->createTeacher($data);

            return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');

        }catch(Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
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
        $Teacher = $this->teacherRepository->editTeachers($id);
        $specializations = $this->teacherRepository->getSpecializations();
        $genders = $this->teacherRepository->getGenders();
        return view('pages.teachers.edit', compact(['Teacher', 'specializations', 'genders']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'Email' => [
                    'required',
                    'email',
                    Rule::unique('teachers', 'Email')->ignore($id),
                ],
                'Password' => 'required|min:8',
                'Name_ar' => 'required|string|max:255',
                'Name_en' => 'required|string|max:255',
                'specialization_id' => 'required|exists:specializations,id',
                'gender_id' => 'required|exists:genders,id',
                'Joining_Date' => 'required|date',
                'Address' => 'required|string|max:500',
            ]);

            $data = $request->only([
                'Email',
                'specialization_id',
                'gender_id',
                'Joining_Date',
                'Address',
            ]);
            $data['Name'] = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $data['Password'] = bcrypt($request->Password);

            $this->teacherRepository->updateTeacher($data, $id);

            return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');

        }catch(Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $this->teacherRepository->deleteTeacher($id);

            return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');

        }catch(Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
            
        }
    }
}
