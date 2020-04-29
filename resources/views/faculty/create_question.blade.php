@extends('layouts.appFaculty')
@section('title') Dashboard @endsection
@section('breadcrumb') 
    <a href="{{route('course_view',['id'=>$course->id])}}">Course View</a> <span class="bread-slash">/</span>
@endsection
@section('breadcrumbSub') @if(@$question_edit) Edit @else Add @endif Question @endsection

@section('style')
    <!-- summernote CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/summernote/summernote.css')}}">
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
                                    <h1> @if(@$question_edit) Edit @else Add @endif  a Question</h1>
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
        @if(@$course && $course->count() > 0 )
        <!-- tinymce Start-->
            <div class="tinymce-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form method="post" action="{{route('submit_question')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="tinymce-single responsive-mg-b-30">
                                <div class="alert-title">
                                    <h2>Question</h2>
                                </div>
                                <textarea name="question" id="question" class="form-control ckeditor" placeholder="Question">@if(@$question_edit) {!! $question_edit->question !!} @endif</textarea>
                                <!-- <div name="question" id="summernote1">
                                </div> -->
                            </div>
                            @if(@$question_edit) 
                            <div class="tinymce-single responsive-mg-b-30">
                                <div class="alert-title">
                                    <h2>Exam Type</h2>
                                </div>
                                <select class="form-control custom-select-value" id="exam_type" name="exam_type">
                                    <option value="Main Exam" @if(@$question_edit && $question_edit->exam_type == "Main Exam") selected @endif >Main Exam</option>
                                    <option value="Internal" @if(@$question_edit && $question_edit->exam_type == "Internal") selected @endif >Internal</option>
                                </select>
                            </div>
                            <div class="tinymce-single responsive-mg-b-30">
                                <div class="alert-title">
                                    <h2>Question Type</h2>
                                </div>
                                <select class="form-control custom-select-value" id="question_type" name="question_type">
                                    <option value="Descriptive" @if(@$question_edit && $question_edit->question_type == "Descriptive") selected @endif  >Descriptive</option>
                                    <option value="True or False" @if(@$question_edit && $question_edit->question_type == "True or False") selected @endif  >True or False</option>
                                </select>
                            </div>
                                <input type="hidden" id="question_edit_id" name="question_edit_id" value="{{$question_edit->id}}" >
                            @else
                                <input type="hidden" id="exam_type" name="exam_type" value="{{$exam_type}}" >
                                <input type="hidden" id="question_type" name="question_type" value="{{$question_type}}" >
                            @endif
                                <input type="hidden" id="course" name="course" value="{{$course->id}}" >
                                <input type="submit" value="Submit" class="btn btn-primary">
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        <!-- tinymce End-->
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
    <!-- summernote JS
    ============================================ -->
    <script src="{{asset('facultypanel/js/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('facultypanel/js/summernote/summernote-active.js')}}"></script>
    <!-- ckeditor -->
    <script src="{{asset('adminpanel/ckeditor/ckeditor.js')}}"></script>
@endsection