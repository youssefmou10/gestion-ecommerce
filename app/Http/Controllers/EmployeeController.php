<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=Employee::all();
        return response()->json($employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        $validateData = $request->validate([
         'name' => 'required|unique:employees|max:255',
         'email' => 'required',
         'phone' => 'required|unique:employees',
         'salary'=>'required'

        ]);

      if ($request->photo) {
         $position = strpos($request->photo, ';');
         $sub = substr($request->photo, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($request->photo)->resize(240,200);
         $upload_path = 'backend/employee/';
         $image_url = $upload_path.$name;
         $img->save($image_url);

         $employee = new Employee;
         $employee->name = $request->name;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $employee->salary = $request->salary;
         $employee->address = $request->address;
         $employee->nid = $request->nid;
         $employee->joigningdate = $request->joigningdate;
         $employee->photo = $image_url;
         $employee->save(); 
     }else{
        $employee = new Employee;
         $employee->name = $request->name;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $employee->salary = $request->salary;
         $employee->address = $request->address;
         $employee->nid = $request->nid;
         $employee->joigningdate = $request->joigningdate;
         
         $employee->save(); 

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
        $employee=DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['salary']=$request->salary;
        $data['address']=$request->address;
        $data['joigningdate']=$request->joigningdate;
        $data['nid']=$request->nid;
        $image=$request->newphoto;
        //update with image 
        if($image){
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $success=$img->save($image_url);
            if($success)
            {
                $data['photo'] = $image_url;
                $img=DB::table('employees')->where('id',$id)->first();
                $image_path=$img->photo;
                $done=unlink($image_path);
                $user=DB::table('employees')->where('id',$id)->update($data);
            }
        }
        //update withou image
        else{
            $oldphoto=$request->photo;
            $data['photo']=$oldphoto;
            $user=DB::table('employees')->where('id',$id)->update($data);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee=DB::table('employees')->where('id',$id)->first();
        $photo=$employee->photo;
        //Delete with image 
        if($photo)
        {
            unlink($photo);
            DB::table('employees')->where('id',$id)->delete();
        }
        //delete withou image
        else{
            DB::table('employees')->where('id',$id)->delete();
        }
    }
}
