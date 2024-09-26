@extends('layouts.app')
@section('app-content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Tickets</h4>
            @if (Auth::user()->role !== 'ADMIN')
                <a class="btn btn-primary" href="{{ route('tickets.create') }}">Add New</a>
            @endif
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if ($data->isEmpty())
                <div class="alert alert-info" role="alert">
                    No tickets found. Please create a new ticket.
                </div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Subject</th>
                            @if (Auth::user()->role === 'ADMIN')
                                <th scope="col">User</th>
                            @endif
                            <th scope="col">Submitted at</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <th scope="row">{{ $start + $key }}</th>
                                <td>{{ $value->title }}</td>
                                @if (Auth::user()->role === 'ADMIN')
                                    <td>{{ $value->user->name }}</td>
                                @endif
                                <td>{{ $value->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    <span
                                        class="badge {{ $value->status === 'open' ? 'text-bg-success' : 'text-bg-danger' }} text-capitalize">
                                        {{ $value->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('tickets.show', $value->id) }}"
                                        class="btn btn-secondary btn-sm">View</a>
                                    @if (Auth::user()->role !== 'ADMIN')
                                        <a href="{{ $value->status !== 'closed' ? route('tickets.edit', $value->id) : '#' }}"
                                            class="btn btn-warning btn-sm {{ $value->status === 'closed' ? 'disabled' : '' }}">
                                            Edit
                                        </a>
                                    @endif
                                    <form action="{{ route('tickets.destroy', $value->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this ticket?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        @if ($data->hasPages())
            <div class="card-footer">
                {!! $data->links() !!}
            </div>
        @endif
    </div>
@endsection
