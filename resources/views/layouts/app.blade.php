<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'MovieTalks')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
 <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="{{ route('home') }}" class="logo">
                    <i class="fas fa-film"></i>
                    Movie<span>Talks</span>
                </a>

                <ul class="nav-links">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('movies') }}" class="{{ request()->routeIs('movies.*') ? 'active' : '' }}">Movies</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a></li>
                </ul>

                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search movies..." id="search-input" />
                </div>
              
          @auth
        <div class="user-dropdown">
        <button class="user-icon">
            <i class="fas fa-user"></i>
        </button>
        <div class="dropdown-content">
            <a href="{{ route('profile') }}">Profile</a>
            <a href="{{ route('mylist') }}">My Watchlist</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
@else
    <div class="auth-links">
        <a href="{{ route('user.login.form') }}">Login</a>
      
    </div>
@endauth
                 
                </div>    
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <!-- Company Info -->
                <div class="footer-column">
                    <div class="footer-logo">Movie<span>Talks</span></div>
                    <p class="footer-about">Your ultimate destination for movie reviews, recommendations, and entertainment news. Discover your next favorite film with us.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="{{ route('movies') }}"><i class="fas fa-chevron-right"></i> Movies</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> TV Shows</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> New Releases</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Top Rated</a></li>
                    </ul>
                </div>
              
                <div class="footer-column">
                    <h3>Categories</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Action</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Comedy</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Drama</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Sci-Fi</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Horror</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="footer-column">
                    <h3>Support</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> FAQ</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Help Center</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Privacy Policy</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('2025') }} Movie Talks. All Rights Reserved.</p>
                <p>Made with <i class="fas fa-heart" style="color: var(--accent);"></i> for movie lovers</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <script>
document.addEventListener('DOMContentLoaded', function () {
    // === User Dropdown Toggle ===
    const userIconBtn = document.querySelector('.user-icon');
    const dropdown = document.querySelector('.dropdown-content');

    if (userIconBtn && dropdown) {
        userIconBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('show');
        });

        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target) && !userIconBtn.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });
    }

    // === Mobile Menu Toggle ===
    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (mobileBtn && navLinks) {
        mobileBtn.addEventListener('click', function () {
            navLinks.classList.toggle('open');
        });

        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
            });
        });
    }
});
</script>

      