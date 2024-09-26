@extends('layouts.app')
@section('app-content')
    <div class="card">
        <h5 class="card-header">{{ isset($ticket) ? 'Edit Ticket' : 'Add Ticket' }}</h5>
        <form class="card-body" method="POST"
            action="{{ isset($ticket) ? route('tickets.update', $ticket->id) : route('tickets.store') }}">
            @csrf
            @if (isset($ticket))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input class="form-control form-control-sm" id="title" name="title" required
                    value="{{ old('title', isset($ticket) ? $ticket->title : '') }}">
                @error('title')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control form-control-sm" id="description" name="description" rows="8" required>{{ old('description', isset($ticket) ? $ticket->description : '') }}</textarea>
                @error('description')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-sm">{{ !isset($ticket) ? 'Add' : 'Update' }}</button>
        </form>
    </div>
@endsection
