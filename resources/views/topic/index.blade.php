@extends('layouts.app')
@section('content')
<div class="container">
	<div class=" list-group ">
		@foreach($topics as $topic)
		<div class="list-group-item">
			<h4>
				<a href="{{route('topic.show', $topic)}}" class="text-decoration-none">{{$topic->title}}</a>
			</h4>
			<p>
				{{$topic->content}}
			</p>
			<div class="d-flex justify-content-between align-items-center">
				<small>Posté le: {{$topic->created_at->format('d/m/Y à H:m')}}</small>
				<span class="badge badge-primary font-italic">
					{{$topic->user->name}}
				</span>
			</div>
			
		</div>

         @endforeach
		<div class="d-flex justify-content-center ">{{$topics->links()}}</div>
	</div>
</div>
@endsection