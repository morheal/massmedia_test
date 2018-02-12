<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Article;
use App\Category;
use App\Feedback;
use App\Session;
use Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class ArticleController extends Controller
{
    public function addArticle(Request $request)
    {
      $name = $request->name;
      $content = $request->content;
      $category = $request->category;
      $file_name = Article::saveArticleImage($request->file("image"));
      $new_article = Article::create(['name' => $name, 'content' => $content, 'file' => $file_name, 'category_id' => $category]);
      $article_category = Category::find($category);
      return Response::json(['article' => $new_article, 'category' => $article_category]);
    }

    public function editArticleView($id)
    {
      $article = Article::find($id);
      $categories = Category::categoriesSelectData();

      $browser_data = Session::getUsersInfo();
      return view('articles.edit_article', ['article' => $article, 'categories' => $categories, 'browsers_data' => $browser_data]);
    }

    public function editArticle(Request $request)
    {
      $article = Article::find($request->id);
      $article->articleUpdate($request->name, $request->content, $request->image);

      return Response::json($request->image);
    }

    public function deleteArticle(Request $request)
    {
      Article::deleteById($request->id);
      return Response::json($request->id);
    }

    public function deleteArticleRedirect($id)
    {
      Article::deleteById($request->id);
      return Redirect::back();
    }

    public function articleShow($id)
    {
      $this_article = Article::find($id);
      $browser_data = Session::getUsersInfo();
      return view('articles.article', ['article' => $this_article, 'browsers_data' => $browser_data]);
    }
}
