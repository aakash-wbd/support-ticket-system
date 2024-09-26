@extends('layouts.app')
@section('app-content')
    <div class="card mb-4">
        <div class="card-header ">
            <div class="row align-items-center">
                <div class="col-lg-10 fs-5">
                    {{ $ticket->title }}
                </div>
                <div class="col-lg-2 text-end">
                    @if (Auth::user()->role === 'ADMIN')
                        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="closed">
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                                @if ($ticket->status === 'closed') disabled @endif>Mark as Closed</button>
                        </form>
                    @else
                        <span
                            class="badge {{ $ticket->status === 'open' ? 'text-bg-success' : 'text-bg-danger' }} text-capitalize">
                            {{ $ticket->status }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $ticket->description }}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">
            @if ($ticket->comments->isNotEmpty())
                <ul class="list-group list-group-flush">
                    @foreach ($ticket->comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ $comment->user->name }}</strong>
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                            <div>{{ $comment->message }}</div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No comments yet.</p>
            @endif
            <form action="{{ route('tickets.comments.store', $ticket->id) }}" method="POST" class="disabled">
                @csrf
                <div class="mb-3">
                    <label for="message" class="form-label">Leave comment</label>
                    <textarea class="form-control form-control-sm" id="message" name="message" rows="3" required
                        @if ($ticket->status === 'closed') disabled @endif></textarea>
                    @error('message')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-sm"
                    @if ($ticket->status === 'closed') disabled @endif>Post</button>
            </form>
        </div>
    </div>
@endsection
