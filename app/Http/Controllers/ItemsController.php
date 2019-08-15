<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Items;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
      $contents = [
        'items' => Items::with('users','categories')->get()
      ];
      // return $contents;
      // dd($contents);
      $pagecontent = view('items.index',$contents);

      //masterpage
      $pagemain = array(
          'title' => 'Master Items',
          'menu' => 'master',
          'submenu' => 'items',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_page()
    {
      $contents = [
        'categories' => Categories::all(),
      ];
      $pagecontent = view('items.create',$contents);

      //masterpage
      $pagemain = array(
          'title' => 'Master Items',
          'menu' => 'Master',
          'submenu' => 'Items',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_save(Request $request)
    {
      $request->validate([
        'name' => 'required|max:100',
        'code' => 'required',
        'unit' => 'required',
        'brand' => 'required',
        'active' => ''
      ]);

      if(empty($request->idcategories))
	    return back()->withInput($request->input())->with('status_error','Categories empty');
      //active
      $active = FALSE;
      if($request->has('active')) {
          $active = TRUE;
      }

      $saveItems = new Items;
      $saveItems->idcategories = $request->idcategories;
      // $saveItems->idusers = Auth::user()->idusers;
      $saveItems->fill($request->all());
      $saveItems->active = $active;
      $saveItems->save();
      return redirect('items')->with('status_success','New item created');
    }

    public function update_page(Items $item)
    {
      $contents = [
        'item' => $item,
        'categories' => Categories::all(),
      ];
      $pagecontent = view('items.update',$contents);

      //masterpage
      $pagemain = array(
          'title' => 'Master Items',
          'menu' => 'Master',
          'submenu' => 'Items',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function save_update(Request $request, Items $item)
    {
      $request->validate([
        'name' => 'required|max:100',
        'code' => 'required',
        'unit' => 'required',
        'brand' => 'required',
        'active' => ''
      ]);

      if(empty($request->idcategories))
      return back()->withInput($request->input())->with('status_error','Categories empty');
      //active
      $active = FALSE;
      if($request->has('active')) {
          $active = TRUE;
      }

      $updateItems = Items::find($item->iditems);
      $updateItems->idcategories = $request->idcategories;
      // $updateItems->idusers = Auth::user()->idusers;
      $updateItems->fill($request->all());
      $updateItems->active = $active;
      $updateItems->save();

      return redirect('items')->with('status_success','item updated');
    }

    public function delete(Items $item)
    {
      $item = Item::find($item->iditems);
      if (!empty($item)) {
        $item->delete();
      }
      return redirect('items')->with('status_success','item deleted');

    }
}
