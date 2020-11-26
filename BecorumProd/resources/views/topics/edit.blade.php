@extends('layouts.app')

@section('title','Edit Topic')

@section('content')
    <div class="container d-flex flex-column">
        <form action="{{ route('topics.update', $topic) }}" method="POST" class="">
           <div class="form-group"> 
        @csrf
        @method('PATCH')
        <input type="text" name="title" value="{{ $topic->title }}" class="form-control mt-2">
            <textarea name="content" id="content"  rows="5" value="" class="form-control mt-2">{{ $topic->content }}</textarea>
        <input type="submit" value="Envoyer" class="btn btn-outline-info mt-2">
    </form>
    </div>
        
    </div>
   {{-- @error('name', 'address' , 'zipCode' , 'town' , 'country' , 'description' ,'review') {{$message}} @enderror --}}
@endsection