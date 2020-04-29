@extends('layouts.appFaculty')
@section('title') Course View @endsection
@section('breadcrumb') 
    <a href="{{route('faculty.home')}}">Home</a> <span class="bread-slash">/</span>
@endsection
@section('breadcrumbSub') Course View @endsection

@section('style')

@endsection

@section('content')


    <!-- Static Table Start -->
    <div class="static-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline8-list">
                        <div class="sparkline8-hd">
                            <div class="main-sparkline8-hd">
                                <h1>Course</h1>
                            </div>
                        </div>
                        <div class="sparkline8-graph">
                            <div class="static-table-list">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Title</th>
                                            <th>Course Credit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(@$course && $course->count() > 0 )
                                        <tr>
                                            <td>{{$course->code}}</td>
                                            <td>{{$course->title}}</td>
                                            <td>{{$course->credit}}</td>
                                                                                
                                        </tr>
                                        @endif
                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Static Table End --> 



    <!-- Static Table Start -->
    <div class="static-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline8-list">
                        <div class="sparkline8-hd">
                            <div class="main-sparkline8-hd" id="questionpaper_list_button">
                                <h1>Create Question Paper</h1>
                                <p>(hide/show)</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                    <h4>PAPER : {{$questionpaper->name}}</h4>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                    <h4>EXAM : {{$questionpaper->exam_type}}</h4>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                    <h4>TYPE : {{$questionpaper->sub_exam}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <h4>{!! $questionpaper->description !!}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="sparkline8-graph" id="questionpaper_div">
                            <div class="static-table-list">
                                <!-- question paper start -->
                                @if(@$section_array)
                                    @foreach($section_array as $section)
                                        @if(@$questionpaper->questionsmappingFilter($section))
                                            @php $secCount = 0; $quesCount = 0; @endphp


                                            @foreach($questionpaper->questionsmappingFilter($section) as $mapping)
                                                @if(@$mapping->question_preference && $mapping->question_preference == "MANDATORY")
                                                    @php $secCount++; $quesCount++; @endphp
                                                    @if($secCount == 1)
                                                    <h5 class="text-center">SECTION - {{$section}}</h5> 
                                                    @endif
                                                    @if($quesCount == 1)
                                                    <h6 class="text-center">MANDATORY QUESTIONS</h6>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center"></div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center ">
                                                             @if($quesCount == 1) Question Marks @endif
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                             @if($quesCount == 1) Difficult Level @endif
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                             @if($quesCount == 1) Mapping level @endif
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
                                                             @if($quesCount == 1) Co Mapping Level @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                            {{ @$mapping->question_no }}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                                            {!! @$mapping->questionData->question !!}
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                            [ {{ @$mapping->max_marks }} ]
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                            [ {{ @$mapping->mapping_level }} ]
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                            [ {{ @$mapping->difficulty_level }} ]
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
                                                            [ {{ @implode(',',$mapping->co_mapping_level) }} ]
                                                        </div>
                                                    </div>                                                    
                                                @endif
                                            @endforeach



                                            @if(@$questionpaper->orquestionFilter($section))
                                                @foreach($questionpaper->orquestionFilter($section) as $orquestion)
                                                    @if(@explode(',',$orquestion->questions))
                                                        @php $quesCount = 0; @endphp
                                                        @foreach(explode(',',$orquestion->questions) as $question)
                                                            @if(@$questionpaper->questionsmappingFilterQu($question))
                                                            @php $secCount++; $quesCount++; @endphp
                                                            @if($secCount == 1)
                                                            <h5 class="text-center">SECTION - {{$section}}</h5>
                                                            @endif
                                                            @if($quesCount == 1)
                                                            <!-- <h6 class="text-center">OR QUESTIONS</h6> -->
                                                            @endif
                                                                <div class="row">
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center"></div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center ">
                                                                         @if($quesCount == 1) Question Marks @endif
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                         @if($quesCount == 1) Difficult Level @endif
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                         @if($quesCount == 1) Mapping level @endif
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
                                                                         @if($quesCount == 1) Co Mapping Level @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        {{ @$questionpaper->questionsmappingFilterQu($question)->question_no }}
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                                                        {!! @$questionpaper->questionsmappingFilterQu($question)->questionData->question !!}
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        [ {{ @$questionpaper->questionsmappingFilterQu($question)->max_marks }} ]
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        [ {{ @$questionpaper->questionsmappingFilterQu($question)->mapping_level }} ]
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        [ {{ @$questionpaper->questionsmappingFilterQu($question)->difficulty_level }} ]
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
                                                                        [ {{ @implode(',',$questionpaper->questionsmappingFilterQu($question)->co_mapping_level) }} ]
                                                                    </div>
                                                                </div>                                                               @if($quesCount == 1)
                                                                <h6 class="text-center">OR</h6>
                                                                @endif                                                             
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif


                                            @if(@$questionpaper->optionalquestionFilter($section))
                                                @foreach($questionpaper->optionalquestionFilter($section) as $optionalquestion)
                                                    @if(@explode(',',$optionalquestion->questions))
                                                        @php $quesCount = 0; @endphp
                                                        @foreach(explode(',',$optionalquestion->questions) as $question)
                                                            @if(@$questionpaper->questionsmappingFilterQu($question))
                                                            @php $secCount++; $quesCount++; @endphp
                                                            @if($secCount == 1)
                                                            <h5 class="text-center">SECTION - {{$section}}</h5>
                                                            @endif

                                                            @if($quesCount == 1)
                                                            <h6 class="text-center">OPTIONAL QUESTIONS ( Solve any  {{@$optionalquestion->solve_any}} question out of {{@$optionalquestion->out_of}} questions.)</h6>
                                                            @endif
                                                                <div class="row">
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center"></div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center ">
                                                                         @if($quesCount == 1) Question Marks @endif
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                         @if($quesCount == 1) Difficult Level @endif
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                         @if($quesCount == 1) Mapping level @endif
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
                                                                         @if($quesCount == 1) Co Mapping Level @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        {{ @$questionpaper->questionsmappingFilterQu($question)->question_no }} 
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                                                        {!! @$questionpaper->questionsmappingFilterQu($question)->questionData->question !!}
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        [ {{ @$questionpaper->questionsmappingFilterQu($question)->max_marks }} ]
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        [ {{ @$questionpaper->questionsmappingFilterQu($question)->mapping_level }} ]
                                                                    </div>
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        [ {{ @$questionpaper->questionsmappingFilterQu($question)->difficulty_level }} ]
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
                                                                        [ {{ @implode(',',$questionpaper->questionsmappingFilterQu($question)->co_mapping_level) }} ]
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif


                                        @endif
                                    @endforeach
                                @endif
                                <!-- question paper end -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Static Table End --> 
      
     
    @if(@$course && $course->count() > 0 )
    <!-- Static Table Start -->
    <div class="static-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline8-list">
                    <form action="{{route('submit_question_paper')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="sparkline8-hd">
                            <div class="main-sparkline8-hd" id="question_list_button">
                                <h1 >Question List </h1>
                                <p>(hide/show)</p>
                            </div>
                            <div class="row form-control">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                    <span class="text-danger">*</span>
                                    <input type="radio"  checked name="question_preference_check" value="MANDATORY" >MANDATORY
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                    <input type="radio" name="question_preference_check" value="OR" >OR
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                    <input type="radio" name="question_preference_check" value="OPTIONAL" >OPTIONAL
                                </div>
                            </div> 
                            <div class="row form-control" id="or_div" style="display:none;"> 
                                <div class="col-lg-12 col-md-12 col-sm-2 col-xs-12 text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Question No(1a,1b)</th>
                                            <th>Max Marks</th>
                                            <th>Section</th>
                                            <th>Mapping Level</th>
                                            <th>Co Mapping Level</th>
                                            <th>Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="question_no_or" id="question_no_or" >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="max_marks_or" id="max_marks_or"  >
                                            </td>
                                            <td>
                                                <select class="form-control custom-select-value" id="section_or" name="section_or">
                                                    @if(@$section_array)
                                                        @foreach($section_array as $section)
                                                            <option value="{{$section}}" >{{$section}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control custom-select-value" id="mapping_level_or" name="mapping_level_or">
                                                    <option value="" >select</option>
                                                    <option value="none" >none</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control custom-select-value" multiple id="co_mapping_level_or" name="co_mapping_level_or[]">
                                                    <option value="CO1"  >CO1</option>
                                                    <option value="CO2" >CO2</option>
                                                    <option value="CO3" >CO3</option>
                                                    <option value="CO4" >CO4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="submit" class="btn btn-primary" name="submit[or]" value="Add" id="submit_or" style="display:none;" >
                                            </td>                                                                                    
                                        </tr>
                        
                                    </tbody>
                                </table>
                                </div>
                            </div>  
                            <div class="row form-control" id="optional_div" style="display:none;"> 
                                <div class="col-lg-12 col-md-12 col-sm-2 col-xs-12 text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Solve Any</th>
                                            <th>Out Of</th>
                                            <th>Question No(1a,1b)</th>
                                            <th>Max Marks</th>
                                            <th>Section</th>
                                            <th>Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
                                        <tr>
 
                                            <td>
                                                <input type="text" class="form-control" name="solve_any_op" id="solve_any_op" >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="out_of_op" id="out_of_op"  >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="question_no_op" id="question_no_op" >
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="max_marks_op" id="max_marks_op"  >
                                            </td>
                                            <td>
                                                <select class="form-control custom-select-value" id="section_op" name="section_op">
                                                    @if(@$section_array)
                                                        @foreach($section_array as $section)
                                                            <option value="{{$section}}"  >{{$section}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <input type="submit" class="btn btn-primary" name="submit[op]" value="Add" id="submit_op" style="display:none;" >
                                            </td>                                                                                    
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>  

                        </div>
                        <div id="question_div" class="sparkline8-graph">
                            <div class="static-table-list">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl. No. </th>
                                            <th>Question Type</th>
                                            <th>Question</th>
                                            <th>Max Marks</th>
                                            <th>Question No(1a,1b)</th>
                                            <th>Difficulty Level</th>
                                            <th>Section</th>
                                            <th>Mapping Level</th>
                                            <th>Co Mapping Level</th>
                                            <th>Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(
                                            @$course
                                            ->questionsExamTypeWise($questionpaper->exam_type)
                                            ->paginate(10) 
                                            && 
                                            $course
                                            ->questionsExamTypeWise($questionpaper->exam_type)
                                            ->paginate(10)
                                            ->count() > 0 
                                        )
                                        
                                        @foreach(
                                                $course
                                                ->questionsExamTypeWise($questionpaper->exam_type)
                                                ->paginate(10) 
                                                as $key => $question
                                        )
                                        @php $key++;  @endphp
            
                                        <tr>
                                            <td>
                                            {{$key}} 
                                            @if(!@$question->questionsmappingFilter($question->course,$questionpaper->id))
                                                <input type="checkbox" name="check_button[{{$question->id}}]" id="check_button_{{$question->id}}" onclick="checkButtonHideFun(this.value)"; value="{{$question->id}}"  class="check_button" style="display:none;" >
                                            @endif    
                                            </td>
                                            <td>{{$question->question_type}}</td>
                                            <td>{!! $question->question !!}</td>

                                            <td>
                                                <input type="number" class="form-control" name="max_marks[{{$question->id}}]" id="" value="{{@$question->questionsmappingFilter($question->course,$questionpaper->id)->max_marks}}" >
                                            </td>

                                            <td><input type="text" class="form-control" name="question_no[{{$question->id}}]" id="" value="{{@$question->questionsmappingFilter($question->course,$questionpaper->id)->question_no}}" ></td>
                                            <td>
                                            <select class="form-control custom-select-value" id="" name="difficulty_level[{{$question->id}}]" >
                                                <option value="0" @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->difficulty_level == 0) selected @endif >0</option>
                                                <option value="1" @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->difficulty_level == 1) selected @endif >1</option>
                                                <option value="2" @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->difficulty_level == 2) selected @endif >2</option>
                                                <option value="3" @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->difficulty_level == 3) selected @endif >3</option>
                                            </select>
                                            </td>
                                            <td>
                                            <select class="form-control custom-select-value" id="" name="section[{{$question->id}}]">
                                                @if(@$section_array)
                                                    @foreach($section_array as $section)
                                                        <option value="{{$section}}"
                                                            @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->section == $section) selected @endif >{{$section}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            </td>
                                            <td>
                                                <select class="form-control custom-select-value" id="" name="mapping_level[{{$question->id}}]">
                                                    <option value="" >select</option>
                                                    <option value="none"
                                                        @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->mapping_level == "none") selected @endif >
                                                        none
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                            <select class="form-control custom-select-value" multiple id="" name="co_mapping_level[{{$question->id}}][]">
                                                <option value="CO1" 
                                                    @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->co_mapping_level
                                                    && 
                                                    in_array("CO1",$question->questionsmappingFilter($question->course,$questionpaper->id)->co_mapping_level)) selected @endif
                                                 >CO1</option>
                                                <option value="CO2"
                                                     @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->co_mapping_level
                                                      && 
                                                      in_array("CO2",$question->questionsmappingFilter($question->course,$questionpaper->id)->co_mapping_level)) selected @endif 
                                                 >CO2</option>
                                                <option value="CO3" 
                                                    @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->co_mapping_level 
                                                    &&
                                                    in_array("CO3",$question->questionsmappingFilter($question->course,$questionpaper->id)->co_mapping_level)) selected @endif
                                                  >CO3</option>
                                                <option value="CO4"
                                                     @if(@$question->questionsmappingFilter($question->course,$questionpaper->id)->co_mapping_level 
                                                     &&
                                                     in_array("CO4",$question->questionsmappingFilter($question->course,$questionpaper->id)->co_mapping_level)) selected @endif
                                                 >CO4</option>
                                            </select>
                                            </td>
                                            <td>  
                                            @if(!@$question->questionsmappingFilter($question->course,$questionpaper->id))
                                            <input type="hidden" class="btn btn-primary" name="question[{{$question->id}}]" value="{{$question->id}}" id="question" >
                                            <input type="hidden" class="btn btn-primary" name="questionpaper" value="{{$questionpaper->id}}" id="questionpaper" >
                                            <input type="hidden" class="btn btn-primary" name="course" value="{{$questionpaper->course}}" id="course" >
                                            <input type="submit" class="btn btn-primary" name="submit[{{$question->id}}]" value="Add" id="submit_{{$question->id}}" >
                                            @else
                                            <div class="btn btn-primary"> Added </div>
                                            @endif
                                            </td>                                                                                    
                                        </tr>
                                        @endforeach
                                        
                                        @endif
                                    </tbody>
                                </table>
                                @if(
                                    @$course
                                    ->questionsExamTypeWise($questionpaper->exam_type)
                                    ->paginate(10) 
                                    && 
                                    $course
                                    ->questionsExamTypeWise($questionpaper->exam_type)
                                    ->paginate(10)
                                    ->count() > 0
                                ) 
                                    {{ $course
                                    ->questionsExamTypeWise($questionpaper->exam_type)
                                    ->paginate(10)
                                    ->links() }}

                                @endif
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Static Table End -->   
    @endif
    
