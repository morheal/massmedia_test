<div class="feedback">
  <p>{{$feedback->text}}</p>
  <h5>{{$feedback->author}}</h5>
  <p>{{$feedback->created_at}}</p>
  <input type="hidden" name="feedback_id" value="{{$feedback->id}}" class="feedback_id">
  <p> <a href="/edit_feedback/{{$feedback->id}}" class="edit_feedback"> Edit </a> </p>
  <p> <a href="#" class="delete_feedback"> Delete </a> </p>
</div>
