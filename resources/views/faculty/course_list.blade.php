@extends('layouts.appFaculty')
@section('title') Dashboard @endsection
@section('breadcrumb') 
    <a href="{{route('faculty.home')}}">Home</a> <span class="bread-slash">/</span>
@endsection
@section('breadcrumbSub') Add Question @endsection

@section('style')

@endsection

@section('content')




        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Course <span class="table-project-n"></span> Table</h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Export Basic</option>
											<option value="all">Export All</option>
											<option value="selected">Export Selected</option>
										</select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="slno">Sl No.</th>
                                                <th data-field="code" data-editable="true">Code</th>
                                                <th data-field="title" data-editable="true">Title</th>
                                                <th data-field="credit" data-editable="true">Credit</th>
                                                <th data-field="action">Create a Question</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(@$courses && $courses->count() > 0 )
                                            @foreach($courses as $key => $course)
                                            @php $key++; @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{$key}}</td>
                                                <td>{{$course->code}}</td>
                                                <td>{{$course->title}}</td>
                                                <td>{{$course->credit}}</td>
                                                <td>
                                                    <a href="{{route('course_view',['id'=>$course->id])}}" ><i class="fa fa-pencil"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
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
@endsection