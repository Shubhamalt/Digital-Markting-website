@extends('layouts.layout')
@section('forgotpassword')
    <div style="background-color: #BC67">
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="text-center">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <img src="/img/logo.png" alt="SticMarketing Logo" style="height: 10vh;">
                <h1 class="mb-3">Reset password</h1>
                <form action="{{ route('password.request') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Email" name="email" id="email" class="form-control"
                            required>
                        @if ($errors->has('email'))
                            <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>

                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-primary btn-block mt-3">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
