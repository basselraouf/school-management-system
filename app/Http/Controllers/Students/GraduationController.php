<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repositories\Student\GraduationRepositoryInterface;
use Illuminate\Http\Request;

class GraduationController extends Controller
{
    protected $graduation;

    public function __construct(GraduationRepositoryInterface $graduationRepositoryInterface)
    {
        $this->graduation = $graduationRepositoryInterface ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = $this->graduation->TrashedStudents();
        return view('pages.students.graduation.trashed', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = $this->graduation->allGrades();
        return view('pages.students.graduation.graduation',compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->graduation->SoftDelete($request);

        return redirect()->route('graduations.index');
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
        $this->graduation->ReturnData($request);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->graduation->destroy($request);
        return redirect()->back();
    }
}
