
@extends('layouts.app')
    
@section('title',' Topic')
@section('extra-js')
    
    {{-- SCRIPT FOR TOGGLE REPLYCOMMENT FROM ID OF COMMENT --}}
    <script>
        let toggleReplyComment = (id) => {
            let element = document.getElementById('replyComment-' + id);
            element.classList.toggle('d-none');
        }
    </script>
@endsection

@section('content')
{{-- SHOW THE TOPIC SELECTED --}}
<div class="container d-flex justify-content-center ">
    <div class="row">
        <div class="shadow-lg card text-center m-5 col-md-10 offset-md-3">
            <div class="card-header pt-4">
                <h4 class="card-title ">{{ $topic->title }}</h4>
            </div>
            <div class="card-body pr-0 pl-0 pb-0">
                <p class="card-text">{{$topic->content}}</p>
                <div class="d-flex justify-content-around ">
                    <div class="p-4  ">
                        @can('update', $topic)
                        <a href="{{ route('topics.edit' , $topic)}}" class="btn btn-outline-secondary font-weight-bolder">Editer le Topic</a>
                        @endcan
                    </div>
                    <div class="p-4">
                        @can('delete', $topic)
                        <form action="{{ route('topics.destroy' , $topic->id)}}" method="POST">
                         @csrf
                            @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger font-weight-bolder">Supprimer le Topic</button>
                     </form>
                     @endcan
                    </div>
                </div>
            <div class=" card-footer d-flex justify-content-between">
            
                Posté le {{ $topic->created_at->format('d/m/Y à H:m')}} <h5><span class="badge badge-info">{{ $topic->user->name }}</span>  </h5>  
            </div>
        </div>
    </div>
    <hr>

    {{-- COMMENT SECTION  --}}
    <div class="container col-md-10 offset-md-1">
        <h5 class="text-light mb-4">Commentaires</h5>
        <div class="comment">
            @forelse ($topic->comments as $comment)
                <div class="shadow-lg card mb-2">
                    <div class="card-body">
                        <p class="font-weight-bold">{{ $comment->content }}</p>
                        <div class="card-footer d-flex justify-content-between ">
                            Posté le {{ $comment->created_at->format('d/m/Y à H:m')}}
                            <span class="badge badge-info">{{ $comment->user->name }}</span>   
                        </div>
                    </div>
                </div>
                {{-- SHOW REPLY OF THIS COMMENT  --}}
                @foreach ($comment->comments as $reply)
                <div class="card mb-2 ml-5">
                    <div class="card-body">
                        <small>{{ $reply->content }}</small>
                        <div class="card-footer d-flex justify-content-between ">
                            Posté le {{ $reply->created_at->format('d/m/Y à H:m')}}
                            <span class="badge badge-info">{{ $comment->user->name }}</span>   
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- FORM REPLY ON COMMENTS  ONLT AUTH --}}
                @auth
                     <button id="commentReplyId" class="btn btn-outline-info mt-2 mb-2" onclick="toggleReplyComment({{ $comment->id}})">
                        Répondre</button>
                    <form action="{{route('comment.storeReply' , $comment)}}" method="POST" class="ml-5 d-none" id="replyComment-{{$comment->id}}">
                        @csrf
                        <div class="form-group">
                            <label for="replyComment" class="text-light">Ma réponse</label>
                            <textarea name="replyComment" id="replyComment"  rows="1" class="form-control @error('replyComment') is-invalid @enderror">

                            </textarea>
                            {{-- DISPLAY  ERROR --}}
                            @error('replyComment')
                                <div class="invalid-feedback">{{ $errors->first('replyComment') }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-outline-info mt-2 mb-2">Répondre</button>
                        
                    </form>
                @endauth
               
            @empty
                <div class="alert alert-info">Aucune commentaire pour ce topic</div>
            @endforelse
        </div>
        {{-- FORM FOR COMMENTS --}}
        <form action="{{ route('comments.store' , $topic)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content" id="content" class="text-light">Votre commentaire</label>
                <textarea name="content" id="content"  rows="3" class="form-control @error('content') is-invalid @enderror"></textarea>
                {{-- DISPLAY  ERROR --}}
                @error('content')
                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">envoi</button>
        </form>
    </div>
    

</div>

        @endsection