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
                                            <th>Exam Type</th>
                                            <th>Question Type</th>
                                            <th class="text-center" colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(@$course && $course->count() > 0 )
                                        <tr>
                                            <td>{{$course->code}}</td>
                                            <td>{{$course->title}}</td>
                                            <td>{{$course->credit}}</td>
                                            <form action="{{route('create_question',['id'=>$course->id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <td>

                                                <select class="form-control custom-select-value" name="exam_type">
                                                    <option value="Main Exam" selected>Main Exam</option>
                                                    <option value="Internal">Internal</option>
                                                </select>
                                            
                                            </td>
                                            <td>
                            
                                                <select class="form-control custom-select-value" name="question_type">
                                                    <option value="Descriptive" selected>Descriptive</option>
                                                    <option value="True or False" >True or False</option>
                                                </select>
                                                        

                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary" > CREATE QUESTIONS </button>
                                            </td> 
                                            </form>   
                                            <td>
                                                <a href="{{route('create_questionpaper',['id'=>$course->id])}}" >Create Question Paper</a>
                                            </td>                                            
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

     
    @if(@$course && $course->count() > 0 )
    <!-- Static Table Start -->
    <div class="static-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline8-list">
                        <div class="sparkline8-hd">
                            <div class="main-sparkline8-hd" id="questionpaper_list_button">
                                <h1 >Question Paper List </h1>
                                <p>(hide/show)</p>
                            </div>
                        </div>
                        <div id="questionpaper_div" class="sparkline8-graph">
                            <div class="static-table-list">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl. No.</th>
                                            <th>Question Paper Name</th>
                                            <th>Exam Type</th>
                                            <th>View</th>
                                            <th>Mapping</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(@$course->questionpapers()->paginate(10) && $course->questionpapers()->paginate(10)->count() > 0 )
                                        @foreach($course->questionpapers()->paginate(10) as $key => $questionpaper)
                                        @php $key++;  @endphp
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$questionpaper->name}}</td>
                                            <td>{{ $questionpaper->exam_type }}</td>
                                            <td><a href="{{route('questionpaper_design_view',['id'=>$questionpaper->id])}}" ><i class="fa fa-eye"></i></a></td>                                              
                                            <td><a href="{{route('questionpaper_view',['id'=>$questionpaper->id])}}" ><i class="fa fa-pencil"></i></a></td>                                              
                                            
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @if(@$course->questionpapers()->paginate(10) && $course->questionpapers()->paginate(10)->count() > 0) 
                                    {{ $course->questionpapers()->paginate(10)->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Static Table End -->   
    @endif  
     
    @if(@$course && $course->count() > 0 )
    <!-- Static Table Start -->
    <div class="static-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline8-list">
                        <div class="sparkline8-hd">
                            <div class="main-sparkline8-hd" id="question_list_button">
                                <h1 >Question List </h1>
                                <p>(hide/show)</p>
                            </div>
                        </div>
                        <div id="question_div" class="sparkline8-graph">
                            <div class="static-table-list">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl. No.</th>
                                            <th>Question Type</th>
                                            <th>Question</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(@$course->questions()->paginate(10) && $course->questions()->paginate(10)->count() > 0 )
                                        @foreach($course->questions()->paginate(10) as $key => $question)
                                        @php $key++;  @endphp
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$question->question_type}}</td>
                                            <td>{!! $question->question !!}</td>
                                            <td><a href="{{route('edit_question',['id'=>$question->id])}}" ><i class="fa fa-pencil"></i></a></td>                                              
                                            <td><a href="#" onclick="event.preventDefault(); document.getElementById('question-destroy-form-{{$question->id}}').submit();"><i class="fa fa-trash"></i></a>
                                            <form id="question-destroy-form-{{$question->id}}" action="{{route('delete_question',['id'=>$question->id])}}" method="POST" style="display:none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @if(@$course->questions()->paginate(10) && $course->questions()->paginate(10)->count() > 0) 
                                    {{ $course->questions()->paginate(10)->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
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
    </script>
@endsection