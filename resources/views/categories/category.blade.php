@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title">{{$articles[0]->category->name}}</div>

                <div class="panel-body">
                  <div class="articles">
                    @foreach($articles as $article)
                      @include('includes.article', ['article' => $article])
                    @endforeach
                  </div>
                </div>

                <div class="panel panel-default content">
                    <div class="panel-heading"><h3>Feedbacks to this category</h3></div>

                    {{Form::open(array('url' => '/add_feedback_category', 'method' => 'post', 'class' => 'form_feedback clear_fl'))}}
                        {{ Form::text('author', null, array('id'=>'author', 'placeholder' => 'Enter your name', 'required')) }}
                        {{ Form::text('text', null, array('id'=>'text', 'placeholder' => 'Enter the text')) }}
                        {{ Form::submit('Add feedback') }}
                    {{Form::close()}}


                    @if(isset($category->category_feedbacks))
                    <div class="panel-body feedbacks">
                      @foreach($category->category_feedbacks as $feedback)
                        @include('includes.feedback_category', ['feedback' => $feedback])
                      @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).on("submit", ".form_feedback", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/add_feedback_category",
        dataType: 'json',
        data: { author: $(".form_feedback #author").val(), text: $(".form_feedback #text").val(), category_id: {{$articles[0]->category->id}} },
        //adding new feedback block if ajax was success
        success: function(success) {
          $(".feedbacks").append("<div class='feedback'><p>"+success.text+"</p><h5>"+success.author+"</h5><p>"+ success.created_at +"</p> <input type='hidden' name='feedback_id' value='"+success.id+"' class='feedback_id'> <p> <a href='/edit_feedback/"+success.id+"' class='edit_feedback'> Edit </a> </p>  <p><a href='#' class='delete_feedback'>Delete</a></p> </div>");
        }
      });
  });

  $(document).on("click", ".delete_feedback_category", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_feedback_category",
        dataType: 'json',
        data: { id: $(this).parent().parent().find(".feedback_id").val() },
        //adding new article block if ajax was success
        success: function(success) {
          $(".feedbacks input[value='" + success + "']").parent().remove();
        }
      });
  });
</script>
@endsection
