@extends('layouts.app')  <!-- Assuming you have a base layout like this -->

@section('title', 'User Profile')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h2>User Profile</h2>
    </div>

    <!-- User Profile Info -->
    <div class="profile-info">
        <div class="avatar">
            <img src="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) }}" alt="User Avatar">
        </div>
        <div class="user-details">
            <h3>{{ auth()->user()->name }}</h3>
            <p>Email: {{ auth()->user()->email }}</p>
            <p>Joined: {{ auth()->user()->created_at->format('M Y') }}</p>
        </div>
    </div>

    <!-- Update Profile Form -->
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

            <div class="form-group">
                <label for="avatar">Change Avatar (optional)</label>
                <input type="file" name="avatar" id="avatar" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Change Password Section -->
    <div class="password-change">
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
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="confirm_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-warning">Change Password</button>
        </form>
    </div>

    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection
