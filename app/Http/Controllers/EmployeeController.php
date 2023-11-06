<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\validate\rule;
use Illuminate\Validation\ValidationException;
use DB;

class EmployeeController extends Controller
{
    public function employeeList(){
        return Employee::all();
    }
    public function checkEmail(Request $request){
        $email = $request->email;
        $isExists = Employee::where('email',$email)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }
    public function employeeAdd(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employee,email', 
            'gender' => 'required',
            'dob' => 'required|date',
            'age' => 'required|integer',
            'salary' => 'required|numeric',
            'city' => 'required',
        ]);
   
        
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

    public function employeeFetch($id){
        return Employee::find($id);
    }

    public function employeeUpdate(Request $request){
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
    public function employeeDelete($id){
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
