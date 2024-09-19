<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Repositories\Student\StudentRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = $this->studentRepository->getAllStudents();
        return view('pages.students.students', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->studentRepository->createStuednt();
        return view('pages.Students.add-student', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $this->studentRepository->storeStudent($request->validated());

            return redirect()->route('students.index')->with('success', trans('messages.success'));

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Student = $this->studentRepository->getSpecificStudent($id);
        return view('pages.Students.show-student', compact('Student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->studentRepository->editStudent($id);
        return view('pages.Students.edit-student', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, $id)
    {
        try {
            $this->studentRepository->updateStudent($request->validated(), $id);

            return redirect()->route('students.index')->with('success', trans('messages.success'));

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $student = $this->studentRepository->getSpecificStudent($id);

            $student->forceDelete();

            return redirect()->route('students.index')->with('success', trans('messages.success'));

        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Get_classrooms($id)
    {
       return $this->studentRepository->Get_classrooms($id);
    }

    public function Upload_attachment(Request $request)
    {
        $this->studentRepository->Upload_attachment($request);

        return redirect()->route('students.show', $request->student_id)->with('success', trans('messages.success'));
    }

    public function Download_attachment($studentId, $url)
    {
        return $this->studentRepository->Download_attachment($studentId,$url);
    }

    public function Delete_attachment(Request $request)
    {
        $this->studentRepository->Delete_attachment($request);

        return redirect()->route('students.show', $request->student_id)->with('success', trans('messages.success'));
    }
}
