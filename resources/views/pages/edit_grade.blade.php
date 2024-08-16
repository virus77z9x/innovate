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

<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
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
                   <form action="{{route('grades.update', ['id'=>$grade->id])}}" method="post">
                   @csrf 
                   <table class="table table-striped table-bordered p-0" id="datatable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ trans('grade.grade_name_en') }}</th>
                            <th scope="col">{{ trans('grade.grade_name_ar') }}</th>
                            <th scope="col">{{ trans('grade.grade_notes') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input value="{{$grade->getTranslation('grade', 'en')}}" type="text" class="form-control" id="Name_en" name="Name_en">
                                    @error('Name_en')
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>

                                <td>
                                    <input value="{{$grade->getTranslation('grade', 'ar')}}" type="text" class="form-control" id="Name_ar" name="Name_ar">
                                    @error('Name_ar')
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>

                                <td>
                                    <textarea class="form-control" id="Notes" rows="3" name="Notes">{{$grade->notes}}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{route('grades')}}" class="btn btn-danger">Cancel</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- Add any additional JS scripts here -->
@endsection