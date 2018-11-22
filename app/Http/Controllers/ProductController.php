<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products=Product::paginate(5);
        return view('admin.products.index',compact('products'));
    }


    public function create()
    {
        $product=new Product();
        return view('admin.products.create',compact('product'));
    }


    public function store(Request $request)
    {

        //validate the form
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'image'=>'image|required'

        ]);

        //upload the image
        if($request->hasFile('image')){

            $image=$request->image;
            $image->move('uploads',$image->getClientOriginalName());
        }
        //Save the data into database

        $product=new Product();
        $product->name=$request->name;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->image=$request->image->getClientOriginalName();
        $product->save();
        //Sessions message
       $request-> session()->flash('msg','The Product has been added succesfully');
            //redirect
        return redirect('admin/products');


    }


    public function show($id)
    {
        $product=Product::find($id);

        return view('admin.products.show',compact('product'));
    }

    public function edit($id)
    {

        $product=Product::find($id);
        return view('admin.products.edit',compact('product'));
    }

    public function update(Request $request, $id)
    {
        //find the product
        $product=Product::find($id);

        //Validate the edit form
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required'

        ]);

        //Check if there any image
        if($request->hasFile('image')){
        //check if the old image exists into folder
        if(fileExists(public_path('uploads').$product->image)){
        unlink(public_path('uploads/').$product->image);
    }

        //upload the new image
        $image=$request->image;
        $image->move('uploads',$image->getClientOriginalName());
        $product->image=$request->image->getClientOriginalName();
    }

            //update the product

        $product->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$product->image

        ]);
        //Sessions message
        $request->session()->flash('msg','The Product has been updated succesfully');
        //redirect
        return redirect('admin/products');

    }


    public function destroy($id)
    {
        //Delete Product
        Product::destroy($id);

        //Sessions message
        session()->flash('msg','The Product has been deleted succesfully');

        //redirect
        return redirect('admin/products');

    }
}
