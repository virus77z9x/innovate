@extends('layouts.master')

@section('css')
<!-- Add any additional CSS styles here -->
@endsection

@section('title')
    {{ trans('main_sidebar.classrooms') }}
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="content-wrapper">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('classroom.classrooms') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('main_sidebar.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('classroom.classroom') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a href="{{route('classrooms.create')}}" class="button x-small">
                    {{ trans('classroom.add_classroom') }}
                </a>
                
                <br><br>
                <div class="table-responsive">
                    @if(session('classroomsuccess'))
                    <div class="alert alert-success" role="alert">
                        {{ session('classroomsuccess') }}
                    </div>
                    @endif
                    @if(session(' classroomerror'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('classroomerror') }}
                    </div>
                    @endif
                    <table class="table table-striped table-bordered p-0" id="datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{ trans('classroom.classroom_name_en') }}</th>
                                <th scope="col">{{ trans('classroom.classroom_name_ar') }}</th>
                                <th scope="col">{{ trans('grade.grade_name_en') }}</th>
                                <th scope="col">{{ trans('grade.grade_name_ar') }}</th>
                                <th scope="col">{{ trans('classroom.classroom_notes') }}</th>
                                <th scope="col">{{ trans('classroom.process') }}</th>
                            </tr>
                        </thead>
                        <tbody style="">
                            @foreach ($classroom as $classroom)
                            <tr>
                                <td>{{ $classroom->id }}</td>
                                <td>{{ $classroom->getTranslation('class_name', 'en')}}</td>
                                <td>{{ $classroom->getTranslation('class_name', 'ar') }}</td>
                                <td>{{ $classroom->grade->getTranslation('grade', 'en')}}</td>
                                <td>{{ $classroom->grade->getTranslation('grade', 'ar')}}</td>
                                <td>{{ $classroom->notes }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('classrooms.edit', ['id'=>$classroom->id])}}" type="button" class="btn btn-primary mr-2 d-flex align-items-center justify-content-center">
                                            <i class="ti-pencil-alt"></i>
                                            <span class="ml-1">{{ trans('classroom.edit_classroom') }}</span>
                                        </a>
                                        <form action="{{ route('classrooms.destroy', ['id'=>$classroom->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center">
                                                <i class="ti-trash"></i>
                                                <span class="ml-1">{{ trans('classroom.delete_classroom') }}</span>
                                            </button>
                                        </form>
                                    </div>
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
@endsection
