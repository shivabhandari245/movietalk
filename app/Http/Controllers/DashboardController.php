<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Define the method that handles the dashboard view
    public function index()
    {
        // Fetch the number of users and movies
        $users = User::count();
        $movies = Movie::count();

       
        $user = Auth::user();  

   
        return view('admin.adminblade.dashboard', compact('users', 'movies', 'user'));
    }
}
