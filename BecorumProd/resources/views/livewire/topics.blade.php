<div>
    
@extends('layouts.app')



 
@section('content')
    <div class="container">
        <div class="list-group">
            @foreach($topics as $topic)
                <div class="card">
                    <h4>{{ $topic->title }}</h4>
                </div>
            @endforeach
        </div>
    </div>

@endsection
</div>
