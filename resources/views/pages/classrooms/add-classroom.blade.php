@extends('layouts.master')
@section('css')

@section('title')
    add new classroom
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Add new classroom</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">add new classroom</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('classrooms.store') }}" method="POST">
                    @csrf
                    <!-- Classroom Name Input -->
                    <div class="form-group">
                        <label for="classroomName">Classroom Name:</label>
                        <input type="text" name="Name" id="classroomName" class="form-control" value="{{ old('Name') }}" required>
                    </div>

                    <!-- Grade Dropdown -->
                    <div class="form-group">
                        <label for="gradeId">Grade:</label>
                        <select name="grade_id" id="gradeId" class="form-control" style="height:auto; padding: 8px;" required>
                            <option value="">Select Grade</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Teachers Multi-Select -->
                    <div class="form-group">
                        <label for="teacherIds">Select Teachers:</label>
                        <select name="teacher_ids[]" id="teacherIds" class="form-control" multiple style="height:auto; padding: 8px;">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <!-- Instructions for Multi-Select -->
                        <small class="form-text text-muted">Hold down the Ctrl (Windows) / Command (Mac) button to select multiple options.</small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-3">Add Classroom</button>
                </form>
            </div>
        </div>
    </div>

<!-- row closed -->
@endsection
@section('js')

@endsection
