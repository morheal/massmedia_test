<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Response;
use Redirect;
use App\Session;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
      $name = $request->name;
      $description = $request->description;
      $new_category = Category::create(['name' => $name, 'description' => $description]);
      return Response::json($new_category);
    }

    public function deleteCategory(Request $request)
    {
      Category::deleteById($request->id);
      return Response::json($request->id);
    }

    public function findCategory($id)
    {
      $this_category = Category::find($id);
      $articles = $this_category->articles;
      $browser_data = Session::getUsersInfo();
      return view('categories.category', ['category' => $this_category, 'articles' => $articles, 'browsers_data' => $browser_data]);
    }

    public function editCategoryView($id)
    {
      $category = Category::find($id);
      $browser_data = Session::getUsersInfo();
      return view('categories.edit_category', ['category' => $category, 'browsers_data' => $browser_data]);
    }

    public function editCategory(Request $request)
    {
      $category = Category::find($request->id);
      $category->editCategory($request->name, $request->description);
      return Redirect::to('categories');
    }
}
