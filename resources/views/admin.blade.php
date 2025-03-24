@extends('layouts.layout')
@section('admin')
    <div class="scroll-container">
        <section class="section" style="background-color: #FD8C4F;">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: transparent;">
                    <div class="container-fluid d-flex flex-column align-items-center">
                        <a href="/" class="navbar-brand mb-4">
                            <img class="logo" src="{{ asset('img/logo.png') }}" alt="logo" style="width: 150px; height: auto;">
                        </a>
                
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav gap-5">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('index') ? 'text-black' : 'text-white' }}" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('about') ? 'text-black' : 'text-white' }}" href="about">About us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('book') ? 'text-black' : 'text-white' }}" href="book">Book a meeting</a>
                                </li>
                            </ul>
                
                            <ul class="navbar-nav ms-auto">
                                @auth
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Logout</button>
                                        </form>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Register / Login</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        </section>

        <div class="section bg-success">
            <div class="container">
                <div>
                    <h1>Admin booking view</h1>
                </div>

                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Booked date</th>
                                <th scope="col">Booked time</th>
                                <th scope="col">Email</th>
                                <th scope="col">Business link</th>
                                <th scope="col">Service</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Created</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <th>{{ $record->id }}</th>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->book }}</td>
                                    <td>{{ $record->time }}</td>
                                    <td>{{ $record->email }}</td>
                                    <td>{{ $record->url }}</td>
                                    <td>{{ $record->drop }}</td>
                                    <td>{{ $record->detail }}</td>
                                    <td>{{ $record->created_at }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($record->status == 'pending') bg-warning
                                            @elseif($record->status == 'accepted') bg-success
                                            @else bg-danger @endif">
                                            {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                    <iframe name="hidden_iframe" style="display: none;"></iframe>
                                    <td>
                                        @if($record->status == 'pending')
                                        <form action="{{ route('meetings.update', $record->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                        </form>
                                        <form action="{{ route('meetings.update', $record->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="declined">
                                            <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                        </form>
                                        
                                        @else
                                            <span class="text-muted">Action Taken</span>
                                        @endif
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection
