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
	<input type="submit" value="{{$submitButton}}" class="btn btn-success color-99CC5Bs btn-block ">
	