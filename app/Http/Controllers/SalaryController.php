<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function paid(Request $request,$id){
        $validateData=$request->validate([
                'salary_month'=>'required',

        ]);
        $month=$request->salary_month;
        $check=DB::table('salaries')->where('employee_id',$id)->where('salary_month',$month)->first();
        if($check){
            return response($check)->json('salary already Paid');
        }
        else{
            $data=array();
            $data['employee_id']=$id;
            $data['amount']=$request->salary;
            $data['salary_date']=date('d/m/y');
            $data['salary_month']=$month;
            $data['salary_year']=date('y');
            DB::table('salaries')->insert($data);


        }

    }
    public function allSalary(){
        $salary=DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }
    // public function ViewSalary($id){

    // }

    public function ViewSalary($id){
        $user=DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.name','salaries.*')
        ->where('salaries.salary_month',$id)
        ->get();
        return response()->json($user);
    }
    public function editSalary($id){
        $user=DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.name','employees.email','salaries.*')
        ->where('salaries.id',$id)
        ->first();
        return response()->json($user);

    }
    public function updateSalary(Request $request,$id){
        $data=array();
        $data['employee_id']=$request->employee_id ;
        $data['amount']=$request->amount ;
        $data['salary_month']=$request->salary_month;
        DB::table('salaries')->where('id',$id)->update($data);
        
    
    }
}
