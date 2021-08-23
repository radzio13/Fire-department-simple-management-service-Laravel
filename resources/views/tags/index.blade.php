@extends('layouts.app')

@section('content')

@if (session()->has('error'))
   <div class="alert alert-danger">
   	{{ session()->get('error')}}
   </div>

@endif   
<div class="clearfix">
	<a class="btn btn-success float-right" href="{{ route('tags.create') }}">Utwórz tag</a>
</div>
<div>
	
	<table class="table">
		<tbody>
			@foreach($tags as $tag)
			<tr>
				<td>{{ $tag->name }}<span class="ml-2 badge badge-primary">{{$tag->posts->count()}}</span></td>
			
				<td>
				<form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger float-right ml-2">Usuń</button>
				</form>	
				<a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary float-right">Edytuj</a>
				</td>
			</tr>
            @endforeach
		</tbody>
	</table>
</div>
@endsection