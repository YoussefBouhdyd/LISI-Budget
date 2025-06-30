@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('title', 'Settings')

@section('content')
<div class="page d-flex">
    <!-- Start Side Bar  -->
    @include('partials.sidebar')
    <!-- End Side Bar  -->
    <div class="content flex-1">
        <!-- Start Page header  -->
        @include('partials.header')
        <!-- End Page header  -->
        <h1 class="content-title">Settings</h1>
        <!-- Start Settings Content -->
        <div class="section-content p-15 d-flex gap-20 column-mobile">
            <!-- Profile Overview Section -->
            <div class="profile-overview bg-white p-15 rad-6">
                <h2 class="m-15-0">Information General</h2>
                <div class="d-flex align-c">
                    <!-- Left: Profile Image and Name -->
                    <div class="profile-left text-center">
                        <img src="{{ asset('imgs/user-profile.svg') }}" alt="Profile Image" class="profile-img mb-10">
                        <div class="profile-fullname fw-bold fs-20 mt-10">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    <!-- Right: General Info -->
                    <div class="profile-info flex-1 ms-40">
                        <div class="info-row mb-10">
                            <span class="info-label fw-bold">Username:</span>
                            <span class="info-value ms-10">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="info-row mb-10">
                            <span class="info-label fw-bold">Email:</span>
                            <span class="info-value ms-10">{{ auth()->user()->email }}</span>
                        </div>
                        <div class="info-row mb-10">
                            <span class="info-label fw-bold">Créé(e) le:</span>
                            <span class="info-value ms-10">{{ auth()->user()->created_at }}</span>
                        </div>
                        <div class="info-row mb-10">
                            <span class="info-label fw-bold">Rôle:</span>
                            <span class="info-value ms-10"> {{ auth()->user()->role }} </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Settings Section -->
            <div class="account-settings bg-white p-15 rad-6">
                <h2 class="m-15-0">Authentification</h2>
                <form>
                    <!-- Password Row -->
                    <div class="setting-row d-flex align-c gap-10">
                        <label class="setting-label fw-bold flex-1" for="password">Password</label>
                        <input type="password" id="password" class="form-control flex-3 me-20" value="********" disabled>
                        <button type="button" class="bg-blue pointer btn-primary flex-1" onclick="window.location.href='{{ route('password.change.form') }}'">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Settings Content  -->
    </div>
</div>
@endsection