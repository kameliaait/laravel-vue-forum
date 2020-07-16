@extends('layouts.app')

@section('content')
<div class="container">
	<div class=" list-group ">
		<form action="{{route('topic.store')}}" method="POST">
	@csrf
	<h1>Creér un topic: </h1>
	<div>
	<div class="form-group }}">
		<label for="title" class="control-label sr-only">Title</label>
		<input type="text" name="title" id="title" placeholder="titre de post" value="{{ old('title') ? old('title') : $topic->title }}" class="form-control @error('title') is-invalid @enderror"><br>
		@error('title')
		<div class="invalid-feedback">{{$errors->first('title')}}</div>
		@enderror
	</div>
	<div class="form-group}}">
		<label for="content" class="control-label sr-only">content</label>
		<textarea name="content" id="content" rows="5" placeholder="votre post ici ..." class="form-control @error('content') is-invalid @enderror">{{old('content') ? old('content') : $topic->content}}</textarea>
	    @error('content')
		<div class="invalid-feedback">{{$errors->first('content')}}</div>
		@enderror
	</div>
	<br>
	<!--
	 <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
	     @if($errors->has('g-recaptcha-response'))
          <span class="help-block">
          <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
         </span>
         @endif
     -->
	<input type="submit" value="ajouter le topic" class="btn btn-success color-99CC5Bs btn-block ">
	
   
</div>
		</form>
	</div>
</div>

@endsection