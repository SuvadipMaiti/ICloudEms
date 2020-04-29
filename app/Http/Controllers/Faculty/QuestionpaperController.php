<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Faculty;
use App\Question;
use App\Questionmapping;
use App\Orquestion;
use App\Optionalquestion;
use App\Questionpaper;
use App\DesignQuestionPaper;
use Session;
use Auth;
use Hash;

class QuestionpaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function create_questionpaper($id)
    {
        $course = Course::find($id);
        return view('faculty.create_questionpaper',compact('course'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_questionpaper2(Request $request, $id)
    {
        if (@$request->isMethod('post')) {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'exam_type' => 'required|max:255',
                'sub_exam' => 'required|max:255',
                'no_of_section' => 'required',
                'description' => 'required'
            ]);
            session(['name' => $request->name]);
            session(['exam_type' => $request->exam_type]);
            session(['sub_exam' => $request->sub_exam]);
            session(['no_of_section' => $request->no_of_section]);
            session(['description' => $request->description]);
   
        }


        $name = Session::get('name');
        $exam_type = Session::get('exam_type');
        $sub_exam = Session::get('sub_exam');
        $no_of_section = Session::get('no_of_section');
        $description = Session::get('description');
        
        $course = Course::find($id);
        return view('faculty.create_questionpaper2',compact('course','name','exam_type','sub_exam','no_of_section','description'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_questionpaper3(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bloom' => 'required|max:255',
            'section' => 'required|array|min:1',
            'section.*' => 'required'
        ]);
        $section = implode(",",$request->section);

        $questionpaper = new Questionpaper;
        $questionpaper->name = Session::get('name');
        $questionpaper->exam_type = Session::get('exam_type');
        $questionpaper->sub_exam = Session::get('sub_exam');
        $questionpaper->description = Session::get('description');
        $questionpaper->bloom = $request->bloom;
        $questionpaper->section = $section;
        $questionpaper->course = $id;
        $questionpaper->save();

        Session::flash('success','Question Paper successfully created.');
        return redirect()->route('questionpaper_view',['id'=>$questionpaper->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function questionpaper_view($id)
    {
        $questionpaper = Questionpaper::find($id);
        $section_array = explode(",",$questionpaper->section);
        $course = Course::find($questionpaper->course);
        return view('faculty.questionpaper_view',compact('course','questionpaper','section_array'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function questionpaper_design_view($id)
    {
        $designs = DesignQuestionPaper::get();
        $questionpaper = Questionpaper::find($id);
        $section_array = explode(",",$questionpaper->section);
        $course = Course::find($questionpaper->course);
        return view('faculty.questionpaper_design_view',compact('course','questionpaper','section_array','designs'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function questionpaper_designprint_view(Request $request, $id)
    {
        $difficulty_level = $request->difficulty_level;
        $exam_type = $request->exam_type;
        $design_select = DesignQuestionPaper::find($request->pattern);
        $designs = DesignQuestionPaper::get();
        $questionpaper = Questionpaper::find($id);
        $section_array = explode(",",$questionpaper->section);
        $course = Course::find($questionpaper->course);
        return view('faculty.questionpaper_design_view',compact('course','questionpaper','section_array','designs','design_select','difficulty_level','exam_type'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit_questionpaper(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question_preference' => 'required',
            'course' => 'required|max:255',
            'questionpaper' => 'required|max:255',
            'max_marks' => 'required|numeric|greater_than:0',
            'question_no' => 'required|max:255',
            'difficulty_level' => 'required|max:255',
            'section' => 'required|max:255',
            'mapping_level' => 'required|max:255',
            'max_marks' => 'required|max:255',
            'co_mapping_level' => 'required|array|min:1'
        ]);
        $co_mapping_level = implode(",",$request->co_mapping_level);

        $questionmapping = new Questionmapping;
        $questionmapping->course = $request->course;
        $questionmapping->questionpaper = $request->questionpaper;
        $questionmapping->question = $id;
        $questionmapping->max_marks = $request->max_marks;
        $questionmapping->question_no = $request->question_no;
        $questionmapping->difficulty_level = $request->difficulty_level;
        $questionmapping->section = $request->section;
        $questionmapping->mapping_level = $request->mapping_level;
        $questionmapping->max_marks = $request->max_marks;
        $questionmapping->co_mapping_level = $co_mapping_level;
        $questionmapping->question_preference = $request->question_preference;
        $questionmapping->save();

        Session::flash('success','Question Mapping successfully added.');
        return redirect()->route('questionpaper_view',['id'=>$request->questionpaper]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit_question_paper(Request $request)
    {
        if(@$request->submit)
        {
            if(@array_keys($request->submit)[0] != "or" && @array_keys($request->submit)[0] != "op" )
            {
                $id = array_keys($request->submit)[0];
                $validatedData = $request->validate([
                    'max_marks' => 'required|array|min:1',
                    'max_marks.'.$id => 'required',
                    'question_no' => 'required|array|min:1',
                    'question_no.'.$id => 'required',
                    'difficulty_level' => 'required|array|min:1',
                    'difficulty_level.'.$id => 'required',
                    'mapping_level' => 'required|array|min:1',
                    'mapping_level.'.$id => 'required',
                    'co_mapping_level' => 'required|array|min:1',
                    'co_mapping_level.'.$id => 'required',
                    'question' => 'required|array|min:1',
                    'question.'.$id => 'required',
                    'question_preference_check' => 'required',
                    'questionpaper' => 'required',
                    'course' => 'required'
                ]);
                $co_mapping_level_array =  $request->co_mapping_level[$id];  
                $co_mapping_level = implode(",",$co_mapping_level_array);

                $questionmapping = new Questionmapping;
                $questionmapping->course = $request->course;
                $questionmapping->questionpaper = $request->questionpaper;
                $questionmapping->question = $request->question[$id];
                $questionmapping->max_marks = $request->max_marks[$id];
                $questionmapping->question_no = $request->question_no[$id];
                $questionmapping->difficulty_level = $request->difficulty_level[$id];
                $questionmapping->section = $request->section[$id];
                $questionmapping->mapping_level = $request->mapping_level[$id];
                $questionmapping->co_mapping_level = $co_mapping_level;
                $questionmapping->question_preference = $request->question_preference_check;
                $questionmapping->save();
                
                Session::flash('success','Question Mapping successfully added.');
                return redirect()->route('questionpaper_view',['id'=>$request->questionpaper]);

            }

            if(@array_keys($request->submit)[0] == "or" )
            {
                // dd($last_question_key = array_key_first($request->question));
                // dd($last_question_key = array_key_last($request->question));
                $question_str = "";
                foreach($request->check_button as $id)
                {
                    $validatedData = $request->validate([
                        'max_marks' => 'required|array|min:1',
                        'max_marks.'.$id => 'required',
                        'question_no' => 'required|array|min:1',
                        'question_no.'.$id => 'required',
                        'difficulty_level' => 'required|array|min:1',
                        'difficulty_level.'.$id => 'required',
                        'mapping_level' => 'required|array|min:1',
                        'mapping_level.'.$id => 'required',
                        'co_mapping_level' => 'required|array|min:1',
                        'co_mapping_level.'.$id => 'required',
                        'question' => 'required|array|min:1',
                        'question.'.$id => 'required',
                        'question_preference_check' => 'required',
                        'questionpaper' => 'required',
                        'course' => 'required'
                    ]);

                    $co_mapping_level_array =  $request->co_mapping_level[$id];  
                    $co_mapping_level = implode(",",$co_mapping_level_array);



                    $questionmapping = new Questionmapping;
                    $questionmapping->course = $request->course;
                    $questionmapping->questionpaper = $request->questionpaper;
                    $questionmapping->question = $request->question[$id];
                    $questionmapping->max_marks = $request->max_marks[$id];
                    $questionmapping->question_no = $request->question_no[$id];
                    $questionmapping->difficulty_level = $request->difficulty_level[$id];
                    $questionmapping->section = $request->section[$id];
                    $questionmapping->mapping_level = $request->mapping_level[$id];
                    $questionmapping->co_mapping_level = $co_mapping_level;
                    $questionmapping->question_preference = $request->question_preference_check;
                    $questionmapping->save();

                    $question_str = $question_str.",".$request->question[$id];
                }


                $validatedData = $request->validate([
                    'max_marks_or' => 'required',
                    'question_no_or' => 'required',
                    'section_or' => 'required',
                    'mapping_level_or' => 'required',
                    'co_mapping_level_or' => 'required|array|min:1',
                    'co_mapping_level_or.*' => 'required',
                    'question' => 'required|array|min:1',
                    'question.*' => 'required',
                ]);

                $co_mapping_level_or_array =  $request->co_mapping_level_or;  
                $co_mapping_level_or = implode(",",$co_mapping_level_or_array);

                // $question_array =  $request->question;  
                // $question_str = implode(",",$question_array);

                $qr_ques_mapping = new Orquestion;
                $qr_ques_mapping->questions = $question_str;
                $qr_ques_mapping->course = $request->course;
                $qr_ques_mapping->questionpaper = $request->questionpaper;
                $qr_ques_mapping->question_no = $request->question_no_or;
                $qr_ques_mapping->question_marks = $request->max_marks_or;
                $qr_ques_mapping->section = $request->section_or;
                $qr_ques_mapping->mapping_level = $request->mapping_level_or;
                $qr_ques_mapping->co_mapping_level = $co_mapping_level_or;
                $qr_ques_mapping->save();


                Session::flash('success','Question Mapping successfully added.');
                return redirect()->route('questionpaper_view',['id'=>$request->questionpaper]);
            }

            if(@array_keys($request->submit)[0] == "op" )
            {
                $question_str = "";

                foreach($request->check_button as $id)
                {
                    $validatedData = $request->validate([
                        'max_marks' => 'required|array|min:1',
                        'max_marks.'.$id => 'required',
                        'question_no' => 'required|array|min:1',
                        'question_no.'.$id => 'required',
                        'difficulty_level' => 'required|array|min:1',
                        'difficulty_level.'.$id => 'required',
                        'mapping_level' => 'required|array|min:1',
                        'mapping_level.'.$id => 'required',
                        'co_mapping_level' => 'required|array|min:1',
                        'co_mapping_level.'.$id => 'required',
                        'question' => 'required|array|min:1',
                        'question.'.$id => 'required',
                        'question_preference_check' => 'required',
                        'questionpaper' => 'required',
                        'course' => 'required'
                    ]);

                    $co_mapping_level_array =  $request->co_mapping_level[$id];  
                    $co_mapping_level = implode(",",$co_mapping_level_array);

                    $questionmapping = new Questionmapping;
                    $questionmapping->course = $request->course;
                    $questionmapping->questionpaper = $request->questionpaper;
                    $questionmapping->question = $request->question[$id];
                    $questionmapping->max_marks = $request->max_marks[$id];
                    $questionmapping->question_no = $request->question_no[$id];
                    $questionmapping->difficulty_level = $request->difficulty_level[$id];
                    $questionmapping->section = $request->section[$id];
                    $questionmapping->mapping_level = $request->mapping_level[$id];
                    $questionmapping->co_mapping_level = $co_mapping_level;
                    $questionmapping->question_preference = $request->question_preference_check;
                    $questionmapping->save();

                    $question_str = $question_str.",".$request->question[$id];

                }
                

                $validatedData = $request->validate([
                    'solve_any_op' => 'required',
                    'out_of_op' => 'required',
                    'question_no_op' => 'required',
                    'max_marks_op' => 'required',
                    'section_op' => 'required'
                ]);

                // $question_array =  $request->question;  
                // $question_str = implode(",",$question_array);

                $any_ques_mapping = new Optionalquestion;
                $any_ques_mapping->questions = $question_str;
                $any_ques_mapping->course = $request->course;
                $any_ques_mapping->questionpaper = $request->questionpaper;
                $any_ques_mapping->question_no = $request->question_no_op;
                $any_ques_mapping->question_marks = $request->max_marks_op;
                $any_ques_mapping->section = $request->section_op;
                $any_ques_mapping->solve_any = $request->solve_any_op;
                $any_ques_mapping->out_of = $request->out_of_op;
                $any_ques_mapping->save();

                Session::flash('success','Question Mapping successfully added.');
                return redirect()->route('questionpaper_view',['id'=>$request->questionpaper]);

            }
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
