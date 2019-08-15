<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\User;
use App\Models\Orders;
use Auth;
class NotificationsController extends Controller
{
  public function __construct()
    {
      $this->middleware('auth');
    }
    
    public function index()
    {

      $contents = [
        'notifications' => Notifications::with(['users','orders' => function($order){
                                $order->with(['orders_details' => function($od){
                                  $od->with('items');
                                }
                            ]);
                          }
                        ])
                        ->where('idusers', Auth::user()->idusers)
                        ->Where('seen' , FALSE)->get(),
      ];
      // return $contents;
      $pagecontent = view('notifications.index', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Notifications',
          'menu' => '',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function read(Notifications $notif,$seen)
    {
        $readNotifications = Notifications::find($notif->idnotifications);
        $readNotifications->seen = $seen;
        $readNotifications->save();

        return redirect('notifications')->with('status_success','Notifications Updated');
    }
}
