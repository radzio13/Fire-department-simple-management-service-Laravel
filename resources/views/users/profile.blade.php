@extends('layouts.app')

@section('content')


<div class="card card-default">
	<div class="card-header">
		Profil
	</div>
	<div class="card-body">
		<form action="{{ route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
			    @csrf
		 <div class="form-group">
		    <label> Nazwa</label>
		    <input type="text" name="name"  value="{{ $user->name  }}" class="form-control">
          </div>
          <div class="form-group">
		    <label>Email</label>
		    <input type="text" name="email"  value="{{ $user->email }}" class="form-control">
		  </div>
		  <div class="form-group">
		      <label>Opis</label>
		      <textarea  class="form-control" name="about" rows="2">{{$profile->about}}</textarea>
		  </div>
		  <div class="form-group">
		   	<label> Facebook</label>
		    <input type="text"  class="form-control" name="facebook"  value="{{$profile->facebook}}">
		  </div>
		  <div class="form-group">
		   	<label>Twitter</label>

		    <input type="text" class="form-control" name="twitter"  value="{{$profile->twitter}}">
		  </div>
		  <div class="form-group">
		  	<label>Obrazek</label>
            <img class="form-control" src="{{$user->hasPicture() ?  asset('http://gravatar.com/avatar/fdd7198d5b958226532cf8545721f96f'. $user->getPicture()) : $user->getGravatar()}}" style="width:100px; height:100px">

		    <input type="file" class="form-control" name="picture">
		  </div>
		  <div>
		    <button class="btn btn-success">Zaktualizuj</button>
		  </div>
		</form>
	</div>

</div>


@endsection
