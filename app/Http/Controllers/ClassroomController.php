<?php

namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(){
        $classroom = Classroom::get();
        $grade = Grade::get();
        return view("pages.classroom", compact('classroom', 'grade'));
    }

    public function create(){
        $grade = Grade::get();
        return view("pages.classroom_create", compact('grade'));
    }

    public function store(Request $request){
        $request->validate([
            'class_name_en' => ['required','string','max:20'],
            'class_name_ar' => ['required','string','max:20'],
            'grade_id' => ['required','integer'],
            'notes' => ['required','string','max:255'],

        ],[
            'class_name_en.required' => trans('validation.required'),
            'class_name_en.string' => trans('validation.string'),
            'class_name_en.max' => trans('validation.max.string', ['max' => 20]),

            'class_name_ar.required' => trans('validation.required'),
            'class_name_ar.string' => trans('validation.string'),
            'class_name_ar.max' => trans('validation.max.string', ['max' => 20]),
        ]);
    }
}
