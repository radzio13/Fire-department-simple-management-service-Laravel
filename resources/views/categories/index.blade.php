@extends('layouts.app')

@section('content')

@if (session()->has('error'))
   <div class="alert alert-danger">
   	{{ session()->get('error')}}
   </div>

@endif   
<div class="clearfix">
	<a class="btn btn-success float-right" href="{{ route('categories.create') }}">Stwórz kategorie</a>
</div>
<div>
	
	<table class="table">
		<tbody>
			@foreach($categories as $category)
			<tr>
				<td>{{$category->name}}</td>
			
				<td>
				<form action="{{ route('categories.destroy', $category->id) }}" method="POST">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger float-right ml-2">Usuń</button>
				</form>	
				<a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary float-right">Edytuj</a>
				</td>
			</tr>
            @endforeach
		</tbody>
	</table>
</div>
@endsection