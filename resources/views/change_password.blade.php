@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('title', 'Change Password')

@section('content')
<div class="page d-flex">
    @include('partials.sidebar')
    <div class="content flex-1">
        @include('partials.header')
        <h1 class="content-title">Change Password</h1>
        <div class="section-content p-15 d-flex gap-20 column-mobile">
            <div class="account-settings bg-white p-15 rad-6">
                <h2 class="m-15-0">Update Your Password</h2>
                @if (session('status'))
                    <div class="alert alert-success custom-alert " style="margin: 15px; position: relative;">
                        <span class="close-alert" onclick="this.parentElement.style.display='none';">&times;</span>
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger custom-alert" style="margin: 15px; position: relative;">
                                    <span class="close-alert" onclick="this.parentElement.style.display='none';">&times;</span>
                                    {{ $error }}
                                </div>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('password.change') }}">
                    @csrf
                    <div class="setting-row mb-15">
                        <label for="current_password" class="fw-bold">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                    </div>
                    <div class="setting-row mb-15">
                        <label for="new_password" class="fw-bold">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                    </div>
                    <div class="setting-row mb-20">
                        <label for="new_password_confirmation" class="fw-bold">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="bg-blue pointer btn-primary w-100">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 