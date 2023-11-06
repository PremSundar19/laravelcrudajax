<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Session;
use DB;

class EmployeeController extends Controller
{
    public function index()
    {
         $employees = Employee::all(); 
        return $employees;
    }
    public function saveEmployee(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->gender = $request->gender;
        $employee->dob = $request->dob;
        $employee->age = $request->age;
        $employee->salary = $request->salary;
        $employee->city = $request->city;
        $saved = $employee->save();
        if ($saved) {
            $response = [
                'status'=>'200',
                'success'=>true,
                'message'=>'Record created successfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'400',
                'success'=>false,
                'message'=>'Record created failed!'
            ];
            return $response;
        }
    }

    public function fetchEmployee($id)
    {
        return Employee::find($id);
    }

    public function updateEmployee(Request $request)
    {
        $id = $request->editid;
        $name = $request->editname;
        $email = $request->editemail;
        $gender = $request->editgender;
        $dob = $request->editdob;
        $age = $request->editage;
        $salary = $request->editsalary;
        $city = $request->editcity;
        $rowAffected = DB::update('update employee set name=?,email=?,gender=?,dob=?,age=?,salary=?,city=? where id =?', [$name, $email, $gender, $dob, $age, $salary, $city, $id]);
        if ($rowAffected > 0) {
            $response = [
                'status'=>'200',
                'success'=>true,
                'message'=>'Record updated succesfully!'
            ];
            return $response;
        } else {
            $response = [
                'status'=>'400',
                'success'=>false,
                'message'=>'Record updated failed!'
            ];
            return $response;
        }
    }
    public function deleteEmployee($id)
    {
        $rowAffected = DB::delete('delete from employee where id =?', [$id]);
        if ($rowAffected > 0) {
            $response = [
                'status'=>'200',
                'success'=>true,
                'message'=>'Record deleted succesfully!'
            ];
            return $response;
        } else {
            $response = [
                'status'=>'400',
                'success'=>false,
                'message'=>'Record deleted failed!'
            ];
            return $response;
        }
    }

}
