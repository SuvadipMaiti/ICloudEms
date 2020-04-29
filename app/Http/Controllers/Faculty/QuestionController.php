<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Faculty;
use App\Question;
use Session;
use Auth;
use Hash;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course_list()
    {
        $courses = Faculty::find(Auth::user()->id)->courses;
        return view('faculty.course_list',compact('courses'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function course_view($id)
    {
        $course = Course::find($id);
        return view('faculty.course_view',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_question(Request $request, $id)
    {
        if (@$request->isMethod('post')) {
        session(['question_type' => $request->question_type]);
        session(['exam_type' => $request->exam_type]);
        }
        $question_type = Session::get('question_type');
        $exam_type = Session::get('exam_type');
        $course =  Course::find($id);
        return view('faculty.create_question',compact('course','question_type','exam_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit_question(Request $request)
    {
        $validatedData = $request->validate([
            'course' => 'required|max:255',
            'exam_type' => 'required|max:255',
            'question_type' => 'required|max:255',
            'question' => 'required'
        ]);
        if(@$request->question_edit_id)
        {
            $question =  Question::find($request->question_edit_id);
            Session::flash('success','Question successfully updated.');
        }
        else
        {
            $question = new Question;
            Session::flash('success','Question successfully created.');
        }
            $question->course = $request->course;
            $question->exam_type = $request->exam_type;
            $question->question_type = $request->question_type;
            $question->question = $request->question;
            $question->save();

        return redirect()->back();

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_question($id)
    {
        $question_edit = Question::find($id);
        $question_type = $question_edit->question_type;
        $exam_type = $question_edit->exam_type;
        $course = Course::find($question_edit->course);
        return view('faculty.create_question',compact('course','question_type','exam_type','question_edit'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_question($id)
    {
        $question_del = Question::find($id);
        if(!empty($question_del)){
            $question_del->delete();
            Session::flash('success','Question data Deleted');
            return redirect()->back();
        }else{
            Session::flash('error','Question data not Deleted');
            return redirect()->back();
        }
    }
}
