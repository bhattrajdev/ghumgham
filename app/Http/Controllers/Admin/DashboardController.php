<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Location;
use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("home");
        $repo = new DashboardRepository('2000-01-01', '2024-10-01');
        return view('home', [
            'blog_count' => Blog::count(),
            'location_count' => Location::count(),
            'blog_lists' =>  Blog::orderBy('created_at', 'desc')->get()->take(5),
            'location_lists' => Location::orderBy('created_at', 'desc')->get()->take(5),
        ]);
    }
}
