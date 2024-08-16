@extends('layouts.master')

@section('css')
<!-- Add any additional CSS styles here -->
@endsection

@section('title')
    {{ trans('main_sidebar.Grades') }}
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="content-wrapper">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_sidebar.Grades') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('main_sidebar.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('main_sidebar.Grades') }}</li>
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
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('grade.create_grade') }}
                </button>
                <br><br>
                <div class="table-responsive">
                    @if(session('gradesuccess'))
                    <div class="alert alert-success" role="alert">
                        {{ session('gradesuccess') }}
                    </div>
                    @endif
                    @if(session('gradeerror'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('gradeerror') }}
                    </div>
                    @endif
                    <table class="table table-striped table-bordered p-0" id="datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{ trans('grade.grade_name_en') }}</th>
                                <th scope="col">{{ trans('grade.grade_name_ar') }}</th>
                                <th scope="col">{{ trans('grade.grade_notes') }}</th>
                                <th scope="col">{{ trans('grade.Process') }}</th>
                            </tr>
                        </thead>
                        <tbody style="">
                            @foreach ($grades as $grade)
                            <tr>
                                <td>{{ $grade->id }}</td>
                                <td>{{ $grade->getTranslation('grade', 'en')}}</td>
                                <td>{{ $grade->getTranslation('grade','ar')}}</td>
                                <td>{{ $grade->notes }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('grades.edit', ['id'=>$grade->id])}}" type="button" class="btn btn-primary mr-2 d-flex align-items-center justify-content-center">
                                            <i class="ti-pencil-alt"></i>
                                            <span class="ml-1">{{ trans('grade.edit_grade') }}</span>
                                        </a>
                                        <form action="{{ route('grades.destroy', ['id'=>$grade->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center">
                                                <i class="ti-trash"></i>
                                                <span class="ml-1">{{ trans('grade.delete_grade') }}</span>
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

    <!-- Modal Create Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('grade.create_grade') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('grades.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name_ar">{{ trans('grade.grade_name_ar') }}</label>
                                    <input type="text" class="form-control" id="Name_ar" name="Name_ar">
                                    @error('Name_ar')
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name_en">{{ trans('grade.grade_name_en') }}</label>
                                    <input type="text" class="form-control" id="Name_en" name="Name_en">
                                    @error('Name_en')
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Notes">{{ trans('grade.grade_notes') }}</label>
                            <textarea class="form-control" id="Notes" rows="3" name="Notes"></textarea>
                            @error('Notes')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grade.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('grade.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')
<!-- Add any additional JS scripts here -->
@endsection
