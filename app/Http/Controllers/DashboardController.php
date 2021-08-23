<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Category;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
    	return view('dashboard.index', [

    		'posts_count' => Post::all()->count(),
    		'users_count' => User::all()->count(),
    		'categories_count' => Category::all()->count()



    	]);
    }
}
