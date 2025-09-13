@extends('admin.adminlayout')

    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTalk Admin - Users</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admincss/reviews.css') }}">
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
                    <input type="text" placeholder="Search reviews...">
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

            <!-- Reviews Management Header -->
            <div class="reviews-management-header">
                <div class="dashboard-title">
                    <h1>Reviews Management</h1>
                    <p>Manage all user reviews in the MovieTalk database</p>
                </div>
                <button class="btn btn-primary" id="export-reviews">
                    <i class="fas fa-download"></i> Export Reviews
                </button>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <select class="filter-select" id="filter-movie">
                    <option>All Movies</option>
                    <option>Inception</option>
                    <option>The Dark Knight</option>
                    <option>The Godfather</option>
                    <option>Forrest Gump</option>
                </select>
                
                <select class="filter-select" id="filter-user">
                    <option>All Users</option>
                    <option>JohnDoe</option>
                    <option>MovieBuff42</option>
                    <option>CinemaLover</option>
                    <option>FilmCritic99</option>
                </select>
                
                <select class="filter-select" id="filter-rating">
                    <option>All Ratings</option>
                    <option>5 Stars</option>
                    <option>4 Stars</option>
                    <option>3 Stars</option>
                    <option>2 Stars</option>
                    <option>1 Star</option>
                </select>
                
                <select class="filter-select" id="filter-status">
                    <option>All Statuses</option>
                    <option>Published</option>
                    <option>Pending</option>
                    <option>Hidden</option>
                </select>
            </div>

            <!-- Reviews Table -->
            <table class="reviews-table">
                <thead>
                    <tr>
                        <th>Movie</th>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="font-weight: 600;">Inception</div>
                            <div style="font-size: 13px; color: #777;">Christopher Nolan</div>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar-small">JD</div>
                                <div>JohnDoe</div>
                            </div>
                        </td>
                        <td>
                            <span class="rating-badge">
                                <i class="fas fa-star"></i> 4.5
                            </span>
                        </td>
                        <td class="review-content">
                            <div class="review-text">
                                Mind-bending masterpiece! Nolan's direction is impeccable, and the visual effects are stunning.
                            </div>
                        </td>
                        <td>Jul 20, 2023</td>
                        <td><span class="status-badge status-published">Published</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-view btn-sm" data-review-id="1"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="font-weight: 600;">The Dark Knight</div>
                            <div style="font-size: 13px; color: #777;">Christopher Nolan</div>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar-small">MB</div>
                                <div>MovieBuff42</div>
                            </div>
                        </td>
                        <td>
                            <span class="rating-badge">
                                <i class="fas fa-star"></i> 5.0
                            </span>
                        </td>
                        <td class="review-content">
                            <div class="review-text">
                                Heath Ledger's Joker is the best villain performance I've ever seen. This movie sets the bar for superhero films.
                            </div>
                        </td>
                        <td>Aug 5, 2023</td>
                        <td><span class="status-badge status-published">Published</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-view btn-sm" data-review-id="2"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="font-weight: 600;">The Godfather</div>
                            <div style="font-size: 13px; color: #777;">Francis Ford Coppola</div>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar-small">CL</div>
                                <div>CinemaLover</div>
                            </div>
                        </td>
                        <td>
                            <span class="rating-badge">
                                <i class="fas fa-star"></i> 4.0
                            </span>
                        </td>
                        <td class="review-content">
                            <div class="review-text">
                                A classic that truly deserves its reputation. The performances are outstanding, especially Brando and Pacino.
                            </div>
                        </td>
                        <td>Jul 28, 2023</td>
                        <td><span class="status-badge status-published">Published</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-view btn-sm" data-review-id="3"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="font-weight: 600;">Forrest Gump</div>
                            <div style="font-size: 13px; color: #777;">Robert Zemeckis</div>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar-small">FC</div>
                                <div>FilmCritic99</div>
                            </div>
                        </td>
                        <td>
                            <span class="rating-badge">
                                <i class="fas fa-star"></i> 3.5
                            </span>
                        </td>
                        <td class="review-content">
                            <div class="review-text">
                                Tom Hanks delivers an incredible performance, but the film's historical revisionism bothers me.
                            </div>
                        </td>
                        <td>Aug 12, 2023</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-view btn-sm" data-review-id="4"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-approve btn-sm"><i class="fas fa-check"></i></button>
                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="font-weight: 600;">Inception</div>
                            <div style="font-size: 13px; color: #777;">Christopher Nolan</div>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar-small">AN</div>
                                <div>AnonymousUser</div>
                            </div>
                        </td>
                        <td>
                            <span class="rating-badge">
                                <i class="fas fa-star"></i> 2.0
                            </span>
                        </td>
                        <td class="review-content">
                            <div class="review-text">
                                Overrated and confusing. The plot is too complicated and the characters lack depth.
                            </div>
                        </td>
                        <td>Aug 15, 2023</td>
                        <td><span class="status-badge status-hidden">Hidden</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-view btn-sm" data-review-id="5"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
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

    <!-- Review Detail Modal -->
    <div class="modal" id="reviewDetailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Review Details</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="review-detail">
                    <div class="review-meta">
                        <img src="https://via.placeholder.com/60x80/5c6bc0/ffffff?text=IT" alt="Movie Poster">
                        <div>
                            <h3 id="modal-movie-title">Inception</h3>
                            <div id="modal-user-info">By JohnDoe</div>
                            <div id="modal-rating" class="rating-badge">
                                <i class="fas fa-star"></i> 4.5
                            </div>
                            <div id="modal-date">Posted on: Jul 20, 2023</div>
                            <div id="modal-status" class="status-badge status-published">Published</div>
                        </div>
                    </div>
                    <div class="review-full-text" id="modal-review-text">
                        Mind-bending masterpiece! Nolan's direction is impeccable, and the visual effects are stunning. 
                        The concept of dream within a dream was executed perfectly. The cast delivered outstanding performances, 
                        especially Leonardo DiCaprio. The score by Hans Zimmer elevated every scene. This is one of those films 
                        that gets better with each viewing as you discover new details.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-approve">Approve</button>
                <button class="btn btn-edit">Edit</button>
                <button class="btn btn-delete">Delete</button>
                <button class="btn btn-primary" id="modal-close">Close</button>
            </div>
        </div>
    </div>


        <script src="{{ asset('adminjs/reviews.js') }}"></script>
 
@endsection
