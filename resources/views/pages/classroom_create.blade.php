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
                <form class="row mb-30" action="{{route('classrooms.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col">
                                            <label class="mr-sm-2" for="class_name_en">{{ trans('classroom.classroom_name_en') }}</label>
                                            <input type="text" style="height: 50px" class="form-control" id="class_name_en" name="List_Classes[][class_name_en]">
                                            @error('List_Classes.*.class_name_en')
                                                <div class="alert alert-danger mt-2" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="mr-sm-2" for="class_name_ar">{{ trans('classroom.classroom_name_ar') }}</label>
                                            <input type="text" style="height: 50px" class="form-control" id="class_name_ar" name="List_Classes[][class_name_ar]">
                                            @error('List_Classes.*.class_name_ar')
                                                <div class="alert alert-danger mt-2" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="grade_id">{{ trans('grade.grade_name_en') }}</label>
                                            <select class="form-control" style="height: 50px" id="grade_id" name="List_Classes[][grade_id]">
                                                @foreach($grade as $grade)
                                                    <option value="{{$grade->id }}">{{ $grade->getTranslation('grade', 'en') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="notes">{{ trans('classroom.notes') }}</label>
                                            <textarea style="height: 50px" class="form-control" id="notes" name="List_Classes[][notes]"></textarea>
                                            @error('List_Classes.*.notes')
                                                <div class="alert alert-danger mt-2" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div style="margin-top: 35px">
                                            <button type="button" class="btn btn-danger" data-repeater-delete>{{ trans('classroom.delete_row') }}</button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary" id="add_row" data-repeater-create>{{ trans('classroom.add_row') }}</button>
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
<script>
    $(document).ready(function() {
        $('.repeater').repeater({
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement, function() {
                    $(this).remove();
                });
            }
        });

        $('#add_row').on('click', function() {
            $('.repeater').repeater('append');
        });
    });
</script>
@endpush
