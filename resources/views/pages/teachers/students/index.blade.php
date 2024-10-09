@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.Attendance')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.Attendance')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif

    <h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('attendance') }}" autocomplete="off">

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
                    <thead>
                    <tr>
                        <th class="alert-success">#</th>
                        <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                        <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                        <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
                        <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
                        <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
                        <th class="alert-success">{{trans('main_trans.Attendance')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->gender->Name }}</td>
                            <td>{{ $student->grade->Name }}</td>
                            <td>{{ $student->classroom->Name }}</td>
                            <td>

                        @if(isset($student->attendance()->where('attendence_date',date('Y-m-d'))->where('student_id',$student->id)->first()->student_id))

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" disabled
                                        {{ $student->attendance()->first()->attendence_status == 1 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="presence">
                                <span class="text-success">حضور</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendences[{{ $student->id }}]" disabled {{ $student->attendance()->first()->attendence_status == 0 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="absent">
                                <span class="text-danger">غياب</span>
                            </label>
                            <button type="button" class="btn btn-secondary btn-sm"
                                    data-toggle="modal"
                                    data-target="#edit_attendance{{ $student->id }}" title="حذف"><i
                                    class="fa fa-edit"></i></button>
                            @include('pages.teachers.students.edit-attendance')
                        @else

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="presence">
                                <span class="text-success">حضور</span>
                            </label>

                <label class="ml-4 block text-gray-500 font-semibold">
                    <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                            value="absent">
                    <span class="text-danger">غياب</span>
                </label>

                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                <input type="hidden" name="section_id" value="{{ $student->section_id }}">
            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <P>
                <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
            </P>
        </form><br>
    <!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
