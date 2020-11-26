@extends('layouts.app')

@section('content')


@if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
@endif
<div class="container-fluid d-flex flex-column align-items-center bg-light mt-5 w-50 rounded">
    <form method="POST" action="{{ route('login') }}" class="form-group mt-3">
        @csrf
        {{-- Email input  --}}
        <div class="mt-1">
            <label for="email" value="{{ __('Email') }}" >
                <input type="email"  name="email" required  autocomplete="off" id="email" placeholder="Enter your email" class="form-control">
            </label>
        </div>
        {{-- password input --}}
        <div>
            <label for="password" value="{{ __('Password') }}" >
                <input type="password" class="form-control" name="password" required  autocomplete="off" id="password" placeholder="Password">
            </label>
        </div>
        {{-- REMEMBER ME  --}}
        <div>
            <label for="remember_me" class="">
                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember" class="form-control">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
        {{-- FORGOT PASSWORD  --}}
        <div>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}" class="form-control mb-2">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
                
        </div>
    </div>
        <button type="submit" class="btn btn-outline-info align-self-center mt-3">{{ __('Login') }}</button>
    </form>
@endsection
