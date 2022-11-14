<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(5);
    
        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
        ]);
        $employees=$request->all();
        $fileName=time().$request->file('image')->getClientoriginalName();
        $path=$request->file('image')->storeAs('images',$fileName,'public');
        $employees["image"]='/storage/'.$path;
        Employee::create($employees);
        return redirect()->route('employees.index')
                        ->with('success','Employee added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'image' => 'required',
        ]);
        $data = [
            'name' => request()->name,
            'email' => request()->email,
            'designation' => request()->designation,
            'department' => request()->department,
            'image' => request()->image
        ];
        if ($request->hasFile('image')) {
            $imagePath = 'asset/storage/images/'.$employee->image;
            if(File::exists($imagePath)){
               unlink($imagePath);
            }
            $fileName=time().$request->file('image')->getClientoriginalName();
            $path=$request->file('image')->storeAs('images',$fileName,'public');
            $data["image"]='/storage/'.$path;
            
        }
            $employee->update($data);    
        return redirect()->route('employees.index')
                        ->with('success','employee details updated successfully');
   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
    
        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }
}
