@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex flex-column align-items-center bg-light mt-5 w-50 rounded">
        <div class="mb-4 text-sm text-gray-600 mt-5">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="form-group">
            @csrf
            <label for="email" value="{{ __('Email') }}">
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your E-mail"required autofocus>
            </label>
    </div>
        <button type="sutbmit" class="btn btn-outline-info align-self-center mt-3">{{ __('Email Password Reset Link') }}</button>
    </form>
@endsection