@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title">Categories</div>

                <div class="panel-body">

                  {{Form::open(array('url' => '/add_category', 'method' => 'post', 'class' => 'form_category clear_fl'))}}
                      {{ Form::text('name', null, array('id'=>'name', 'placeholder' => 'Enter category name')) }}
                      {{ Form::text('description', null, array('id'=>'description', 'placeholder' => 'Enter description')) }}
                      {{ Form::submit('Add category') }}
                  {{Form::close()}}

                  <div class="categories">
                    @foreach($categories as $category)
                      @include('includes.category', ['category' => $category])
                    @endforeach
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).on("submit", ".form_category", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/add_category",
        dataType: 'json',
        data: { name: $(".form_category #name").val(), description: $(".form_category #description").val(), },
        //adding new category block if ajax was success
        success: function(success) {
          $(".categories").append("<div class='category'><h4 class='name'>"+success.name+"</h4><h5 class='description'>"+success.description+"</h5> <input type='hidden' name='category_id' value='"+success.id+"' class='category_id'> <p> <a href='/edit_category/"+success.id+"'>Edit category</a> </p> <p><a class='delete_category' href='#'>Delete category</a></p></div>");
        }
      });
  });

  //ajax for deleting categorys
  $(document).on("click", ".delete_category", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_category",
        dataType: 'json',
        data: { id: $(this).parent().parent().find(".category_id").val() },
        //adding new category block if ajax was success
        success: function(success) {
          $("input[value='" + success + "']").parent().remove();
        }
      });
  });
</script>

@endsection
