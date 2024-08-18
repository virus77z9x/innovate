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
            'List_Classes.*.class_name_en' => ['required', 'string', 'unique:classrooms,class_name->en', 'max:50'],
            'List_Classes.*.class_name_ar' => ['required', 'string', 'unique:classrooms,class_name->ar', 'max:50'],
            'List_Classes.*.grade_id' => ['required', 'integer'],
            'List_Classes.*.notes' => ['required', 'string', 'max:255'],
        ],[
            'List_Classes.*.class_name_en.required' => trans('validation.required'),
            'List_Classes.*.class_name_en.string' => trans('validation.string'),
            'List_Classes.*.class_name_en.max' => trans('validation.max.string', ['max' => 50]),
            'List_Classes.*.class_name_en.unique' => trans('validation.unique'),
            
            'List_Classes.*.class_name_ar.required' => trans('validation.required'),
            'List_Classes.*.class_name_ar.string' => trans('validation.string'),
            'List_Classes.*.class_name_ar.max' => trans('validation.max.string', ['max' => 50]),
            'List_Classes.*.class_name_ar.unique' => trans('validation.unique'),
            
            'List_Classes.*.grade_id.required' => trans('validation.required'),
            'List_Classes.*.grade_id.integer' => trans('validation.integer'),
            
            'List_Classes.*.notes.required' => trans('validation.required'),
            'List_Classes.*.notes.string' => trans('validation.string'),
            'List_Classes.*.notes.max' => trans('validation.max.string', ['max' => 255]),
        ]);
        
        // $classroom = Classroom::create($request->all());
        
        try{
            $lists = $request->List_Classes;
            
            foreach($lists as $list){
                $classroom = new Classroom();
                $classroom->class_name = ['en'=>$list['class_name_en'], 'ar'=>$list['class_name_ar']];
                $classroom->grade_id = $list['grade_id'];
                $classroom->notes = $list['notes'];
                $classroom->save();
            }
            return redirect()->route('classroom')->with('classroomsuccess', 'Classes added successfully');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['classerror'=>$e->getMessage()]);
        }
    }


    public function edit($id){
        $classroom = Classroom::findOrFail($id);
        $grade = Grade::get();
        return view('pages.class_edit', compact('classroom','grade'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'class_name_en' => ['required', 'string', 'max:50', 'unique:classrooms,class_name->en'],
            'class_name_ar' => ['required', 'string', 'max:50', 'unique:classrooms,class_name->ar'],
            'grade_id' => ['required', 'integer'],
            'notes' => ['required', 'string', 'max:255'],
        ],[
            'class_name_en.required' => trans('validation.required'),
            'class_name_en.string' => trans('validation.string'),
            'class_name_en.max' => trans('validation.max.string', ['max' => 50]),
            'class_name_en.unique' => trans('validation.unique'),

            'class_name_ar.required'=>trans('validation.required'),
            'class_name_ar.string'=>trans('validation.string'),
            'class_name_ar.max'=>trans('validation.max.string', ['max'=>50]),
            'class_name_ar.unique'=>trans('validation.unique'),

            'notes.required' =>trans('validation.required'),
            'notes.string' =>trans('validation.string'),
            'notes.max' =>trans('validation.max.string', ['max'=>255]),
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->class_name = ['en'=>$request->class_name_en, 'ar'=>$request->class_name_ar];
        $classroom->grade_id = $request->grade_id;
        $classroom->notes = $request->notes;
        $classroom->save();
        return redirect()->route('classroom')->with('classroomsuccess', 'Classroom updated successfully');
    }

    public function destroy($id){
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();
        return redirect()->route('classroom')->with('classroomsuccess', 'Classroom deleted successfully');
    }


}
