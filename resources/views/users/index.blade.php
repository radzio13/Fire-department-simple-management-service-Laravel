@extends('layouts.app')

@section('content')

<div class="clearfix">

<div>

	<table class="table">
		<thead>
			<tr>
				<th>Obrazek</th>
				<th>Nazwa użytkownika</th>
				<th>Uprawnienia</th>
			</tr>
		</thead>
		<tbody>

				@foreach($users as $user)
				<tr>
					<td>

	                    <img src=" {{$user->hasPicture() ?  asset('http://gravatar.com/avatar/fdd7198d5b958226532cf8545721f96f'. $user->getPicture()) : $user->getGravatar()}}" style='border-radius: 25%' width='25%' heught='25%'>
					</td>

					<td>{{$user->name}}</td>
					<td>
						@if(!$user->isAdmin())
						   <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
						   	 @csrf
						    <button type="submit" class="btn btn-success">Dodaj</button>
						   </form>
                            <form action="{{ route('users.delete-user', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger ">Usuń</button>
                            </form>



						@else
						  {{$user->role}}

						@endif

					</td>

				</tr>
	            @endforeach




		</tbody>
	</table>
</div>
@endsection
