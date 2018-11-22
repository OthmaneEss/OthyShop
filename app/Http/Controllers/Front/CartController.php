<?php

namespace App\Http\Controllers\Front;


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dup=Cart::search(function($cartItem,$rowId) use($request){

            return $cartItem->id==$request->id;
        });

        if($dup->isNotEmpty()){

            return redirect()->back()->with('msg','Item is already in your cart');
        }

        Cart::add($request->id,$request->name,1,$request->price)->associate('App\Product');

        return redirect()->back()->with('msg','Item has been added to Cart');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between: 1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('errors','Quantity must be between 1 and 5');
            return response()->json(['success' => false]);
        }

        Cart::update($id, $request->quantity);

        session()->flash('msg','The Quantity has been updated');

        return response()->json(['success' => true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Cart::remove($id);

        return redirect()->back()->with('msg','The Item has been removed succesfully from the Cart');

    }


    public function saveLater($id ){

        $item=Cart::get($id);
        Cart::remove($id);

        $dup=Cart::instance('saveForLater')->search(function($cartItem,$rowId) use($id){

            return $cartItem->id ===$id;
        });

        if($dup->isNotEmpty()){

            return redirect()->back()->with('msg','Item is already saved for later');
        }



            Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');

            return redirect()->back()->with('msg', 'The Item has been saved for later');


    }
}
