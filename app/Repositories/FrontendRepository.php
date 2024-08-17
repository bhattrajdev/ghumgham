<?php

namespace App\Repositories;

use App\Enums\PackageType;
use App\Enums\PageTemplateType;
use App\Enums\TeamCategory;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Location;
use App\Models\Package;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimonial;
use PragmaRX\Countries\Package\Services\Countries;

class FrontendRepository
{


    public function getWelcomeData()
    {
        return [
            'locations' => Location::take(3)->get(),
            'settings' => SiteSetting::first(),
            'blogs' => Blog::take(3)->get(),

        ];
    }
}
