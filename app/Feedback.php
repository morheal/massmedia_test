<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Feedback;
use App\Article;

class Feedback extends Model
{
    protected $fillable = ['author', 'article_id', 'text'];

    //RELATIONSHIPS FUNCTIONS
    public function article()
    {
      return $this->belongsTo('App\Article');
    }
    /////////////////////////

    public static function deleteById($id)
    {
      Feedback::find($id)->delete();
      return;
    }

    public function editFeedback($author, $text)
    {
      $new_author = '';
      $new_text = '';

      if(isset($author)) $new_author = $author;
      else $new_author = $this->author;

      if(isset($text)) $new_text = $text;
      else $new_text = $this->text;

      $this->update(['author' => $new_author, 'text' => $new_text]);
      return;
    }
}
