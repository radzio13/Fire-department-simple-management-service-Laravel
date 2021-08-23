@extends('layouts.app')

@section('content')

@section('stylesheet')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" rel="stylesheet">
@endsection

<div class="card card-default">
	<div class="card-header">
		{{isset($post) ? "Zaktualizuj" : "Utwórz"}}
	</div>
	<div class="card-body">
		<form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			@if (isset($post))
			  @method('PUT')

            @endif
		  <div class="form-group">
		    <label for="exampleInputEmail1">Tytuł: </label>
		    <input type="text" class="form-control" name="title" aria-describedby="emailHelp" placeholder="wpisz tytuł" value="{{ isset ($post) ? $post->title : '' }}">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Opis: </label>
		   <textarea class="form-control" name="description" placeholder="wpisz opis" rows="2">{{ isset($post) ? $post->description : "" }}</textarea>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Zawartość: </label>


              <textarea class="form-control" name="content" placeholder="wpisz zawartosc" rows="2">{{ isset($post) ? $post->content : "" }}</textarea>
		  </div>

		  @if(isset($post))
			  <div class="form-group">
			  	 <img src="https://galeria.bankier.pl/p/1/f/c3030b088d0ff5-645-387-1372-1124-2051-1231.jpg" width="100%">
			  </div>
		  @endif
		  <div class="form-group">
		    <label for="exampleInputEmail1">Obrazek: </label>

		   <input type="file" name="image" class="form-control">
		  </div>
		    <div class="form-group">
			    <label for="selectCategory">Wybierz kategorie:</label>
			    <select class="form-control" id="selectcategory" name="categoryID">
			    @foreach($categories as $category)
				       <option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			    </select>
			</div>
			@if(!$tags->count() <= 0)
				<div class="form-group">
				    <label for="selectTag">Wybierz tag:</label>
				    <select class="form-control" id="selecttag" name="tags[]" multiple>
				    @foreach($tags as $tag)
				      <option value="{{ $tag->id }}"
				      @if(isset($posts) && $posts->count() > 0)
				      	@foreach($posts as $post)
					      	@if($post->hasTag($tag->id))
					      	   selected
					      	@endif
				      	@endforeach

				      @endif
				      	  >{{ $tag->name }}</option>
					@endforeach
				    </select>
				</div>
			@else
			  <div class="alert alert-danger">Brak tagów</div>
			@endif

		  <div class="form-group">
		    <button class="btn btn-success" type="submit">Dodaj</button>
		  </div>
		</form>
	</div>

</div>


@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>

@endsection
