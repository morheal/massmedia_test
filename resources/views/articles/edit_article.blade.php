@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title">Dashboard</div>

                <div class="panel-body">
                    {{Form::open(array('url' => '/edit_article', 'method' => 'post', 'class' => 'form_article clear_fl', 'enctype' => "multipart/form-data"))}}
                        {{ Form::text('name', null, array('id'=>'name', 'placeholder' => 'Enter a title')) }}
                        {{ Form::textarea('content', null, array('id'=> 'content', 'cols' => '98', 'placeholder' => 'Enter content')) }}
                        {{ Form::file('image', array('id' => 'file')) }}
                        {{ Form::select('category', $categories) }}
                        {{ Form::submit('Edit article', ['class' => 'btn_style']) }}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

  var article_id = {{$article->id}};

  $(document).on("ready", function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })

    $('#name').val("{{$article->name}}");
    $('#content').val("{{$article->content}}");
  });

  $(document).on("submit", ".form_article", function(e) {

      e.preventDefault();
      var form_data = new FormData();
      form_data.append("id", article_id);
      form_data.append('name', $(".form_article #name").val());
      form_data.append('category', $(".form_article select").val());
      form_data.append('content', $(".form_article #content").val());
      form_data.append('image', $(".form_article #file").prop("files")[0]);
      $.ajax({
        method: "POST",
        url: "/edit_article",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        //adding new article block if ajax was success
        success: alert("Article has been successfuly changed!");
      });
  });
</script>
@endsection
