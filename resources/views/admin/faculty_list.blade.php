@extends('layouts.appAdmin')
@section('title') Faculty list  @endsection
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
                    <h3 class="card-title">@if(@$faculty_edit) Edit @else Add @endif Faculty </h3>
                    <a href="{{route('faculty.index')}}" class="btn btn-success" style="float:right;">Add</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if(@$faculty_edit) 
                <form action="{{route('faculty.update',['faculty'=>$faculty_edit->id])}}" method="post" role="form" enctype="multipart/form-data" >
                @method('PUT')
                @else 
                <form action="{{route('faculty.store')}}" method="post" role="form" enctype="multipart/form-data" >
                @endif
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{@$faculty_edit->name}}"  placeholder="Enter Username">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror   
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{@$faculty_edit->email}}"  placeholder="Enter Email">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                         
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value=""  placeholder="Enter Password">
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror  
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value=""  placeholder="Enter Confirm Password">
                        </div>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                           
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@if(@$faculty_edit) Edit @else Add @endif </button>
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
                        <h3 class="card-title">Faculty List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(@$faculties && $faculties->count() > 0)    
                            @foreach($faculties as $key => $faculty)
                            @php $key++; @endphp
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$faculty->name}}</td>
                                    <td>{{$faculty->email}}</td>
                                    <td><a href="{{ route('faculty.edit',['faculty'=> $faculty->id ])  }}" class="btn btn-info">Edit</a></td>
                                    <td><a href="#" onclick="event.preventDefault(); document.getElementById('faculty-destroy-form-{{$faculty->id}}').submit();" class="btn btn-info">Delete</a>
                                    <form id="faculty-destroy-form-{{$faculty->id}}" action="{{ route('faculty.destroy',['faculty'=> $faculty->id ]) }}" method="POST" style="display:none;">
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
                        @if(@$faculties && $faculties->count() > 0) 
                            {{ $faculties->links() }}
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