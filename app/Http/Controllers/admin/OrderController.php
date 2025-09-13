<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::latest('orders.created_at')->select('orders.*','users.name','users.email','users.phone');
        $orders =  $orders->leftJoin('users','users.id','orders.user_id');
        if (!empty($request->get('keyword'))) {
            $keyword = $request->get('keyword');
            $orders = $orders->where(function ($query) use ($keyword) {
                $query->where('users.name', 'like', '%' . $keyword . '%')
                      ->orWhere('users.email', 'like', '%' . $keyword . '%')
                      ->orWhere('orders.id', 'like', '%' . $keyword . '%');
            });
        }
        //echo $orders->toSql();
        //dd($orders->getBindings()); // To view query with bindings
        $orders = $orders->paginate(10);
        return view('admin.orders.list',compact('orders'));
    }

    public function detail($id){
           $order = Order::select('orders.*', 'countries.name as countryName')
                         ->where('orders.id',$id)
                       ->leftJoin('countries','countries.id','orders.country_id')
                       ->first();      
          
            $orderItem = OrderItem::where('order_id',$id)->get();
            //dd($orderItem);          
          return view('admin.orders.detail',compact('order','orderItem'));
    }

    public function changeOrderStatus($orderId, Request $request){
        $order= Order::find($orderId);
        $order->status = $request->status;
        $order->shipped_date = $request->shippedDate; 
        $order->save(); 
        $request->session()->flash('success','Order updated successfully'); 
        return response()->json([
            'status' =>true,
            'message' => "Order updated successfully"
          ]);      
    }

    public function sendInvoiceEmail(Request $request, $orderId){       
        orderEmail($orderId,$request->userType);
        $request->session()->flash('success','Order email sent successfully'); 
        return response()->json([
            'status' =>true,
            'message' => "Order email sent successfully"
          ]); 
    }
}
