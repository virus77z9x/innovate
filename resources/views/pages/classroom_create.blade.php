@extends('layouts.master')

@section('css')
<!-- Add any additional CSS styles here -->
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
                <form class="row mb-30" action="{{route('classrooms.store')}}" method="post">
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col">
                                            <label class="mr-sm-2" for="class_name_en">{{ trans('classroom.classroom_name_en') }}</label>
                                            <input type="text" class="form-control" id="class_name_en" name="class_name_en[]" required>
                                        </div>
                                        <div class="col">
                                            <label class="mr-sm-2" for="class_name_ar">{{ trans('classroom.classroom_name_ar') }}</label>
                                            <input type="text" class="form-control" id="class_name_ar" name="class_name_ar[]" required>
                                        </div>
                                        <div class="box">
                                            <label for="grade_id">{{ trans('grade.grade_name_en') }}</label>
                                            <select class="form-control" style="height: 70px" id="grade_id" name="grade_id[]">
                                                @foreach($grade as $grade)
                                                    <option value="{{$grade->id }}">{{ $grade->getTranslation('grade', 'en') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="notes">{{ trans('classroom.notes') }}</label>
                                            <textarea class="form-control" id="notes" name="notes[]"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="add_row">{{ trans('classroom.add_row') }}</button>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('classroom.save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script>
    $(document).ready(function() {
        $('.repeater').repeater({
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    
        $('#add_row').on('click', function() {
            $('.repeater').repeater('append');
        });
    });
    </script>
@endpush
