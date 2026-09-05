@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h4>Welcome, {{ auth()->user()->name }} 👋</h4>
    <p class="text-muted">Here you will see all details.</p>
@endsection