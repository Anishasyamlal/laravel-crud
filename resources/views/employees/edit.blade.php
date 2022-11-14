@extends('employees.layout')
@section('header')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Employee Info</h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('employees.update',$employee->id) }}" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $employee->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $employee->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Designation:</strong>
                    <input type="text" name="designation" value="{{ $employee->designation }}" class="form-control" placeholder="Designation">
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Department:</strong>
                    <input type="text" name="department" value="{{ $employee->department }}" class="form-control" placeholder="Department">
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Photo:</strong>
                    <input type="file" name="image" class="form-control" >
                    <img src="{{ asset($employee->image) }}" alt="" width='50' height='50' class="img img-responsive">
                </div>
            </div>
            <div class=" col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
