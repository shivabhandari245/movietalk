@extends('layouts.app')  

@section('title', 'User Profile')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

@section('content')
<div class="profile-container container">
    <div class="profile-header">
        <h2>User Profile</h2>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success" style="margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- User Info -->
    <div class="profile-info">
        <div class="avatar">
            <img id="avatarPreview" src="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) }}" alt="User Avatar">
        </div>
        <div class="user-details">
            <h3>{{ auth()->user()->name }}</h3>
            <p>Email: {{ auth()->user()->email }}</p>
            <p>Joined: {{ auth()->user()->created_at->format('M Y') }}</p>
        </div>
    </div>

    <!-- Profile Update Form -->
    <div class="profile-update">
        <h3>Update Profile</h3>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
            </div>

            

            <button type="submit" class="btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Password Change Form -->
    <div class="password-change" style="margin-top: 40px;">
        <h3>Change Password</h3>
        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn-warning">Change Password</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewAvatar(event) {
        const preview = document.getElementById('avatarPreview');
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endpush
