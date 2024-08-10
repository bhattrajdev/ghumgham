<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("home");
        // $repo = new DashboardRepository('2000-01-01', '2024-01-01');
        // return view('home', [

        //     'destinations_count' => Page::typeDestination()->count(),
        //     'activities_count' => Page::typeActivity()->count(),
        //     'activities' => Page::typeActivityListPages()->get(),

        //     'packages_count' => Package::count(),

        //     'bookings_count' => Booking::count(),
        //     'inquiries_count' => Inquiry::count(),
        //     'contacts_count' => Contact::count(),
        //     'teams_count' => Team::count(),
        //     'blogs_count' => Blog::count(),


        //     'top_packages' => Package::withCount('bookings')->orderBy('bookings_count', 'desc')->take(4)->get(),
        //     'recent_bookings' => Booking::orderBy('created_at', 'desc')->get()->take(5),
        // ]);
    }
}
