<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class TeacherStudentsController extends Controller
{
    public function index()
    {
        $teacherId = auth()->user()->id;
        $classroomsIds = Teacher::find($teacherId)->classrooms->pluck('id');
        $students = Student::whereIn('classroom_id',$classroomsIds)->get();
        return view('pages.teachers.students.index',compact('students'));
    }

    public function classrooms()
    {
        $teacherId = auth()->user()->id;
        $classrooms = Teacher::find($teacherId)->classrooms;
        return view('pages.teachers.students.classrooms', compact('classrooms'));
    }

    public function attendance(Request $request)
    {
        try {
            $attenddate = date('Y-m-d');
            $classid = $request->section_id;
            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::create([
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'teacher_id' => auth()->id(),
                    'attendence_date' => $attenddate,
                    'attendence_status' => $attendence_status
                ]);
            }

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function editAttendance(Request $request){

        try{
            $date = date('Y-m-d');
            $student_id = Attendance::where('attendence_date',$date)->where('student_id',$request->id)->first();
            if( $request->attendences == 'presence' ) {
                $attendence_status = true;
            } else if( $request->attendences == 'absent' ){
                $attendence_status = false;
            }
            $student_id->update([
                'attendence_status'=> $attendence_status
            ]);

            return redirect()->back();
        }
        catch (Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
