<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Session;

class EmployeeController extends Controller
{
public function index(){
        $employees = Employee::all();
        return view('view', ['employees' => $employees]);
}
    public function saveEmployee(Request $request)
    {
                    $employee = new Employee();
                    $employee->name = $request->name;
                    $employee->email = $request->email;
                    $employee->gender = $request->gender;
                    $employee->dob =  $request->dob;
                    $employee->age = $request->age;
                    $employee->salary = $request->salary;
                    $employee->city = $request->city;
                    $saved =  $employee->save();
                    if($saved){
                        $response = [
                            'status'=>'ok',
                            'success'=>true,
                            'message'=>'Record created succesfully!'
                        ];
                        return $response;
                    }else{
                        $response = [
                            'status'=>'ok',
                            'success'=>false,
                            'message'=>'Record created failed!'
                        ];
                        return $response;
                    }
    }

    public function fetchEmployee($id){
       return Employee::find($id);
    }
    
    public function employeeUpdate(Request $request){
        $updateData = [
            'name' => $request->name,
            'email'=> $request->email,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'age'=> $request->age,
            'salary' => $request->salary,
            'city' => $request->city,
        ];
        $result = Employee::where('id', $request->employee_id)->update($updateData);
        if($result){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record updated succesfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record updated failed!'
            ];
            return $response;
        }
    }
}
