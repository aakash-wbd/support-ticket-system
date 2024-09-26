@extends('layouts.master')
@section('content')
    <section>
        <nav class="navbar navbar-light navbar-expand-lg bg-body-tertiary sticky-top">
            <div class="container">
                <a class="navbar-brand mr-auto" href="#">Logo</a>
                <ul class="navbar-nav ml-auto">
                    @auth
                        <a class="btn btn-outline-secondary" href="{{ route('logout') }}">Log out</a>
                    @endauth
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="py-3">
                @auth
                    <h2 class="mb-4">Welcome, {{ Auth::user()->name }}!</h2>
                @endauth
                @yield('app-content')
            </div>
        </div>
    </section>
@endsection
