@extends('layouts.layout')

@section('chatlog')
<div class="container">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container-fluid flex-column">
                <!-- Logo and Toggler Row -->
                <div class="d-flex w-100 justify-content-center align-items-center">
                    <a href="/" class="navbar-brand">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid" style="width: 150px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
    
                <div class="collapse navbar-collapse w-100" id="navbarNav">
                    <ul class="navbar-nav w-100 justify-content-center align-items-lg-center gap-3 gap-lg-5">
                        <li class="nav-item">
                            <a class="nav-link text-black" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="about">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="book">Book a meeting</a>
                        </li>
    
                        @auth
                            @if(Auth::user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link text-black" href="{{ route('admin') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" href="{{ route('admin.chat-logs') }}">Chat Logs</a>
                                </li>
                            @endif
                        @endauth
                        
                        <li class="nav-item ms-lg-auto">
                            @auth
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Register / Login</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <h1>Chat Logs</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Message</th>
                <th>Response</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->user->name }}</td>
                <td>{{ $log->message }}</td>
                <td>{{ $log->response }}</td>
                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
</div>
@endsection