@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{Form::open(array('url' => '/add_article', 'method' => 'post', 'class' => 'form_article clear_fl', 'enctype' => "multipart/form-data"))}}
                        {{ Form::text('name', null, array('id'=>'name', 'placeholder' => 'Enter a title')) }}
                        {{ Form::textarea('content', null, array('id'=> 'content', 'cols' => '98', 'placeholder' => 'Enter content')) }}
                        {{ Form::file('image', array('id' => 'file')) }}
                        {{ Form::select('category', $categories) }}
                        {{ Form::submit('Add article', ['class' => 'btn_style']) }}
                    {{Form::close()}}

                    <div class="articles">
                      @foreach($articles as $article)
                        @include('includes.article', ['article' => $article])
                      @endforeach
                      {{$articles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

  $(document).on("ready", function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
  });

  $(document).on("submit", ".form_article", function(e) {

      e.preventDefault();
      var form_data = new FormData();
      form_data.append('name', $(".form_article #name").val());
      form_data.append('category', $(".form_article select").val());
      form_data.append('content', $(".form_article #content").val());
      form_data.append('image', $(".form_article #file").prop("files")[0]);
      $.ajax({
        method: "POST",
        url: "/add_article",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        //adding new article block if ajax was success
        success: function(success) {
          $(".articles").append("<div class='article'>"+
                                  "<h3 class='name'><a href='/article/"+success.article.id+"'>"+success.article.name+"</a></h3>"+
                                  "<p>"+success.article.content+"</p>"+
                                  "<input type='hidden' name='article_id' value='"+success.article.id+"' class='article_id'>"+
                                  "<p class='category'><a href='/category/'"+success.category.id+"'>"+success.category.name+"</a></p>"+
                                  "<p><a class='delete_article' href='#'>Delete article</a></p>"+
                                "</div>");
        }
      });
  });

  //ajax for deleting articles
  $(document).on("click", ".delete_article", function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "/delete_article",
        dataType: 'json',
        data: { id: $(this).parent().parent().find(".article_id").val() },
        //adding new article block if ajax was success
        success: function(success) {
          $("input[value='" + success + "']").parent().remove();
        }
      });
  });

</script>
@endsection