@endsection

@section('script')
    <!-- data table JS
		============================================ -->
    <script src="{{asset('facultypanel/js/data-table/bootstrap-table.js')}}"></script>
    <script src="{{asset('facultypanel/js/data-table/tableExport.js')}}"></script>
    <script src="{{asset('facultypanel/js/data-table/data-table-active.js')}}"></script>
    <script src="{{asset('facultypanel/js/data-table/bootstrap-table-editable.js')}}"></script>
    <script src="{{asset('facultypanel/js/data-table/bootstrap-editable.js')}}"></script>
    <script src="{{asset('facultypanel/js/data-table/bootstrap-table-resizable.js')}}"></script>
    <script src="{{asset('facultypanel/js/data-table/colResizable-1.5.source.js')}}"></script>
    <script src="{{asset('facultypanel/js/data-table/bootstrap-table-export.js')}}"></script>

    <script>
        $('#question_list_button').click(function(){
            $('#question_div').toggle();
        });
        $('#questionpaper_list_button').click(function(){
            $('#questionpaper_div').toggle();
        });

        $(document).ready(function(){
            $("input[name='question_preference_check']").click(function(){
                var radioValue = $("input[name='question_preference_check']:checked").val();
                if(radioValue){
                    if(radioValue == "OR")
                    {
                        $('#or_div').show();
                        $('#optional_div').hide();
                        $('.check_button').show();

                    }
                    else if(radioValue == "OPTIONAL")
                    {
                        $('#or_div').hide();
                        $('#optional_div').show();
                        $('.check_button').show();


                    }
                    else
                    {
                        $('#or_div').hide();
                        $('#optional_div').hide();
                        $('.check_button').hide();

                    }
                }
            });
            
        });

        function checkButtonHideFun(id)
        {
            var btnid = "submit_" + id;
            var checkbtn = "check_button_" + id;
            var st = document.getElementById(checkbtn).checked;
            var countChecked = document.querySelectorAll('input[class="check_button"]:checked').length;
            var radioValue = $("input[name='question_preference_check']:checked").val();
            if(radioValue){
                if(radioValue == "OR" && countChecked > 2)
                {
                    document.getElementById(checkbtn).checked = false;
                }else{
                    if(st)
                    {
                        document.getElementById(btnid).style.display = "none";
                        document.getElementById('submit_or').style.display = "block";
                        document.getElementById('submit_op').style.display = "block";
                    }
                    else
                    {
                        document.getElementById(btnid).style.display = "block";
                        if(countChecked == 0){
                            document.getElementById('submit_or').style.display = "none";
                            document.getElementById('submit_op').style.display = "none";
                        }
                    } 
                }            
            }          
        }


       
    </script>
@endsection