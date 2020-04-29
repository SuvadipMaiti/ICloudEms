<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faculty;
use Session;
use Hash;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::paginate(10);
        return view('admin.faculty_list',compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:faculties',
            'password' => 'required|confirmed|min:8'
        ]);
        
        $faculty_ins = new Faculty;
        $faculty_ins->name = $request->name;
        $faculty_ins->email = $request->email;
        $faculty_ins->password = Hash::make($request->password);
        $faculty_ins->save();    
        if(@$faculty_ins){
            Session::flash('success','Faculty Details Submited.');
            return redirect()->route('faculty.index');
        }else{
            Session::flash('error','Faculty Details not Submited.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($faculty)
    {
        $faculties = Faculty::paginate(10);
        $faculty_edit = Faculty::find($faculty);
        return view('admin.faculty_list',compact('faculties','faculty_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $faculty)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:faculties,id,'.$faculty,
            'password' => 'required|confirmed|min:8'
        ]);
        
        $faculty_up = Faculty::find($faculty);
        $faculty_up->name = $request->name;
        $faculty_up->email = $request->email;
        $faculty_up->password = Hash::make($request->password);
        $faculty_up->save();    
        if(@$faculty_up){
            Session::flash('success','Faculty Details Updated.');
            return redirect()->route('faculty.index');
        }else{
            Session::flash('error','Faculty Details not Updated.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($faculty)
    {
        $faculty_del = Faculty::find($faculty);
        if(!empty($faculty_del)){
            $faculty_del->delete();
            Session::flash('success','Faculty data Deleted');
            return redirect()->route('faculty.index');
        }else{
            Session::flash('error','Faculty data not Deleted');
            return redirect()->back();
        }
    }
}
