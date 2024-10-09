@extends('layouts.master')
@section('css')

@section('title')
  الاقسام الدراسية
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    الاقسام الدراسية
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المرحلة</th>
                                <th>اسم الصف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($classrooms as $classroom)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $classroom->grade->Name }}</td>
                                    <td>{{ $classroom->Name}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
@endsection