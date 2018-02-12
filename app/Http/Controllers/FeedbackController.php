<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use Response;
use Redirect;

class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
      $text = $request->text;
      $author = $request->author;
      $article_id = $request->article_id;
      $new_feedback = Feedback::create(['text' => $text, 'article_id' => $article_id, 'author' => $author, 'created_at' => date("m.d.y")]);
      return Response::json($new_feedback);
    }

    public function deleteFeedback(Request $request)
    {
      Feedback::deleteById($request->id);
      return Response::json($request->id);
    }

    public function editFeedbackView($id)
    {
      $feedback = Feedback::find($id);
      $browser_data = Session::getUsersInfo();
      return view('feedbacks.edit_feedback', ['feedback' => $feedback, 'browsers_data' => $browser_data]);
    }

    public function editFeedback(Request $request)
    {
      $feedback = Feedback::find($request->id);
      $feedback->editFeedback($request->author, $request->text);

      return Redirect::to('/article/'.$feedback->article_id);
    }
}
