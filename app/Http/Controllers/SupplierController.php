<?php

namespace App\Http\Controllers;
use App\Models\Supplier\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=Supplier::all();
        return response()->json($supplier);
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
            'name'=>'required|unique:suppliers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:suppliers',
            ]);
         
            if ($request-> image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $name = time().".".$ext;
                $img = Image::make($request->image)->resize(240,200);
                $upload_path = 'backend/products/';
                $image_url = $upload_path.$name;
                $img->save($image_url);
       
                $products = new Product;
                $suplliers->name = $request->name;
                $suplliers->email = $request->email;
                $suplliers->phone = $request->phone;
                $suplliers->addresse = $request->addresse;
                $suplliers->shopname = $request->shopname;
                $suplliers->photo = $image_url;
                $suplliers->save(); 
            }else{
                $suplliers = new Supplier;
                $suplliers->name = $request->name;
                $suplliers->email = $request->email;
                $suplliers->phone = $request->phone;
                $suplliers->addresse = $request->addresse;
                $suplliers->shopname = $request->shopname;
                $suplliers->save(); 

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
        $supplier=DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
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
        $data['shopname']=$request->shopname;
        $data['addresse']=$request->addresse;
        $image=$request->newphoto;
        //update with image 
        if($image){
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/suppliers/';
            $image_url = $upload_path.$name;
            $success=$img->save($image_url);
            if($success)
            {
                $data['photo'] = $image_url;
                $img=DB::table('suppliers')->where('id',$id)->first();
                $image_path=$img->photo;
                $done=unlink($image_path);
                $user=DB::table('suppliers')->where('id',$id)->update($data);
            }
        }
        //update withou image
        else{
            $oldphoto=$request->photo;
            $data['photo']=$oldphoto;
            $user=DB::table('suppliers')->where('id',$id)->update($data);
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
        $supplier=DB::table('suppliers')->where('id',$id)->first();
        $photo=$supplier->photo;
        //Delete with image 
        if($photo)
        {
            unlink($photo);
            DB::table('suppliers')->where('id',$id)->delete();
        }
        //delete withou image
        else{
            DB::table('suppliers')->where('id',$id)->delete();
        }
    }
}
