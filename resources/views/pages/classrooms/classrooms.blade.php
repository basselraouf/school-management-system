@extends('layouts.master')

@section('css')

@section('title')
    Classrooms
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Classrooms</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Classrooms</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
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
                    <form action="{{ route('classrooms.create') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary mx-1">Add New Classroom</button>
                    </form>
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Classroom</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classrooms as $classroom)
                                <tr>
                                    <th>{{ $classroom->id }}</th>
                                    <td>{{ $classroom->Name }}</td>
                                    <td>{{ $classroom->grade->Name }}</td>
                                    <td>
                                        <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-primary mx-1">
                                            Edit
                                        </a>
                                        <!-- Delete button -->
                                        <button type="button" class="btn btn-danger"
                                            data-toggle="modal"
                                            data-target="#deleteModal"
                                            data-id="{{ $classroom->id }}"
                                            data-name="{{ $classroom->Name }}">
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
<!-- row closed -->

<!-- delete_modal_classroom -->
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
                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    Are you sure you want to delete this classroom?
                    <input type="hidden" name="id" value="{{ $classroom->id }}">
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

@endsection

@section('js')
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var name = button.data('name')

        var modal = $(this)
        modal.find('.modal-title').text('Delete Classroom: ' + name)
        modal.find('#classroomId').val(id)
        modal.find('#deleteForm').attr('action', '/classrooms/' + id)
    })
</script>
@endsection

