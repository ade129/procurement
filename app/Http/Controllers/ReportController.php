<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Models\Items;
use App\Models\Orders;
use App\Models\OrdersDetails;
use App\Models\Categories;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

  public function failed()
  {
       
      $orders = Orders::with(['users','orders_details' => function($od){
                      $od->with(['items' => function ($item){
                          $item->with('categories');
                        }
                    ]);
                    },'received' => function($received){
                        $received->with('users');
                    },'accepted' => function($accepted){
                        $accepted->with('users');
                  }
                ])->where('status', '=', 'f')->get();
    
    $contents = [
      'orders' => $orders,
    ];
    // return $orders;
    $pagecontent = view('report.failed',$contents);
    //masterpage
    $pagemain = array(
      'title' => 'Report Failed',
      'menu' => 'report',
      'submenu' => 'failed',
      'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function report()
    {
     
      $orders = Orders::with(['users','orders_details' => function($od){
                      $od->with(['items' => function ($item){
                          $item->with('categories');
                        }
                    ]);
                    },'received' => function($received){
                        $received->with('users');
                    },'accepted' => function($accepted){
                        $accepted->with('users');
                  }
                ])->where('status', '=', 'a')->get();
    
      $contents = [
          'orders'=> $orders,
      ];
      // return $contents;
    
      $pagecontent = view('report.index',$contents);
    
      $pagemain = array(
          'title' => 'Report Accepted ',
          'menu' => 'report',
          'submenu' => 'approved',
          'pagecontent' => $pagecontent,
      );
      return view('masterpage', $pagemain);
    }
    
    public function print_pdf(Orders $order)
    {
      // $orders =  Orders::with(['users','orders_details' => function($od){
      //                 $od->with(['items' => function ($item){
      //                   $item->with('categories');
      //                 }
      //               ]);
      //             }
      //           ])->where('idorders',$order->idorders)->first();
      $orders = Orders::with(['users','orders_details' => function($od){
                      $od->with(['items' => function ($item){
                          $item->with('categories');
                        }
                    ]);
                    },'received' => function($received){
                        $received->with('users');
                    },'accepted' => function($accepted){
                        $accepted->with('users');
                  }
                ])->where('status', '=', 'a')->where('idorders',$order->idorders)->first();

      $contents = [
        'orders'=> $orders,
      ];
      // return $contents;      
      $pdf = PDF::loadView('report.downloadPDF',$contents)
                   ->setPaper('A4','landscape');
       return $pdf->stream();
    }

}
