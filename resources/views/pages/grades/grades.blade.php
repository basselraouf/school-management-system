@extends('layouts.master')
@section('css')

@section('title')
    Grades
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Grades</h4>
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
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
    <div class="card-body">

    <div class="table-responsive">
        <form action="{{ route('grades.create') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary mx-1">Add New Grade</button>
        </form>
    <table id="datatable" class="table table-striped table-borded p-0">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Notes</th>
            <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
        <tr>
            <th>{{$grade->id}} </th>
            <td>{{$grade->Name}}</td>
            <td>{{$grade->Notes}}</td>
            <td>
                <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-primary mx-1">
                    Edit
                </a>
                <button type="button" class="btn btn-danger"
                    data-toggle="modal"
                    data-target="#deleteModal"
                    data-id="{{ $grade->id }}"
                    data-name="{{ $grade->Name }}">
                    Delete
                </button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
        </div>
    </div>

<!-- delete_modal_Grade -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Classroom</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    Are you sure you want to delete this grade?
                    <input type="hidden" name="id" value="{{ $grade->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
