
@extends('layouts.app')
    
    @section('title','All Topics')

 
    @section('content')
    <div class="container">
        <div class="shadow-lg list-group d-flex mt-5">
            @foreach($topics as $topic)
                <div class="card d-block ">
                            <div class="card-body mt-2 mb-2">
                            <h4 class="card-title"><a class="font-weight-bold" href="{{ route('topics.show', $topic)}}">{{ $topic->title }}</a></h4>
                            <hr>
                                <p class="card-text mt-3 ml-3">{{$topic->content}}</p>
                               
                            </div> 
                            <div class="card-footer d-flex justify-content-between ">
                                    Posté le {{ $topic->created_at->format('d/m/Y à H:m')}}
                                <span class="badge badge-info">{{ $topic->user->name }}</span>   
                            </div>
                        @endforeach  
                </div>
                <div class="d-flex justify-content-center">
                    {!! $topics->links() !!}
                </div>
               
        </div>
    </div>
            @endsection
    