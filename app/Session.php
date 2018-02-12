<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['user_id', 'browser', 'ip'];

    public static function getUsersInfo()
    {
      $data = [];
      $browsers = Session::groupBy('browser')->pluck('browser');
      foreach ($browsers as $browser) {
        $user_count = Session::where('browser', $browser)->count();
        array_push($data, ['browser' => $browser, 'count' => $user_count]);
      }
      //dd($data);
      return $data;
    }
}
