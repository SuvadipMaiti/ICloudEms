<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Faculty;
use Session;
use Hash;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::get();
        $courses = Course::paginate(10);
        return view('admin.course_list',compact('faculties','courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|max:255',
            'title' => 'required|max:255',
            'credit' => 'required|max:255'
        ]);
        
        $course_ins = new Course;
        $course_ins->code = $request->code;
        $course_ins->title = $request->title;
        $course_ins->credit = $request->credit;
        $course_ins->save(); 

        if(@$request->faculty){
            $faculty_ins = Course::find($course_ins->id)->faculties()->attach($request->faculty);
        }   

        if(@$course_ins){
            Session::flash('success','Course successfully created.');
            return redirect()->route('course.index');
        }else{
            Session::flash('error','Course not created.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course)
    {
        $faculties = Faculty::get();
        $courses = Course::paginate(10);
        $course_edit = Course::find($course);
        return view('admin.course_list',compact('faculties','courses','course_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course)
    {
        $validatedData = $request->validate([
            'code' => 'required|max:255',
            'title' => 'required|max:255',
            'credit' => 'required|max:255'
        ]);
        
        $course_up = Course::find($course);
        $course_up->code = $request->code;
        $course_up->title = $request->title;
        $course_up->credit = $request->credit;
        $course_up->save(); 
        
        if(@$request->faculty){
            $faculty_detach = Course::find($course_up->id)->faculties()->detach();
            $faculty_up = Course::find($course_up->id)->faculties()->attach($request->faculty);
        }

        if(@$course_up){
            Session::flash('success','Course Details Updated.');
            return redirect()->route('course.index');
        }else{
            Session::flash('error','Course Details not Updated.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course)
    {
        $course_del = Course::find($course);
        $faculty_detach = Course::find($course)->faculties()->detach();
        if(!empty($course_del)){
            $course_del->delete();
            Session::flash('success','Course data Deleted');
            return redirect()->route('course.index');
        }else{
            Session::flash('error','Course data not Deleted');
            return redirect()->back();
        }
    }
}
