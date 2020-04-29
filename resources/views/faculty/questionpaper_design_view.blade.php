@extends('layouts.appFaculty')
@section('title') Course View @endsection
@section('breadcrumb') 
    <a href="{{route('questionpaper_design_view',['id'=>$questionpaper->id])}}">Question Paper Design</a> <span class="bread-slash">/</span>
@endsection
@section('breadcrumbSub') Question Paper Design Print @endsection

@section('style')
    <!-- modals CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/modals.css')}}">
@endsection

@section('content')






    <!-- Static Table Start -->
    <div class="static-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline8-list">

                        <div class="sparkline8-hd">
                            @if(@$design_select)
                                {!! $design_select->pattern !!}
                            @else
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 text-center" style="font-size:30px;">Question Paper</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-center" style="font-size:20px;">
                                        PAPER : {{$questionpaper->name}}</div>
                                    @if(@$exam_type)    
                                    <div class="col-md-6 text-center" style="font-size:20px;">
                                        EXAM : {{$questionpaper->exam_type}}</div>
                                    @endif    
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center" style="font-size:20px;">
                                        TYPE : {{$questionpaper->sub_exam}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center" style="font-size:20px;">
                                        {!! $questionpaper->description !!}</div>
                                </div>
                            </div>
                            @endif
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
                                                        @if(@$difficulty_level == 1)
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                             @if($quesCount == 1) Difficult Level @endif
                                                        </div>
                                                        @endif
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
                                                        @if(@$difficulty_level == 1)
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                            [ {{ @$mapping->difficulty_level }} ]
                                                        </div>
                                                        @endif
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
                                                                    @if(@$difficulty_level == 1)
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                         @if($quesCount == 1) Difficult Level @endif
                                                                    </div>
                                                                    @endif
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
                                                                    @if(@$difficulty_level == 1)
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        [ {{ @$questionpaper->questionsmappingFilterQu($question)->difficulty_level }} ]
                                                                    </div>
                                                                    @endif
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
                                                                    @if(@$difficulty_level == 1)
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                         @if($quesCount == 1) Difficult Level @endif
                                                                    </div>
                                                                    @endif
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
                                                                    @if(@$difficulty_level == 1)
                                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                                                        [ {{ @$questionpaper->questionsmappingFilterQu($question)->difficulty_level }} ]
                                                                    </div>
                                                                    @endif
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
      
  



    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="questionDesignModal" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('questionpaper_designprint_view',['id'=>$questionpaper->id]) }}">
                        @csrf
                        <div class="modal-header header-color-modal bg-color-1">
                            <h4 class="modal-title">Sample Question Paper</h4>
                            <div class="modal-close-area modal-close-df">
                                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                            </div>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-2">
                                    Difficult Level :
                                </div>
                                <div class="col-md-10">
                                    <input id="" type="radio" class="" name="difficulty_level" checked value="1" >Show/
                                    <input id="" type="radio" class="" name="difficulty_level" value="0" >Hide
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    Exam Type :
                                </div>
                                <div class="col-md-10">
                                    <input id="" type="radio" class="" name="exam_type" checked value="1" >Show/
                                    <input id="" type="radio" class="" name="exam_type" value="0" >Hide
                                </div>
                            </div>
                            <div class="row">
                                @if(@$designs)
                                    @foreach($designs as $key => $design)
                                        @php $key++; @endphp
                                        <label for="pattern" class="col-md-4 col-form-label text-md-right">Pattern {{$key}} :</label>
                                        <div class="col-md-2">
                                            <input id="" type="radio" class="" name="pattern" value="{{$key}}" >
                                        </div>
                                        {!! $design->pattern !!}
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-primary" >Cancel</button>
                            <button type="submit" class="btn btn-primary">View</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    
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
    @if(!@$design_select)
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#questionDesignModal').modal('show');
        });
    </script>
    @endif
@endsection