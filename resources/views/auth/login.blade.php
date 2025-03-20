@extends('layouts.layout')
@section('login')
<div style="background-color: #BC67">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center">
            @if (session()->has("success"))
                <div class="alert alert-success">
                    {{session()->get("success")}}
                </div>
            @endif
            @if (session()->has("error"))
                <div class="alert alert-error">
                    {{session()->get("error")}}
                </div>
            @endif
            <img src="/img/logo.png" alt="SticMarketing Logo" style="height: 10vh;">
            <h1 class="mb-3">Login</h1>
            <form action="{{route("login.post")}}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" placeholder="Email" name="email" id="email" class="form-control" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            {{$errors->first('email')}} 
                        </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">
                            {{$errors-first('password')}}
                        </span>
                    @endif
                </div>
                <div class="mb-4">
                    <a href="{{route('password.request')}}">Forgot password?</a>
                    <a href="{{route('register')}}">Make account</a>
                </div>
                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection