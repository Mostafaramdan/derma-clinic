@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4 fw-bold text-primary">{{ __('Dashboard') }}</h1>
        <div class="bg-white shadow-sm rounded-3 p-4">
            {{ __("You're logged in!") }}
        </div>
    </div>
@endsection
