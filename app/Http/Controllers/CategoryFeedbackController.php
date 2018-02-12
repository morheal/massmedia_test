<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryFeedback;
use Response;
use Redirect;
use App\Session;

class CategoryFeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
      $text = $request->text;
      $author = $request->author;
      $category_id = $request->category_id;
      $new_feedback = CategoryFeedback::create(['text' => $text, 'category_id' => $category_id, 'author' => $author, 'created_at' => date("m.d.y")]);
      return Response::json($new_feedback);
    }

    public function deleteFeedback(Request $request)
    {
      CategoryFeedback::deleteById($request->id);
      return Response::json($request->id);
    }

    public function editFeedbackView($id)
    {
      $feedback = CategoryFeedback::find($id);
      $browser_data = Session::getUsersInfo();
      return view('feedbacks.edit_feedback_category', ['feedback' => $feedback, 'browsers_data' => $browser_data]);
    }

    public function editFeedback(Request $request)
    {
      $feedback = CategoryFeedback::find($request->id);
      $feedback->editFeedback($request->author, $request->text);

      return Redirect::to('/category/'.$feedback->category_id);
    }
}
