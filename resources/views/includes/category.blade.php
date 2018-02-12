<div class="category">
  <a href="/category/{{$category->id}}"><h4 class="name">{{$category->name}}</h4></a>
  <h5 class="description">{{$category->description}}</h5>
  <input type="hidden" name="category_id" value="{{$category->id}}" class="category_id">
  <p> <a href="/edit_category/{{$category->id}}">Edit category</a> </p>
  <p> <a href="#" class="delete_category">Delete category</a> </p>
</div>
