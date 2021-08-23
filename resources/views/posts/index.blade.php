@extends('layouts.app')

@section('content')

<div class="clearfix">
	<a class="btn btn-success float-right" href="{{ route('posts.create') }}">Utwórz post</a>
</div>
<div>

	<table class="table">
		<thead>
			<tr>
				<th>Obrazek</th>
				<th>Tytuł</th>
                <th>Opis</th>
                <th>Treść</th>
				<th>Akcja</th>
			</tr>
		</thead>
		<tbody>
			<div class="row">
				<div class="col-md-9">
	       @if(isset($posts) && $posts->count() > 0)
			@foreach($posts as $post)

					<tr>
						<td>
							<img src="https://galeria.bankier.pl/p/1/f/c3030b088d0ff5-645-387-1372-1124-2051-1231.jpg" width="80px" height="40px">
						</td>
						<td>{{$post->title}}</td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->content}}</td>
						<td>
                            @if(auth()->user()->isAdmin())
						<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger float-right ml-2">
						{{$post->trashed() ? "Usuń" : "Usuń"}}
					    </button>
						</form>
						@if (!$post->trashed())
						<a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary float-right">Edytuj</a>
						@else
						<a href="{{route('trashed.restore',$post->id)}}" class="btn btn-primary float-right">Przywracać</a>
						@endif
                            @endif
						</td>
					</tr>

            @endforeach

           @endif
           	</div>
			</div>


		</tbody>
	</table>
</div>
@endsection
