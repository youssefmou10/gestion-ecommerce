<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product\Product;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('suppliers','products.supplier_id','suppliers.id')
        ->select('categories.categorie_name','suppliers.name','products.*')
        ->orderBy('products.id','DESC')
        ->get();
        return response()->json($product);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name'=>'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantié'=>'required'
            ]);
            if ($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $name = time().".".$ext;
                $img = Image::make($request->image)->resize(240,200);
                $upload_path = 'backend/suppliers/';
                $image_url = $upload_path.$name;
                $img->save($image_url);
       
                $product = new Product;
                $product->category_id= $request->category_id;
                $product->product_name  = $request->product_name ;
                $product->product_code  = $request->product_code ;
                $product->root= $request->root;
                $product->buying_price = $request->buying_price;
                $product->selling_price = $request->selling_price;
                $product->supplier_id  = $request->supplier_id ;
                $product->buying_date  = $request->buying_date ;
                $product->product_quantié   = $request->product_quantié  ;
                $product->image= $image_url;
                $product->save(); 
            }else{
                $product = new Product;
                $product->category_id= $request->category_id;
                $product->product_name  = $request->product_name ;
                $product->product_code  = $request->product_code ;
                $product->root= $request->root;
                $product->buying_price = $request->buying_price;
                $product->selling_price = $request->selling_price;
                $product->supplier_id  = $request->supplier_id ;
                $product->buying_date  = $request->buying_date ;
                $product->product_quantié   = $request->product_quantié  ;
                $product->save();  

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
        $product=DB::table('products')->where('id',$id)->first();
        return response()->json($product);
    }

  
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
        $data['product_name']=$request-> product_name;
        $data['product_code']=$request-> product_code;
        $data['category_id']=$request->category_id;
        $data['supplier_id']=$request->supplier_id;
        $data['root']=$request->root;
        $data['buying_price']=$request->buying_price;
        $data['buying_date']=$request-> buying_date;
        $data['product_quantié']=$request->product_quantié;
        $image=$request->newimage;
        //update with image 
        if($image){
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/products/';
            $image_url = $upload_path.$name;
            $success=$img->save($image_url);
            if($success)
            {
                $data['image'] = $image_url;
                $img=DB::table('products')->where('id',$id)->first();
                $image_path=$img->image;
                $done=unlink($image_path);
                $user=DB::table('products')->where('id',$id)->update($data);
            }
        }
        //update withou image
        else{
            $oldphoto=$request->image;
            $data['image']=$oldphoto;
            $user=DB::table('products')->where('id',$id)->update($data);
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
        $product=DB::table('products')->where('id',$id)->first();
        $photo=$product->image;
        //Delete with image 
        if($photo)
        {
            unlink($photo);
            DB::table('products')->where('id',$id)->delete();
        }
        //delete withou image
        else{
            DB::table('products')->where('id',$id)->delete();
        }
    }
    public function updateStock(Request $request,$id){
        $data=array();
        $data['product_quantié']=$request->product_quantié;
        DB::table('products')->where('id',$id)->update($data);

    }
}
