@extends('layouts.master')
@section('css')

@section('title')
    edit
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
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
        <div class="col-sm-6">
            <h4 class="mb-0">تعديل الصف</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Classroom Name Input -->
                    <div class="form-group">
                        <label for="Name">Name:</label>
                        <input type="text" name="Name" value="{{ $classroom->Name }}" class="form-control" required>
                    </div>

                    <!-- Grade Dropdown -->
                    <div class="form-group">
                        <label for="gradeId">Grade:</label>
                        <select name="grade_id" id="gradeId" class="form-control" style="height:auto; padding: 12px" required>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" {{ $grade->id == $classroom->grade_id ? 'selected' : '' }}>
                                    {{ $grade->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Teachers Multi-Select -->
                    <div class="form-group">
                        <label for="teacherIds">Select Teachers:</label>
                        <select name="teacher_ids[]" id="teacherIds" class="form-control" multiple style="height:auto; padding: 12px;">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ in_array($teacher->id, $classroom->teachers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Hold down the Ctrl (Windows) / Command (Mac) button to select multiple options.</small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
