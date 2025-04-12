@extends('layouts.layout')
@section('admin')
    <div>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: transparent;">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
        
                    <div class="d-flex flex-column align-items-center w-100">
                        <a href="/" class="navbar-brand mb-4">
                            <img class="logo" src="{{ asset('img/logo.png') }}" alt="logo" style="width: 150px; height: auto;">
                        </a>
        
                        <div class="collapse navbar-collapse justify-content-center w-100" id="navbarNav">
                            <ul class="navbar-nav gap-3 gap-lg-5 align-items-center"> 
                                <li class="nav-item">
                                    <a class="nav-link text-success" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-success" href="about">About us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-success" href="book">Book a meeting</a>
                                </li>
        
                                @auth
                                    @if(Auth::user()->is_admin)
                                        <li class="nav-item">
                                            <a class="nav-link text-success" 
                                               href="{{ route('admin') }}">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-success" 
                                               href="{{ route('admin.chat-logs') }}">Chat Logs</a>
                                        </li>
                                    @endif
                                @endauth
                                <li class="nav-item ms-lg-auto">
                                    @auth
                                        <div class="d-flex gap-3 align-items-center">
                                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                                            Register / Login
                                        </a>
                                    @endauth
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="min-vh-100 p-4">
            <div class="container-fluid">
                <h1 class="text-black mb-4">Booking Management</h1>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-nowrap">ID</th>
                                <th scope="col" class="text-nowrap">Name</th>
                                <th scope="col" class="text-nowrap">Date</th>
                                <th scope="col" class="text-nowrap">Time</th>
                                <th scope="col" class="text-nowrap">Email</th>
                                <th scope="col" class="text-nowrap">Business URL</th>
                                <th scope="col" class="text-nowrap">Service</th>
                                <th scope="col" class="text-nowrap">Notes</th>
                                <th scope="col" class="text-nowrap">Created At</th>
                                <th scope="col" class="text-nowrap">Status</th>
                                <th scope="col" class="text-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td class="fw-bold">{{ $record->id }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td class="text-nowrap">{{ $record->book }}</td>
                                    <td class="text-nowrap">{{ $record->time }}</td>
                                    <td><a href="mailto:{{ $record->email }}"
                                            class="text-decoration-none">{{ $record->email }}</a></td>
                                    <td>
                                        @if ($record->url)
                                            <a href="{{ $record->url }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i> Visit
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $record->drop }}</td>
                                    <td class="text-truncate" style="max-width: 200px;" title="{{ $record->detail }}">
                                        {{ $record->detail }}
                                    </td>
                                    <td class="text-nowrap">{{ $record->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill d-flex align-items-center 
                                        {{ $record->status == 'pending'
                                            ? 'bg-warning text-dark'
                                            : ($record->status == 'confirmed'
                                                ? 'bg-success'
                                                : 'bg-danger') }}">
                                            <i
                                                class="fas 
                                            {{ $record->status == 'pending'
                                                ? 'fa-clock'
                                                : ($record->status == 'confirmed'
                                                    ? 'fa-check-circle'
                                                    : 'fa-times-circle') }} me-2"></i>
                                            {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        @if ($record->status == 'pending')
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('meetings.update', $record->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check me-1"></i>Accept
                                                    </button>
                                                </form>
                                                <form action="{{ route('meetings.update', $record->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="declined">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-times me-1"></i>Decline
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted">Completed</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <style>
        .table {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(255, 255, 255, 0.05);
        }

        .table-dark {
            --bs-table-color: #fff;
            --bs-table-bg: #212529;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
@endsection
