@extends('layouts.master')
@section('css')

@section('title')
    add new grade
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Add new grade</h4>
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
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Name">Grade Name:</label>
                        <input type="text" name="Name" id="Name" class="form-control" value="{{ old('Name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Notes">Notes:</label>
                        <textarea name="Notes" id="Notes" class="form-control">{{ old('Notes') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Grade</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
