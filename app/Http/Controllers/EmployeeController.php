<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use DB;
use Response;

class EmployeeController extends Controller{
    public function employeeList(){
        return Employee::all();
    }
    public function checkEmail(Request $request){
        $isExists = Employee::where('email', $request->email)->first();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }
    public function employeeAdd(Request $request){
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
            return response()->json(array('status'=>'200','success'=>true,'message'=>'Record created succesfully!'));
        } else {
            return response()->json(array('status'=>'400','success'=>false,'message'=>'Record create failed!'));
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
            return response()->json(array('status'=>'200','success'=>true,'message'=>'Record updated succesfully!'));
        } else {
            return response()->json(array('status'=>'400','success'=>false,'message'=>'Record update failed!'));
        }
    }
    public function employeeDelete($id){
        $rowAffected = DB::delete('delete from employee where id =?', [$id]);
        if ($rowAffected > 0) {
            return response()->json(array('status'=>'200','success'=>true,'message'=>'Record deleted succesfully!'));
        } else {
            return response()->json(array('status'=>'400','success'=>false,'message'=>'Record delete failed!'));
        }
    }
}
