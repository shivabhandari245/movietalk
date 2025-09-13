@extends('admin.adminlayout')

    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTalk Admin - Users</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admincss/addmovies.css') }}">
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
                    <input type="text" placeholder="Search...">
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

            <!-- Page Title -->
            <div class="dashboard-title">
                <h1>Add New Movie</h1>
                <p>Add a new movie to the MovieTalk database</p>
            </div>

            <!-- Add Movie Form -->
            <div class="form-container">
                <h2 class="form-title">Movie Information</h2>
                
                <form id="add-movie-form" enctype="multipart/form-data" action="/admin/addmovies" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="movieTitle" class="form-label">Movie Title</label>
                        <input type="text"  name="title" id="movieTitle"  class="form-input" placeholder="Enter movie title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="movieDescription" class="form-label">Description</label>
                        <textarea  name="description" id="movieDescription"  class="form-textarea" placeholder="Enter movie description" required></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="releaseDate" class="form-label">Release Date</label>
                            <input type="date"  name="release_date" id="releaseDate" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="runtime" class="form-label">Runtime (minutes)</label>
                            <input type="number" name="runtime" id="runtime" class="form-input" placeholder="Enter runtime" min="1" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="director" class="form-label">Director</label>
                            <input type="text" name="director" id="director" class="form-input" placeholder="Enter director's name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="rating" class="form-label">Content Rating</label>
                            <select name="content_rating" id="rating" class="form-select" required>
                                <option value="">Select rating</option>
                                <option value="G">G</option>
                                <option value="PG">PG</option>
                                <option value="PG-13">PG-13</option>
                                <option value="R">R</option>
                                <option value="NC-17">NC-17</option>
                            </select>
                        </div>
                    </div>

                       <div class="form-row">
                        <div class="form-group">
                            <label for="writer" class="form-label">Writer</label>
                            <input type="text" name="writer" id="Writer" class="form-input" placeholder="Enter writer's name" required>
                        </div>

                            <div class="form-group">
                            <label for="production" class="form-label">Production</label>
                            <input type="text" name="production" id="production" class="form-input" placeholder="Enter production's name" required>
                        </div>

                        </div>
                    
                    <div class="form-group">
                        <label class="form-label">Genres</label>
                        <div class="checkbox-group">
                           <input type="checkbox" name="genres[]" value="Action"> Action
                            <input type="checkbox" name="genres[]" value="Drama"> Drama
                            <input type="checkbox" name="genres[]" value="Comedy"> Comedy
                            <input type="checkbox" name="genres[]" value="Thriller"> Thriller
                            <input type="checkbox" name="genres[]" value="Romance"> Romance
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="cast" class="form-label">Cast (comma separated)</label>
                        <input type="text" name="cast" id="cast" class="form-input" placeholder="e.g., Actor One, Actor Two, Actor Three" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Movie Poster</label>
                        <div class="file-upload"  id="posterUpload">
                            <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                            <div class="file-upload-text">Drag & drop your image here or <span>browse</span></div>
                            <input type="file"  name="poster" class="file-upload-input" id="posterInput" accept="image/*">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="trailer" class="form-label">Trailer URL (YouTube)</label>
                        <input type="url" name="trailer" id="trailer" class="form-input" placeholder="https://www.youtube.com/watch?v=..." required>
                    </div>
                    
                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Movie</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   




    {{-- <script src="{{ asset(path: 'adminjs/addmovies.js') }}"></script> --}}
 
@endsection
