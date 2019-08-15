<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Items;
use App\Models\Orders;
use App\Models\OrdersDetails;
use App\Models\Categories;
use App\Models\Accepted;
use App\Models\Received;
use App\Models\Broken;
use App\Models\Failed;
use Illuminate\Http\Request;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      // $this->middleware('admin');
  }

  public function index()
  {
    $Orders = Orders::with(['users',
                      'orders_details' => function($ord){
                        $ord->with(['items'=> function($item){
                           $item->with('categories');
                           }
                        ]);
                  }, 'received' => function($received){
                      $received->with('users');
                  }, 'accepted' => function($accepted){
                      $accepted->with('users');
                  }
              ])->get();
    // return $Orders;
    $contents = [
      'orders' => $Orders,
    ];
    // return $contents;
    $pagecontent = view('orders.index',$contents);
    //masterpage
    $pagemain = array(
        'title' => 'List Orders',
        'menu' => 'list_orders',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }
  public function create_page()
  {
    $contents = [
      // 'orders' => $order,
       'items' => Items::where('active', TRUE)->get()
    ];
    // return $contents;
    $pagecontent = view('orders.create',$contents);
    //masterpage
    $pagemain = array(
        'title' => 'Orders-Create',
        'menu' => 'create-orders',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function save_create(Request $request)
  {
      $request->validate([
        'due_date' => 'required',
        'description' => 'required',
      ]);

      // return $request->all();
      $quantity = $request->quantity;
      $items = $request->iditems;
      $itm = count($items);
      //
      for ($i=0; $i < $itm; $i++) {
         if ($items[$i] == 0) {
          return redirect()->back()->with('status_error', 'Items empty');
         }elseif ($quantity[$i] == 0) {
          return redirect()->back()->with('status_error', 'Quantity empty');
         }
      }
      $saveOrders = new Orders;
      $saveOrders->code = $this->get_code();
      $saveOrders->date_orders = date('Y-m-d H:i:s');
      $saveOrders->due_date = $request->due_date;
      $saveOrders->idusers = Auth::user()->idusers;
      $saveOrders->description = $request->description;
      $saveOrders->status = 'p';
      $saveOrders->save();
      //
      for ($i=0; $i < $itm  ; $i++) {
        $saveOrdersDetails = new OrdersDetails;
        $saveOrdersDetails->idorders = $saveOrders->idorders;
        $saveOrdersDetails->iditems = $items[$i];
        $saveOrdersDetails->quantity = $quantity[$i];
        $saveOrdersDetails->save();


      }

      $users = User::find([1,3]);
      foreach ($users as $user) {
        $saveNotifications = new Notifications;
        $saveNotifications->idusers = $user->idusers;
        $saveNotifications->idorders  = $saveOrders->idorders;
        $saveNotifications->subject =  'Orders from '.Auth::user()->name;
        $saveNotifications->save();
      }
      // return "successfully";
    return redirect('history/'.Auth::user()->idusers)->with('status_success','New orders created');
  }

  public function view_orders(Orders $order)
  {
    $Orders = Orders::with(['users','orders_details' => function($ord){
                  $ord->with(['items'=> function($item){
                      $item->with('categories');
                  }
                ]);
                }, 'received' => function ($received){
                    $received->with('users');
                } ,'accepted' => function($accepted){
                    $accepted->with('users');
                }
             ])
            ->where('idorders',$order->idorders)
            ->first();

    $contents = [
        'order' => $Orders,
     ];
     // return $contents;
    $pagecontent = view('orders.view',$contents);

    $pagemain = array(
        'title' => 'List Orders',
        'menu' => 'list_orders',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );
    return view('masterpage', $pagemain);

  }

    public function update_page(Orders $order)
    {
      $Orders = Orders::with(['users','orders_details' => function($ord){
                    $ord->with(['items'=> function($item){
                      $item->with('categories');
                  }]);
              }])
              ->where('idorders',$order->idorders)
              ->first();
      // return $Orders;
      $contents = [
        'order' => $order,
         'items' => Items::where('active', TRUE)->get()
      ];

      $pagecontent = view('orders.update',$contents);
      //masterpage
      $pagemain = array(
          'title' => 'View History',
          'menu' => 'list_orders',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function save_update(Request $request, Orders $order)
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
      //
      for ($i=0; $i < $itm; $i++) {
         if ($items[$i] == 0) {
          return redirect()->back()->with('status_error', 'Items empty');
         }elseif ($quantity[$i] == 0) {
          return redirect()->back()->with('status_error', 'Quantity empty');
         }
      }
      $saveOrders = Orders::find($order->idorders);
      $saveOrders->date_orders = $request->date_orders;
      $saveOrders->due_date = $request->due_date;
      $saveOrders->description = $request->description;
      $saveOrders->save();
      //
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

      return "successfully";
      // return redirect('orders')->with('status_success','Orders updated');

    }

    public function action_update_status(Orders $order, $action)
    {

      $updatOrderStatus = Orders::find($order->idorders);
      $updatOrderStatus->status = $action;
      if ($action == 'w') {
        //save received
        $save_received  = new Received;
        $save_received->idusers = Auth::user()->idusers;
        $save_received->save();

        $updatOrderStatus->received_by = $save_received->idreceived;

      }elseif ($action == 'a') {
        //save accepted
        $save_accepted = new Accepted;
        $save_accepted->idusers = Auth::user()->idusers;
        $save_accepted->save();

        $updatOrderStatus->accepted_by = $save_accepted->idaccepted;
      } elseif ($action == 'h') {
        $save_accepted = new Broken;
        $save_accepted->idusers = Auth::user()->idusers;
        $save_accepted->save();

        $updatOrderStatus->accepted_by = $save_accepted->idbroken;
      }
      $updatOrderStatus->save();
      return redirect('orders')->with('status_success','Status updated');

    }

    protected function get_code()
  	{
  		$date_ym = date('ym');
  		$date_between = [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')];

  		$dataOrders = Orders::select('code')
  			->whereBetween('created_at',$date_between)
  			->orderBy('code','desc')
  			->first();

  		if(is_null($dataOrders)) {
  			$nowcode = '00001';
  		} else {
  			$lastcode = $dataOrders->code;
  			$lastcode1 = intval(substr($lastcode, -5))+1;
  			$nowcode = str_pad($lastcode1, 5, '0', STR_PAD_LEFT);
  		}

  		return 'PO-'.$date_ym.'-'.$nowcode;
  	}

    

}
