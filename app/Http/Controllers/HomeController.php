<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use App\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories_data = Category::categoriesSelectData();
        $articles = Article::paginate(5);
        $browser_data = Session::getUsersInfo();
        return view('home', ['articles' => $articles, 'categories' => $categories_data, 'browsers_data' => $browser_data]);
    }

    public function categories()
    {
        $categories = Category::paginate(5);
        $browser_data = Session::getUsersInfo();
        return view('categories.categories', ['categories' => $categories, 'browsers_data' => $browser_data]);
    }
}
