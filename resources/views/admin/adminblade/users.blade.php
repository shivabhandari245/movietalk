@extends('admin.adminlayout')

    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTalk Admin - Users</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admincss/users.css') }}">
</head>
@section(section: 'content')

<body>
    <div class="container">
        <!-- Main Content -->
        <div class="main">
            <!-- Header -->
            <div class="header">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search users...">
                </div>
                <div class="user-menu">
                    <div class="notification">
                        <i class="fas fa-bell"></i>
                        <div class="notification-badge">3</div>
                    </div>
                    <div class="user-profile">
                        <div class="user-avatar">AM</div>
                        <div>
                            <div>Admin Manager</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Management Header -->
            <div class="user-management-header">
                <div class="dashboard-title">
                    <h1>User Management</h1>
                    <p>Manage all MovieTalk users and their permissions</p>
                </div>
                <a href="addusers.html" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Add New User
                </a>
            </div>

            <!-- Users Table -->
            <table class="user-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $data)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div class="user-avatar-small">
                                        {{ strtoupper(substr($data->name, 0, 2)) }} <!-- Initials -->
                                    </div>
                                    <div>{{ $data->name }}</div>
                                </div>
                            </td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->role }}</td>
                            <td>
                                <span
                                    class="status-badge {{ $data->status == 'Active' ? 'status-active' : 'status-inactive' }}">
                                    {{ $data->status }}
                                </span>
                            </td>
                            <td>{{ $data->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-delete btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                <button class="pagination-btn"><i class="fas fa-chevron-left"></i></button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminjs/users.js') }}"></script>
 
@endsection
