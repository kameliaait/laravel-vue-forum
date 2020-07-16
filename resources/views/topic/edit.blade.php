@extends('layouts.app')
@section('content')
<div class="container">
	<div class=" list-group ">
		<form action="{{route('topic.update',$topic)}}" method="POST">
	@csrf
	@method('PUT')
	<h1>Modifier mon topic: </h1>
	<div>
	@include('topic._form',['submitButton'=>'confirmer les modifications'])
    <a href="{{route('topic.show',$topic)}}" class="btn btn-secondary btn-block">Annuler</a>
</div>
	</form>
		
	</div>
</div>
@endsection