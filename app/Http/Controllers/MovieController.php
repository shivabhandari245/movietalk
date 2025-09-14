<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use App\Models\Review;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the movies with filters.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Movie::with('category');

        // Filter by category
        if ($request->has('category') && $request->category != 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by year
        if ($request->has('year') && $request->year != 'all') {
            $query->where('release_year', $request->year);
        }

        // Filter by rating
        if ($request->has('rating') && $request->rating != 'all') {
            $query->where('rating', '>=', $request->rating);
        }

        // Sort results
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('release_year', 'desc');
                    break;
                case 'title':
                    $query->orderBy('title', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $movies = $query->paginate(12);
        $categories = Category::all();
        $years = Movie::select('release_year')->distinct()->orderBy('release_year', 'desc')->get();

        return view('user.movie', compact('movies', 'categories', 'years'));
    }

    /**
     * Show the movie details page.
     *
     * @param int $movieId
     * @return \Illuminate\View\View
     */
    public function show($movieId)
    {
        // Get the movie details
        $movie = Movie::with('category')->findOrFail($movieId);

        // Get user reviews for the movie
        $reviews = $movie->reviews()->with('user')->latest()->get();

        // Get similar movies based on the same category
        $similarMovies = Movie::where('category_id', $movie->category_id)
            ->where('id', '!=', $movieId)
            ->orderBy('rating', 'desc')
            ->take(4)
            ->get();

        // Check if the movie is in the user's watchlist
        $inWatchlist = false;
        if (Auth::check()) {
            $inWatchlist = Watchlist::where('user_id', Auth::id())
                ->where('movie_id', $movieId)
                ->exists();
        }

        return view('user.moviedetail', compact('movie', 'similarMovies', 'reviews', 'inWatchlist'));
    }
public function search(Request $request)
    {
        // Get search term from the request
        $searchTerm = $request->input('query');

        // Perform the search query on the movies table
        $movies = Movie::where('title', 'like', '%' . $searchTerm . '%')
                       ->orWhere('description', 'like', '%' . $searchTerm . '%')
                       ->get();

        // Return a view with the search results
        return view('user.search', compact('movies'));
    }
    /**
     * Add or remove a movie from the user's watchlist.
     *
     * @param int $movieId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleWatchlist($movieId)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $user = Auth::user();
        $watchlist = Watchlist::where('user_id', $user->id)
            ->where('movie_id', $movieId)
            ->first();

        if ($watchlist) {
            // Remove from watchlist
            $watchlist->delete();
        } else {
            // Add to watchlist
            Watchlist::create([
                'user_id' => $user->id,
                'movie_id' => $movieId,
            ]);
        }

        return back();
    }

    /**
     * Submit a review for a movie.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $movieId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitReview(Request $request, $movieId)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        // Create a new review for the movie
        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $movieId,
            'title' => $request->title,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }

    /**
     * Submit or update the rating for a movie.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $movieId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitRating(Request $request, $movieId)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        // Update or create the user's rating for the movie
        $userRating = Review::where('user_id', Auth::id())
            ->where('movie_id', $movieId)
            ->first();

        if ($userRating) {
            $userRating->update(['rating' => $request->rating]);
        } else {
            Review::create([
                'user_id' => Auth::id(),
                'movie_id' => $movieId,
                'rating' => $request->rating,
                'title' => 'User Rating',
                'content' => '',
            ]);
        }

        // Update movie rating based on the average of all reviews
        $averageRating = Review::where('movie_id', $movieId)->avg('rating');
        $movie = Movie::findOrFail($movieId);
        $movie->rating = $averageRating;
        $movie->save();

        return back()->with('success', 'Rating submitted successfully.');
    }



    //this is backend movies view
public function moviesdata()
{
    $movies = Movie::orderBy('id', 'desc')->get();

    foreach ($movies as $movie) {
        // Convert "3,4,5" into [3,4,5]
        $ids = explode(',', $movie->categories_id);

        // Fetch category names from DB
        $names = \App\Models\Category::whereIn('id', $ids)->pluck('name')->toArray();

        // Add as extra property
        $movie->category_names = $names;
    }

    return view('admin.adminblade.movies', compact('movies'));
}


//this is backend addmovies 
public function insertmovies(Request $request)
{
     $movie = new Movie;

    $movie->title = $request->title;
    $movie->description = $request->description;
    $movie->release_date = $request->release_date;
    $movie->runtime = $request->runtime;


    $movie->director = $request->director;
    $movie->content_rating = $request->content_rating;
    $movie->writer = $request->writer;
    $movie->production = $request->production;
$movie->genres = implode(',', $request->genres);
    $movie->cast = $request->cast;
    $movie->poster = $request->poster; // if image upload, handle file upload
    $movie->trailer_url = $request->trailer;

    $movie->save();
    

    return redirect('/admin/movies')->with('success', 'Movie added successfully!');
}

public function addshow(){
    $generes = Category::get();
    
    return view('admin.adminblade.addmovies',compact('generes'));
}
   



//form update show movie
    public function edit($id)
    {
        $generes = Category::get();
        $movie = Movie::findOrFail($id);
        $selectedGenres = explode(',', $movie->categories_id);

        return view('admin.adminblade.updatemovies', compact('movie','generes', 'selectedGenres'));
    }

//update movie
public function update(Request $request, $id)
{
    // Validate input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'release_date' => 'required|date',
        'runtime' => 'required|integer|min:1',
        'director' => 'required|string|max:255',
        'writer' => 'required|string|max:255',
        'production' => 'required|string|max:255',
        'content_rating' => 'required|string',
        'cast' => 'required|string',
        'release_year' => 'required|string',
        'genres' => 'nullable|array',
        'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'trailer_url' => 'required|url', // 👈 match your DB column
    ]);

    // Find movie
    $movie = Movie::findOrFail($id);

    // Handle poster upload
    if ($request->hasFile('poster')) {
        if ($movie->poster && \Storage::exists('public/' . $movie->poster)) {
            \Storage::delete('public/' . $movie->poster);
        }

        $posterPath = $request->file('poster')->store('movies', 'public');
        $movie->poster = $posterPath;
    }

    // Update fields
    $movie->title          = $request->title;
    $movie->description    = $request->description;
    $movie->release_date   = $request->release_date;
    $movie->runtime        = $request->runtime;
    $movie->director       = $request->director;
    $movie->writer         = $request->writer;
    $movie->production     = $request->production;
    $movie->content_rating = $request->content_rating;
    $movie->cast           = $request->cast;
    $movie->release_year   = $request->release_year;
    $movie->genres         = $request->genres ? implode(',', $request->genres) : null;
    $movie->trailer_url    = $request->trailer_url; // 👈 FIXED

    $movie->save();

    return redirect()->route('admin.movies.list') // 👈 redirect to list
                     ->with('success', 'Movie updated successfully!');
}

// delete movies
public function destroy($id)
{
    $movie = Movie::findOrFail($id);
    $movie->delete();
    return redirect('admin/movies')->with('success', 'Movie deleted successfully');

}

//show review of particular movie

    // Show reviews for a specific movie
public function selectedmoviereview($id){
        $movie = Movie::findOrFail($id);
        $reviews = Review::where('movie_id', $id)->latest()->get();

        return view('admin.adminblade.reviewshow', compact('movie', 'reviews'));
    }

}