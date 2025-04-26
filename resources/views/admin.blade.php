@extends('layouts.layout')
@section('admin')
<div class="d-flex flex-column min-vh-100">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 40px;">
                    </a>
                    
                    <div class="d-flex align-items-center gap-2">
                        @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                        @endauth
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>

                <div class="collapse navbar-collapse mt-2" id="mainNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="book">Book Meeting</a>
                        </li>
                        @auth
                        @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.chat-logs') }}">Chat Logs</a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1 p-3">
        <div class="container-fluid">
            <h1 class="h4 mb-3">Booking Management</h1>

            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark d-none d-sm-table-header-group">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">Date</th>
                            <th class="d-none d-lg-table-cell">Time</th>
                            <th class="d-none d-xl-table-cell">Email</th>
                            <th>URL</th>
                            <th>Service</th>
                            <th class="d-none d-sm-table-cell">Notes</th>
                            <th class="d-none d-md-table-cell">Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                        <tr>
                            <td data-label="ID">{{ $record->id }}</td>
                            <td data-label="Name">{{ $record->name }}</td>
                            
                            <td data-label="Date" class="d-none d-md-table-cell">{{ $record->book }}</td>
                            <td data-label="Time" class="d-none d-lg-table-cell">{{ $record->time }}</td>
                            <td data-label="Email" class="d-none d-xl-table-cell">
                                <a href="mailto:{{ $record->email }}" class="text-decoration-none">{{ $record->email }}</a>
                            </td>
                            
                            <td data-label="URL">
                                @if($record->url)
                                <a href="{{ $record->url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            
                            <td data-label="Service">{{ $record->drop }}</td>
                            
                            <td data-label="Notes" class="d-none d-sm-table-cell text-truncate" style="max-width: 150px;">
                                {{ $record->detail }}
                            </td>
                            
                            <td data-label="Created" class="d-none d-md-table-cell">
                                {{ $record->created_at->format('M d, Y') }}
                            </td>
                            
                            <td data-label="Status">
                                <span class="badge rounded-pill d-flex align-items-center {{ 
                                    $record->status == 'pending' ? 'bg-warning' : 
                                    ($record->status == 'confirmed' ? 'bg-success' : 'bg-danger') 
                                }}">
                                    <i class="fas {{ 
                                        $record->status == 'pending' ? 'fa-clock' : 
                                        ($record->status == 'confirmed' ? 'fa-check' : 'fa-times') 
                                    }} me-1"></i>
                                    <span class="d-none d-sm-inline">{{ ucfirst($record->status) }}</span>
                                </span>
                            </td>
                            
                            <td data-label="Actions">
                                @if($record->status == 'pending')
                                <div class="d-flex flex-sm-row gap-1">
                                    <form method="POST" action="{{ route('meetings.update', $record->id) }}" class="flex-fill">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            <i class="fas fa-check"></i>
                                            <span class="d-none d-sm-inline">Accept</span>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('meetings.update', $record->id) }}" class="flex-fill">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="declined">
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fas fa-times"></i>
                                            <span class="d-none d-sm-inline">Decline</span>
                                        </button>
                                    </form>
                                </div>
                                @else
                                <span class="text-muted small">Completed</span>
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
@media (max-width: 575.98px) {
    .table-responsive {
        border: 0;
    }
    
    .table tr {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        border-bottom: 2px solid #dee2e6;
        padding: 0.75rem 0;
    }

    .table td {
        padding-left: 50%;
        position: relative;
        border: none;
    }

    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 45%;
        padding-left: 0.5rem;
        font-weight: 600;
    }
}
</style>
@endsection