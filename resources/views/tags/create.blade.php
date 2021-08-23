@extends('layouts.app')

@section('content')


<div class="card card-default">
	<div class="card-header">
		{{ isset($tag->id) ? "Update tag" : "Utwórz tag" }}
	</div>
	<div class="card-body">
		<form action="{{ isset ($tag) ? route('tags.update',$tag->id) : route('tags.store')}}" method="POST">
			@csrf
			@if (isset($tag))
			     @method('PUT')
			@endif     
		  <div class="form-group">
		    <label for="exampleInputEmail1">{{ isset($tag) ? "Zaktualizuj tag" : "Wprowadź tag" }}</label>
		    <input type="text" class="@error('name') is-invalid @enderror form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" placeholder="Wprowadź tag" value="{{ isset ($tag) ? $tag->name : '' }}">
		    @error('name')
		    <div class = "alert alert-danger">
		    	{{ $message }}
		    </div>
		    @enderror		
		   
		  </div>
		  <div class="form-group">
		    <button class="btn btn-success">{{ isset($tag->id) ? "Zaktualizuj" : "Dodaj" }}</button>
		  </div>
		</form>
	</div>

</div>


@endsection