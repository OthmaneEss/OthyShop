<?php

namespace App\Http\Controllers\Front;


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaveLaterController extends Controller
{

public function destroy($id){

        Cart::instance('saveForLater')->remove($id);
        return redirect()->back()->with('msg','The Item has been removed from the save from Later section');

}

public function moveToCart($id){

    $item=Cart::instance('saveForLater')->get($id);
    Cart::instance('saveForLater')->remove($id);

    $dup=Cart::instance('saveForLater')->search(function($cartItem,$rowId) use($id){

        return $cartItem->id ===$id;
    });

    if($dup->isNotEmpty()){

        return redirect()->back()->with('msg','Item is already saved for later');
    }

    Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');

    return redirect()->back()->with('msg', 'The Item has been moved to cart successfully');



}


}
