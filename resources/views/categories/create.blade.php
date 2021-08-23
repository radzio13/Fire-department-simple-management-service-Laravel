@extends('layouts.app')

@section('content')


<div class="card card-default">
	<div class="card-header">
		{{ isset($category->id) ? "Zaktualizuj kategorie " : "Stwórz kategorie" }}
	</div>
	<div class="card-body">
		<form action="{{ isset ($category) ? route('categories.update',$category->id) : route('categories.store')}}" method="POST">
			@csrf
			@if (isset($category))
			     @method('PUT')
			@endif     
		  <div class="form-group">
		    <label for="exampleInputEmail1">{{ isset($category) ? "Zaktualizuj kategorie" : "Wprowadź kategorie" }}</label>
		    <input type="text" class="@error('name') is-invalid @enderror form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" placeholder="Wprowadź kategorie" value="{{ isset ($category) ? $category->name : '' }}">
		    @error('name')
		    <div class = "alert alert-danger">
		    	{{ $message }}
		    </div>
		    @enderror		
		   
		  </div>
		  <div class="form-group">
		    <button class="btn btn-success">{{ isset($category->id) ? "Zaktualizuj" : "Dodaj" }}</button>
		  </div>
		</form>
	</div>

</div>


@endsection