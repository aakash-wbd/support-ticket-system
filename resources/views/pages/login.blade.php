@extends('layouts.master')

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-4 d-flex justify-content-center align-items-center vh-100">
                <div class="card w-100">
                    <h4 class="card-header text-center">Login</h4>
                    <form class="card-body" method="POST" action="{{ route('login.store') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" placeholder="Email" name="email" class="form-control form-control-sm"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" id="password" placeholder="Password" name="password"
                                    class="form-control form-control-sm" required autocomplete="on">
                                <button class="btn btn-outline-secondary btn-sm" type="button"
                                    id="toggleButton">Show</button>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @error('credentials')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary btn-sm w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggleButton');
            const passwordField = document.getElementById('password');

            toggleBtn.addEventListener('click', () => {
                const isHidden = passwordField.type === 'password';
                passwordField.type = isHidden ? 'text' : 'password';
                toggleBtn.textContent = isHidden ? 'Hide' : 'Show';
            });
        });
    </script>
@endpush
