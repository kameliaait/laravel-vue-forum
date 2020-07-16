@extends('layouts.app')
@section('extra-js')
<script >
    function toggleReplyComment(id){
        let element = document.getElementById('replyComment-'+id);
        element.classList.toggle('d-none');
    }
</script>
@endsection
@section('content')
<div class="container">
	<div class="card">
		<div class="card-body"> 
<h1 class="card-title">{{$topic->title}}</h1>
<p>{{$topic->content}}</p>

            <div class="d-flex justify-content-between align-items-center">
				<small>Posté le: {{$topic->created_at->format('d/m/Y à H:m')}}</small>
				<span class="badge badge-primary font-italic">
					{{$topic->user->name}}
				</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
             @can('update',$topic)
    
             <a class="btn btn-success color-99CC5B" href="{{route('topic.edit',$topic)}}">modifier</a>
             @endcan 
             @can('delete',$topic)
            <form action="{{route('topic.destroy',$topic)}}" method="POST" >
                @csrf
         	    @method('DELETE')
         	    
           <button class="btn btn-danger">Suprimer</button>
           </form>
           @endcan
        </div>
    </div>
    </div>
    <hr>
    <h5>Commentaire</h5> 

    <form action="{{route('comments.store',$topic)}}" method="POST" class="mt-3 mb-3">
        @csrf
        <label for="content">votre commentaire</label>
        <textarea name="content" id="content" class="form-control @error('content')is-invalid @enderror" rows="4"></textarea>
        @error('content')
        <div class="invalid-feedback">{{$errors->first('content')}}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-1">Soumetre mon commentaire</button>
    </form>
    @forelse($topic->comments as $comment)
    <div class="card mb-2">
        <div class="card-body d-flex justify-content-between">
            <div>
            {{$comment->content}}
            <div class="d-flex justify-content-between align-items-center">
                <small>Posté le: {{$comment->created_at->format('d/m/Y')}}</small>
                <span class="badge badge-primary font-italic">
                    {{$comment->user->name}}
                </span>
            </div>
            
        </div>
        
        @if(!$topic->solution && auth()->user()->id == $topic->user_id)
        <solution-button topic-id='{{$topic->id}}' comment-id='{{$comment->id}}'></solution-button>
        @else
        @if($topic->solution == $comment->id)
        <h4><span class="badge badge-success">Marqué comme solution</span></h4>
        @endif
        @endif

       </div>     
    </div>
     @foreach($comment->comments as $replyComment)
    <div class="card mb-2 ml-5 ">
        <div class="card-body">
            {{$replyComment->content}}
            <div class="d-flex justify-content-between align-items-center">
                <small>Posté le: {{$replyComment->created_at->format('d/m/Y')}}</small>
                <span class="badge badge-primary font-italic">
                    {{$replyComment->user->name}}
                </span>
            </div>
            
        </div>
            
    </div>

    @endforeach
    @auth
    <button class="btn btn-info mb-1" onclick="toggleReplyComment({{ $comment->id }})">Repondre</button>
    <form action="{{route('comments.storeReply', $comment)}}" method="POST" class="mt-1 ml-5 d-none" id="replyComment-{{$comment->id}}">
        @csrf
        <div class="form-group" >
             <textarea name="replyComment" id="replyComment" class="form-control @error('replyComment') is-invalid @enderror" rows="4"></textarea>
        @error('replyComment')
        <div class="invalid-feedback">{{$errors->first('replyComment')}}</div>
        @enderror

        </div>
        <button type="submit" class="btn btn-primary">Repondre a ce commentaire</button>
    </form>
      @endauth   
    @empty
    <div class="alert alert-info"> Soyez le premier a commenter </div>
    @endforelse

</div>

@endsection