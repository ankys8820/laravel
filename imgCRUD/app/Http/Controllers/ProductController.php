<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductController extends Controller
{
    // this methods will show products
    public function index(){
        $products = Product::orderBy('created_at','DESC')->get();
        return view('products.home',[
            'products'=>$products
        ]);
    }
    public function create(){
     return view('products.create');
    }
    public function store(Request $request){
        $rules = [
            'name'=>'required|min:3',
            'sku'=>'required|min:3',
            'price'=>'required|numeric'
        ];

        if($request->image != ""){
            // true only when a valid image
            $rules['image']='image';
        }

       $validator =  Validator::make($request->all(),$rules);

       if($validator->fails()){
        return redirect()->route('product.create')->withInput()->withErrors($validator);
       }

    //    
    $product = new Product();
    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->price = $request->price;
    $product->description = $request->description;

    
    if($request->image != ""){
        
        
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time().'.'.$ext;
    // save in directory
    
    $image->move(public_path('uploads/products'),$imageName);
    
    
    $product->image = $imageName;
    $product->save();
}
$product->save();

return redirect()->route('product.index')->with('success','Product added successfully!');

    }
    public function edit($id){
        $product = Product::findOrFail($id);

        return view('products.edit',[
            'product'=>$product
        ]);

    }
    public function update($id, Request $request){
        $product = Product::findOrFail($id);
        $rules = [
            'name'=>'required|min:3',
            'sku'=>'required|min:3',
            'price'=>'required|numeric'
        ];

        if($request->image != ""){
            // true only when a valid image
            $rules['image']='image';
        }

       $validator =  Validator::make($request->all(),$rules);

       if($validator->fails()){
        return redirect()->route('product.edit',$product->id)->withInput()->withErrors($validator);
       }

    //    

    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->price = $request->price;
    $product->description = $request->description;

    
    if($request->image != ""){
        // delete the old one
    File::delete(public_path('uploads/products'.$product->image));
        
        
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time().'.'.$ext;
    // save in directory
    
    $image->move(public_path('uploads/products'),$imageName);
    
    
    $product->image = $imageName;
    $product->save();
}
    $product->save();

    return redirect()->route('product.index')->with('success','Product Updated successfully !');



    }
    public function destroy($id){

        
        $product = Product::findOrFail($id);


        // delete image only
    
        File::delete(public_path('uploads/products'.$product->image));
       
        $product->delete();
        return redirect()->route('product.index')->with('success',"Product deleted !");

    }
}
