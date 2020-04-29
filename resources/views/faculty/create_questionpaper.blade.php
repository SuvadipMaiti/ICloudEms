@extends('layouts.appFaculty')
@section('title') Create Question Paper @endsection
@section('breadcrumb') 
    <a href="{{route('course_view',['id'=>$course->id])}}">Question Paper</a> <span class="bread-slash">/</span>
@endsection
@section('breadcrumbSub') Add Question Paper @endsection

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
                                    <h1> Add a Question Paper </h1>
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
                <form method="post" action="{{route('create_questionpaper2',['id'=>$course->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="alert-title">
                                <h2>Enter a name/Id for this Paper</h2>
                            </div>
                            <input type="text" class="form-control" name="name" id="name" >                        
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="alert-title">
                                <h2>Exam Type</h2>
                            </div>
                            <select class="form-control custom-select-value" id="exam_type" name="exam_type">
                            <option value="Main Exam" selected>Main Exam</option>
                            <option value="Internal" >Internal</option>
                                <option value="End sem exam" >End sem exam</option>
                            </select>                       
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="alert-title">
                                <h2>Sub Exam</h2>
                            </div>
                            <select class="form-control custom-select-value" id="sub_exam" name="sub_exam">
                                <option value="Unit Test 1" selected>Unit Test 1</option>
                                <option value="Unit Test 2" >Unit Test 2</option>
                            </select>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="alert-title">
                                    <h2>No of Section/Units</h2>
                            </div>
                            <input type="number" class="form-control" name="no_of_section" id="no_of_section" >
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="tinymce-single responsive-mg-b-30">
                                <div class="alert-title">
                                    <h2>Description</h2>
                                </div>
                                <textarea name="description" id="description" class="form-control ckeditor" placeholder="Description"></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="window.location='{{ URL::previous() }}'">Cancel</button>
                            <input type="submit" value="Next" class="btn btn-primary">
                        </div>
                    </div>
                </form>
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