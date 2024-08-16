<?php

namespace App\Http\Controllers;
use App\Models\Grade;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(){
        $grades = Grade::all();
        
        return view("pages.grades", compact('grades'));
    }

    public function store(Request $request){

        if(Grade::where('grade->ar', $request->Name_ar)->orWhere('grade->en', $request->Name_en)->exists()){
            return redirect()->route('grades')->with('gradeerror', trans('grade.grade_already_exists'));
        }
        $request->validate([
            'Name_ar' => ['required','string','max:20'],
            'Name_en' => ['required','string','max:20'],
            'Notes' => ['required', 'string','max:255'],

        ],[
            'Name_ar.required' => trans('validation.required'),
            'Name_ar.string' => trans('validation.string'),
            'Name_ar.max' => trans('validation.max.string', ['max' => 20]),

            'Name_en.required' => trans('validation.required'),
            'Name_en.string' => trans('validation.string'),
            'Name_en.max' => trans('validation.max.string', ['max' => 20]),

            'Notes.required' => trans('validation.required'),
            'Notes.string' => trans('validation.string'),
            'Notes.max' => trans('validation.max.string', ['max' => 255]),
        ]);

        $grade = new Grade();
        $grade
        ->setTranslation('grade', 'en', $request->Name_en)
        ->setTranslation('grade', 'ar', $request->Name_ar)
        ->save();
        $grade->notes = $request->Notes;
        $saved = $grade->save();
        if($saved){
            return redirect()->route('grades')->with('gradesuccess', trans('grade.grade_updated_successfully'));
        }else{
            return redirect()->route('grades')->with('gradeerror', trans('grade.grade_update_failed'));
        }
    }

    public function edit($id){

        $grade = Grade::where('id', '=', $id)->first();
        return view("pages.edit_grade", compact('grade'));
    }

    public function update(Request $request, $id){
        if(Grade::where('grade->ar', $request->Name_ar)->orWhere('grade->en', $request->Name_en)->exists()){
            return redirect()->route('grades')->with('gradeerror', trans('grade.grade_already_exists'));
        }
        $request->validate([
            'Name_ar' => ['required','string','max:20'],
            'Name_en' => ['required','string','max:20'],
            'Notes' => ['required', 'string','max:255'],

        ],[
            'Name_ar.required' => trans('validation.required'),
            'Name_ar.string' => trans('validation.string'),
            'Name_ar.max' => trans('validation.max.string', ['max' => 20]),

            'Name_en.required' => trans('validation.required'),
            'Name_en.string' => trans('validation.string'),
            'Name_en.max' => trans('validation.max.string', ['max' => 20]),

            'Notes.required' => trans('validation.required'),
            'Notes.string' => trans('validation.string'),
            'Notes.max' => trans('validation.max.string', ['max' => 255]),
        ]);

        $grade = Grade::find($id);
        $grade
        ->setTranslation('grade', 'en', $request->Name_en)
        ->setTranslation('grade', 'ar', $request->Name_ar)
        ->save();
        $grade->notes = $request->Notes;
        $saved = $grade->save();

        if($saved){
            return redirect()->route('grades', ['id'=>$id])->with('gradesuccess', trans('grade.grade_updated_successfully'));
        }else{
            return redirect()->route('grades.edit', ['id'=>$id])->with('gradeerror', trans('grade.error_updating_grade'));
        }
    }

    public function destroy($id){
        $grade = Grade::find($id);
        $grade->delete();
        return redirect()->route('grades')->with('gradesuccess', trans('grade.grade_deleted_successfully'));
    }
}
