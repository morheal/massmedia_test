@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title"><h2>{{$article->name}}</h2></div>

                <div class="panel-body">
                  <div class="article_image"> <img src="/uploads/{{$article->file}}" alt=""> </div>
                  <p class="article_content">{{$article->content}}</p>
                  <p><a href="/category/{{$article->category->id}}" class="article_category">{{$article->category->name}}</a></p>
                  <p><a href="#" class="delete_article">Delete article</a></p>
                </div>
            </div>
            <!--Feedback section-->
            <div class="panel panel-default content">
                <div class="panel-heading"><h3>Feedbacks to this article</h3></div>

                {{Form::open(array('url' => '/add_feedback', 'method' => 'post', 'class' => 'form_feedback clear_fl'))}}
                    {{ Form::text('author', null, array('id'=>'author', 'placeholder' => 'Enter your name')) }}
                    {{ Form::text('text', null, array('id'=>'text', 'placeholder' => 'Enter the text')) }}
                    {{ Form::submit('Add feedback') }}
                {{Form::close()}}

                @if(isset($article->feedbacks))
                <div class="panel-body feedbacks">
                  @foreach($article->feedbacks as $feedback)
                    @include('includes.feedback', ['feedback' => $feedback])
                  @endforeach
                @endif
                </div>
            </div>
            <!----------------------------->
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
    var regexp = /^([a-zA-Zа-яА-Я]+\s+){2}$/ ;
    if(!regexp.test($(".form_feedback #author").val() + ' ')) {
      alert("You entered wrong name, please try again");
      return;
    }
    $.ajax({
      type: "POST",
      url: "/add_feedback",
      dataType: 'json',
      data: { author: $(".form_feedback #author").val(), text: $(".form_feedback #text").val(), article_id: {{$article->id}} },
      //adding new feedback block if ajax was success
      success: function(success) {
        $(".feedbacks").append("<div class='feedback'><p>"+success.text+"</p><h5>"+success.author+"</h5><p>"+ success.created_at +"</p> <input type='hidden' name='feedback_id' value='"+success.id+"' class='feedback_id'> <p> <a href='/edit_feedback/"+success.id+"' class='edit_feedback'> Edit </a> </p>  <p><a href='#' class='delete_feedback'>Delete</a></p> </div>");
      }
    });
});

  $(document).on("click", ".delete_article", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_article_redirect",
        dataType: 'json',
        data: { id: $('.article_id').val() },
        //adding new article block if ajax was success
        success: function(success) {
          $("input[value='" + success + "']").parent().remove();
        }
      });
  });

  $(document).on("click", ".delete_feedback", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_feedback",
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
