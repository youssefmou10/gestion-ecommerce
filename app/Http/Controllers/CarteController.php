<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CarteController extends Controller
{
    public function AddTocart($id){
        //get data for id 
        $product=DB::table('products')->where('id',$id)->first();
        //inseration 
        $data=array();
        $data['pro_id']=$id;
        $data['pro_name']=$product->product_name;
        $data['pro_quantity']=1;
        $data['pro_price']=$product->selling_price ;
        $data['sub_total']=$product->buying_price ;
        DB::table('pos')->insert($data);  
    }

    public function ProductCart(){
        //get all Data 
        $cart=DB::table('pos')->get();
        return response()->json($cart);
    }
   
}
