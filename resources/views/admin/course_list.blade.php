@extends('layouts.appAdmin')
@section('title') Course list  @endsection

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminpanel/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminpanel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <!-- general form elements -->
        <div class="row">
            <div class="col-6" >
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@if(@$course_edit) Edit @else Add @endif Course </h3>
                    <a href="{{route('course.index')}}" class="btn btn-success" style="float:right;">Add</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if(@$course_edit) 
                <form action="{{route('course.update',['course'=>$course_edit->id])}}" method="post" role="form" enctype="multipart/form-data" >
                @method('PUT')
                @else 
                <form action="{{route('course.store')}}" method="post" role="form" enctype="multipart/form-data" >
                @endif
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" id="code" value="{{@$course_edit->code}}"  placeholder="Enter Course Code">
                        </div>
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{@$course_edit->title}}"  placeholder="Enter Course Title">
                        </div>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror   
                        <div class="form-group">
                            <label for="credit">Credit</label>
                            <input type="text" class="form-control" name="credit" id="credit" value="{{@$course_edit->credit}}"  placeholder="Enter Course Credit">
                        </div>
                        @error('credit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror  
                        <div class="form-group">
                            <label for="faculty">Assign Faculty</label>
                            <select class="select2 form-control" name="faculty[]" id="faculty" multiple="multiple" data-placeholder="Select Faculty" style="width: 100%;">
                                @if(@$faculties)
                                @foreach($faculties as $faculty)
                                <option value="{{$faculty->id}}"
                                    @if(@$course_edit->faculties)
                                        @foreach($course_edit->faculties as $facul)
                                            @if($facul->id == $faculty->id)
                                                selected
                                            @endif
                                        @endforeach
                                    @endif
                                >{{$faculty->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div> 
                        @error('faculty')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                                                                       
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@if(@$course_edit) Edit @else Add @endif </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- general form elements end -->

        <!-- Main row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Course List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Credit</th>
                                    <th>Assign Faculty</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(@$courses && $courses->count() > 0)    
                            @foreach($courses as $key => $course)
                            @php $key++; @endphp
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$course->code}}</td>
                                    <td>{{$course->title}}</td>
                                    <td>{{$course->credit}}</td>
                                    <td>
                                        @if(@$course->faculties)
                                            @foreach($course->faculties as $facul)
                                                {{$facul->name}}|
                                            @endforeach
                                        @endif
                                    </td>
                                    <td><a href="{{ route('course.edit',['course'=> $course->id ])  }}" class="btn btn-info">Edit</a></td>
                                    <td><a href="#" onclick="event.preventDefault(); document.getElementById('course-destroy-form-{{$course->id}}').submit();" class="btn btn-info">Delete</a>
                                    <form id="course-destroy-form-{{$course->id}}" action="{{ route('course.destroy',['course'=> $course->id ]) }}" method="POST" style="display:none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No data available.</td>
                                </tr>
                             @endif
                            </tbody>
                        </table>
                        @if(@$courses && $courses->count() > 0) 
                            {{ $courses->links() }}
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@endsection

@section('script')
    <!-- ckeditor -->
    <script src="{{asset('adminpanel/ckeditor/ckeditor.js')}}"></script>	
    <!-- Select2 -->
    <script src="{{asset('adminpanel/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
    </script>
@endsection