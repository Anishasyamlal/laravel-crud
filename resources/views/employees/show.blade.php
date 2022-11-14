@extends('employees.layout')
@section('header')
    <div class="row">
        <div class="col-lg-12 margin-tb pt-5">
            <div class="pull-left">
                <h2> Show Employee Details</h2>
            </div>
        </div>
    </div> 
@endsection
@section('content')
    <div class="row">
        <table class="table table-bordered w-25">
            <tr>
                <th>  <strong>Name:</strong> </th>
                <td>  {{ $employee->name }}  </td>
            </tr>
            <tr>
                <th>  <strong>Email:</strong> </th>
                <td>  {{ $employee->email }}  </td>            
            </tr>
            <tr>
                <th>  <strong>Designation:</strong> </th>
                <td>  {{ $employee->designation }}  </td>
            </tr>
            <tr>
                <th>  <strong>Department:</strong>  </th>
                <td>  {{ $employee->department }}   </td>           
            </tr>
            <tr>
                <th>  <strong>Photo:</strong>  </th>
                <td>  <img src="{{ asset($employee->image) }}" alt="" width='50' height='50' class="img img-responsive">   </td>           
            </tr>
        </table>
    </div>
@endsection