<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::paginate(5);

        return view('admin.orders.index',compact('orders'));

    }

    public function confirm($id){

        //find the order
        $order=Order::find($id);

        //update the order
        $order->update(['status'=>1]);

        //session message
        session()->flash('msg','the order has been confirmed');

        //redirect the page
        return redirect('admin/orders');
    }

    public function pending($id){
        //find the order
        $order=Order::find($id);

        //update the order
        $order->update(['status'=>0]);

        //session message
        session()->flash('msg','the order has been pended');

        //redirect the page
        return redirect('admin/orders');

    }



    public function show($id)
    {
        $order=Order::find($id);
        return view('admin.orders.show',compact('order'));
    }





}
