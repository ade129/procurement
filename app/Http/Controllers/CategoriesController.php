<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('admin');
  }

  public function index()
  {
    $contents = [
      'categories' => Categories::all(),
    ];
    // dd($contents);
    $pagecontent = view('categories.index',$contents );

    //masterpage
    $pagemain = array(
        'title' => 'Categories',
        'menu' => 'master',
        'submenu' => 'categories',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function create_page()
  {
    $pagecontent = view('categories.create');

    //masterpage
    $pagemain = array(
        'title' => 'Categories',
        'menu' => 'categories',
        'submenu' => 'categories',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function save_page(Request $request)
  {
    $request->validate([
         'name' => 'required',
     ]);

     $saveCategories = new Categories;
     $saveCategories->name = $request->name;
     $saveCategories->save();
     return redirect('categories')->with('status_success','Created categories');
  }

  public function update_page(Categories $categories)
  {
    $content = [
      'categories' => Categories::find($categories->idcategories),
    ];
    // dd($contents);
    $pagecontent = view('categories.update',$content);

    //masterpage
    $pagemain = array(
        'title' => 'Categories',
        'menu' => 'categories',
        'submenu' => 'categories',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function update_save(Request $request,Categories $categories)
  {
    $request->validate([
         'name' => 'required',
     ]);

     $updateCategories = Categories::find($categories->idcategories);
     $updateCategories->name = $request->name;
     $updateCategories->save();
     return redirect('categories')->with('status_success','Created categories');
  }

  public function delete(Categories $categories)
  {
    $categories = Categories::find($categories->idcategories);
    if (!empty($categories)) {
      $categories->delete();
    }
    return redirect('categories')->with('status_success','Deleted categories');
  }

  public function restore()
  {
    $test = Categories::withTrashed()->restore();
    return redirect ('categories')->with('status_success','Restore categories');
  }

}
