<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;
use App\Category;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class Article extends Model
{
    protected $fillable = ['name', 'content', 'file', 'category_id'];

    //RELATIONSHIPS FUNCTIONS
    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function feedbacks()
    {
      return $this->hasMany('App\Feedback');
    }
    //////////////////////////

    public static function deleteById($id)
    {
      $this_article = Article::find($id);
      Storage::delete("uploads/".$this_article->file);
      $this_article->delete();
      return;
    }

    public static function saveArticleImage($img)
    {
      $file_name = str_random(30).'.jpeg';
      Image::make($img)->save('uploads/'.$file_name, 60);
      return $file_name;
    }

    public function articleUpdate($name, $content, $file)
    {
      $new_name = '';
      $new_content = '';
      $file_name = '';

      if(isset($name)) $new_name = $name;
      else $new_name = $this->name;

      if(isset($content)) $new_content = $content;
      else $new_content = $this->content;

      if(isset($file)) {
        Storage::delete("uploads/".$this->file);
        $file_name = Article::saveArticleImage($file);
      }
      else $file_name = $this->file;

      $this->update(['name' => $new_name, 'content' => $new_content, 'file' => $file_name]);
      return;
    }
}
