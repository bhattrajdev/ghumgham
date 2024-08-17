<?php

namespace App\Http\Controllers;

use App\Repositories\FrontendRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private FrontendRepository $frontendRepository;

    public function __construct(FrontendRepository $frontendRepository)
    {
        $this->frontendRepository = $frontendRepository;
    }


    public function welcome(): View
    {
        return view('welcome', $this->frontendRepository->getWelcomeData());
    }


    public function getLocation()
    {
        return ("get location");
        // return view('welcome', $this->frontendRepository->getWelcomeData());
    }

    public function getBlog()
    {
        return ("get blog");
        // return view('welcome', $this->frontendRepository->getWelcomeData());
    }
}
