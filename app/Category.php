<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Article;
use App\CategoryFeedback;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    //RELATIONSHIPS FUNCTIONS
    public function articles()
    {
      return $this->hasMany('App\Article');
    }

    public function category_feedbacks()
    {
      return $this->hasMany('App\CategoryFeedback');
    }
    //////////////////////////

    public static function deleteById($id)
    {
      Category::find($id)->articles()->delete();
      Category::find($id)->delete();
      return;
    }

    public static function categoriesSelectData()
    {
      $categories = Category::get();
      $categories_data = [];
      foreach ($categories as $category) {
        array_push($categories_data, [$category->id => $category->name]);
      }
      return $categories_data;
    }

    public function editCategory($name, $description)
    {
      $new_description = '';
      $new_name = '';

      if(isset($description)) $new_description = $description;
      else $new_description = $this->description;

      if(isset($name)) $new_name = $name;
      else $new_name = $this->name;

      $this->update(['description' => $new_description, 'name' => $new_name]);
      return;
    }
}
