<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repositories\Student\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $Attendance;

    public function __construct(AttendanceRepositoryInterface $Attendance)
    {
        $this->Attendance = $Attendance;
    }
    public function index()
    {
        return $this->Attendance->index();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->Attendance->store($request);
    }

    public function show(string $id)
    {
        return $this->Attendance->show($id);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
