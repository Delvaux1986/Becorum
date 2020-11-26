@extends('layouts.app')

@section('extra-js')
    {!! NoCaptcha::renderJs() !!}
@endsection
    
    @section('title','Add a new Topic')
    
    @section('content')
    <div class="container">
        <h1 class="text-white">Créer un topic</h1>
        <hr>    
            
            <form action="{{route('topics.store')}}" method="POST" class="d-flex justify-content-center flex-column" id="newTopic">
                <div class="form-group">
                @csrf
                    <input type="text" name="title" id="title" placeholder="Enter your Topic name" autocomplete="off" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                    @enderror
                </div>    
                <div class="form-group">
                    <textarea name="content" id="content" cols="30" rows="5" autocomplete="off" class="form-control @error('content') is-invalid @enderror"></textarea> 
                    @error('content')
                        <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                    @enderror
                </div>
                
                    {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                    @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                    @endif
                
                    <button type="submit" class="btn btn-primary">Créer mon topic</button>
                </form>
           
           
    </div>
    @endsection