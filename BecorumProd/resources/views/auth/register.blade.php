@extends('layouts.app')

@section('content')

    <div class="container-fluid d-flex flex-column align-items-center bg-light mt-5 w-50 rounded">  
        <form method="POST" action="{{ route('register') }}" class="form-group mt-3">
            @csrf
            {{-- NAME OF USER --}}
            <div>
                <label for="name" value="{{ __('Name') }}">
                <input id="name" class="form-control" type="text" name="name" placeholder="Enter your name" required autofocus autocomplete="name" />
                </label>
            </div>
            {{-- EMAIL OF USER & LOGIN  --}}
            <div>
                <label for="email" value="{{ __('Email') }}">
                <input id="email" class="form-control" type="text" name="email" placeholder="Enter your E-mail" required autofocus autocomplete="email" />
                </label>
            </div>
            {{-- Password first --}}
            <div>
                <label for="password" value="{{ __('Password') }}">
                <input id="password" class="form-control" type="password" name="password" placeholder="Enter your password" required autofocus autocomplete="off" />
                </label>
            </div>
            {{-- Second for check with the first --}}
            <div>
                <label for="password_confirmation" value="{{ __('Confirm Password') }}">
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Enter your password again" required autofocus autocomplete="off" />
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </div>
            <button type="sutbmit" class="btn btn-outline-info align-self-center mt-3">Register</button>
        </form>    
    



@endsection