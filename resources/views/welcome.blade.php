@extends('layouts.app')

@section('title', 'Passport Change Management')
@section('body-class', 'welcome-page')
@section('main-class', 'p-0')

@push('styles')
    <style>
        .welcome-hero {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('{{ asset('images/bg.jpg') }}') no-repeat center center/cover;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            color: #212529;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            max-width: 540px;
        }

        .welcome-card img {
            height: 90px;
            margin-bottom: 15px;
        }

        .welcome-card h1 {
            font-weight: bold;
            color: #1c6b13;
        }

        .welcome-card p {
            font-size: 14pt;
            margin-bottom: 25px;
        }

        .btn-custom {
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 14pt;
        }
    </style>
@endpush

@section('content')
<div class="welcome-hero">
    <div class="welcome-card">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h1>Welcome to Passport Change Management</h1>
        <p class="lead mb-4">
            High Commission of the People’s Republic of Bangladesh <br>
            Brunei Darussalam
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('passport.create') }}" class="btn btn-success btn-custom shadow">➕ Add New Record</a>
            <a href="{{ route('passport.index') }}" class="btn btn-primary btn-custom shadow">📂 View Records</a>
        </div>
    </div>
</div>
@endsection
