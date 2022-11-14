@extends('employees.layout')
@section('header')
<div class="row">
    <div class="col-lg-12 margin-tb pt-5">
        <div class="pull-left">
            <h2>Employee Info</h2>
        </div>
        <div class="pull-right ">
            <a class="btn btn-success" href="{{ route('employees.create') }}"> Add New Employee</a>
        </div>
    </div>
</div>
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered ">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Designation</th>
            <th>department</th>
            <th>Photo</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($employees as $employee)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->designation }}</td>
            <td>{{ $employee->department }}</td>
            <td><img src="{{ asset($employee->image) }}" alt="" width='50' height='50' class="img img-responsive"></td>
            <td>
                <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('employees.show',$employee->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $employees->links() !!}      
@endsection