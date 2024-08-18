@extends('layouts.master')

@section('css')
<style>
    .d-flex {
        display: flex !important;
    }
    .justify-content-end {
        justify-content: flex-end !important;
    }
</style>
@endsection

@section('title')
    {{ trans('classroom.add_classroom') }}
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
            <a href="{{route('classroom')}}" class="btn btn-danger">
                {{ trans('classroom.cancel') }}
            </a>
            <br><br>
                <form class="row mb-30" action="{{route('classrooms.update', ['id'=>$classroom->id])}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-item>
                                <div class="row">
                                    <div class="col">
                                        <label class="mr-sm-2" for="class_name_en">{{ trans('classroom.classroom_name_en') }}</label>
                                        <input type="text" style="height: 50px" value="{{$classroom->getTranslation('class_name', 'en')}}" class="form-control" id="class_name_en" name="class_name_en">
                                        @error('class_name_en')
                                            <div class="alert alert-danger mt-2" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="mr-sm-2" for="class_name_ar">{{ trans('classroom.classroom_name_ar') }}</label>
                                        <input type="text" value="{{$classroom->getTranslation('class_name', 'ar')}}" style="height: 50px" class="form-control" id="class_name_ar" name="class_name_ar">
                                        @error('class_name_ar')
                                            <div class="alert alert-danger mt-2" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="grade_id">{{ trans('grade.grade_name_en') }}</label>
                                        <select class="form-control" style="height: 50px" id="grade_id" name="grade_id">
                                            @foreach($grade as $grade)
                                                <option value="{{$grade->id }}" {{$grade->id == $classroom->grade_id? 'selected' : ''}}>{{ $grade->getTranslation('grade', 'en') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="notes">{{ trans('classroom.notes') }}</label>
                                        <textarea style="height: 50px" class="form-control" id="notes" name="notes">{{$classroom->notes}}</textarea>
                                        @error('notes')
                                            <div class="alert alert-danger mt-2" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 15px; text-align:center; width:100%">
                            <button  type="submit" class="btn btn-success">{{ trans('classroom.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

@endpush
