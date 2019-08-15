<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Items;
use App\Models\Orders;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\OrdersDetails;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $order = Orders::count();
        $item = Items::count();
        $user = User::count();
        $categories = Categories::count();

        $pagecontent = view('/home',compact('order','item','user','categories'));

        //masterpage
        $pagemain = array(
            'title' => 'Home',
            'menu' => 'home',
            'submenu' => '',
            'pagecontent' => $pagecontent,
        );
        return view('masterpage', $pagemain);
    }

    public function profile()
    {
      $user = User::find(Auth::id());
      $pagecontent = view('users.profile',$user);

     //masterpage
     $pagemain = array(
         'title' => 'Users Profile',
         'menu' => 'setting',
         'submenu' => 'user',
         'pagecontent' => $pagecontent,
     );
     return view('masterpage', $pagemain);
    }


  public function history(User $user)
  {
 
  $users = User::where('idusers', $user->idusers)->with(
            ['orders' => function($order){
                  $order->with(['received' => function($received){
                      $received->with('users');
                  }, 'accepted' => function($accepted){
                      $accepted->with('users');
                  } ,'orders_details' => function($od){
                      $od->with(['items' => function($items){
                        $items->with('categories');   
                      }]
                    );
                  }]
                );
              }]
          )->get();

    // return $users;
    $content = [
      'users' => $users,
    ];

    $pagecontent = view('history.index',$content);
    //masterpage
    $pagemain = array(
        'title' => 'History',
        'menu' => 'history',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function update_history(Orders $order)
  {
      $content=[
        'items' => Items::where('active', TRUE)->get(),
        'order' => $order,
      ];
      $pagecontent = view('history.update',$content);
      $pagemain = array(
          'title' => 'History',
          'menu' => 'history',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
  }

  public function update_history_save(Request $request, Orders $order)
  {
    $request->validate([
        'due_date' => 'required',
        'description' => 'required',
    ]);
      // return $request->all();
    $idordersdetails = $request->idordersdetails;
    $quantity = $request->quantity;
    $items = $request->iditems;
    $itm = count($idordersdetails);

    for ($i=0; $i < $itm; $i++) {
       if ($items[$i] == 0) {
        return redirect()->back()->with('status_error', 'Items empty');
       }elseif ($quantity[$i] == 0) {
        return redirect()->back()->with('status_error', 'Quantity empty');
       }
    }

      $saveOrders = Orders::find($order->idorders);
      // $saveOrders->date_orders = $request->date_orders;
      $saveOrders->due_date = $request->due_date;
      $saveOrders->description = $request->description;
      $saveOrders->save();

      for ($i=0; $i < $itm  ; $i++) {
        if ($idordersdetails[$i] == 'new') {
          $saveOrdersDetails = new OrdersDetails;
          $saveOrdersDetails->idorders = $saveOrders->idorders;
        }else{
          $saveOrdersDetails = OrdersDetails::find($idordersdetails[$i]);
        }
        $saveOrdersDetails->iditems = $items[$i];
        $saveOrdersDetails->quantity = $quantity[$i];
        $saveOrdersDetails->save();

      }

      $deleteindex = $request->deleteindex;
      if(strlen($deleteindex) > 0) {
        $delidod = explode(',', $deleteindex);
        $delidprd = array_values(array_filter($delidod));
        OrdersDetails::whereIn('idordersdetails',$delidprd)->delete();
      }
      //
    return redirect('history/'.Auth::user()->idusers)->with('status_success','Updated Detail Order');

  }
}
