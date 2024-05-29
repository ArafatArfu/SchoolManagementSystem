<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Str;
use Auth;
use Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();   

        $data['header_title'] = "Student List";
        return view('admin.student.list',$data);
    }


    
    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Student";
        return view('admin.student.add',$data);
    }

    
    public function insert(Request $request)
    {
        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {     
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->profile_pic))
        {     
            $extention = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$extention;
            $file->move('upload/profile/',$filename);

            $student->profile_pic = $filename;
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
    
        if(!empty($request->admission_date))
        {
            $student->admission_date = trim($request->admission_date);
        }

        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->save();

        return redirect('admin/student/list')->with('success',"Student Successfully Created");

    }

}
