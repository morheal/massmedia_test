<div class="article">
  <h3 class="name"><a href="/article/{{$article->id}}">{{$article->name}}</a></h3>
  <p>{{$article->content}}</p>
  <input type="hidden" name="article_id" value="{{$article->id}}" class="article_id">
  <p class="category"><a href="/category/{{$article->category->id}}">{{$article->category->name}}</a></p>
  <p> <a href="/edit_article/{{$article->id}}"> Edit article </a> </p>
  <p><a href="#" class="delete_article">Delete article</a></p>
</div>
