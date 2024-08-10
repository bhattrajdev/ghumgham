@section('seo')
@include('layouts._front_includes._seo', ['seo' => $setting->seo])
@endsection
@extends('layouts.frontend_master')
@section('content')
@if ($sliders->count() > 0)
<section class="home-banner">
    <div class="img-container screen-fit-section poly-image bg-primary-dark ">
        @if ($sliders->first()->feature_image->getFileType() == 'image')
        <img src="{{ $sliders->first()->feature_image->getPath() }}" class="img-cover" alt="{{ $sliders->first()->feature_image->alt }}">
        @elseif($sliders->first()->feature_image->getFileType() == 'video')
        <video autoplay loop muted class="banner-video img-cover" style="opacity: 0.9;">
            <source src="{{ $sliders->first()->feature_image->getPath() }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>


        @endif
        <div class="overlay-backdrop content-centered">
            <div class="container">
                <div class="wrapper flex-1 px-3 text-center">
                    @php
                    //second word highlight
                    $inputString = $sliders->first()->name;
                    $words = explode(' ', $inputString);
                    if (count($words) >= 3) {
                    $heading1 = $words[0] . ' <span class="heading-ultra text-white fw-bold">' . $words[1] . '</span> ' . implode(' ', array_slice($words, 2));
                    } else {
                    $heading1 = $inputString;
                    }
                    @endphp

                    <h1 class="text-uppercase text-white fw-bold">{!! $heading1 !!}</h1>

                    @if (!empty($sliders->first()->description))
                    @php
                    //second and third word highlight
                    $inputString = $sliders->first()->description;
                    $words = explode(' ', $inputString);
                    if (count($words) >= 3) {
                    $heading2 = $words[0] . ' <span class="heading-ultra text-white fw-bold">' . $words[1] . ' ' . $words[2] . '</span> ' . implode(' ', array_slice($words, 3));
                    } else {
                    $heading2 = $inputString;
                    }
                    @endphp

                    <h2 class="text-uppercase text-white fw-bold">{!! $heading2 !!}</h2>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!--slider end-->

<!-- intro section -->
@if (!empty($home_ads))
<section class="section-gap-bot home-intro-section py-5 my-5" style="background-image: url({{ asset('assets/front_assets/images/logo-bg.png') }});">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-4 col-lg-5 intro-titles">
                <h2 class="heading-main fw-bold text-uppercase text-alt pe-xl-4">{{ $home_ads->name }}</h2>
                <a href="{{ $home_ads->meta }}" class="main-btn mt-2">Learn More<i class="fa-solid fa-chevron-right"></i></a>
            </div>
            <div class="col-xl-6 col-lg-7 mt-4 mt-lg-0">
                <p class="pe-xl-4">
                    {{ Str::limit(strip_tags($home_ads->meta1), 500) }}
                </p>
            </div>
            <div class="col-xl-10 col-lg-12 mt-5">
                <figure class="intro-cover-image img-container mb-0">
                    <img src="{{ $home_ads->feature_image->getPath() }}" alt="{{ $home_ads->feature_image->alt }}" class="img-cover">
                    <div class="overlay-backdrop theme-overlay content-centered">
                        <a href="{{ $setting->video_banner_link }}" class="icon-btn-wrapper glightbox">
                            <span class="icon-btn">
                                <i class="fa-solid fa-play fa-lg"></i>
                            </span>
                        </a>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</section>
@endif

@if (isset($main_activities) && $main_activities->count() > 0)
<!-- main activities -->
<section class="section-gap-bot">
    <div class="row m-0 pro-cards-row">
        @foreach ($main_activities as $activity)
        <div class="col-xl-3_5 col-lg-6 col-md-6 p-0 pro-card-col">
            <div class="pro-card position-relative">
                <figure class="img-container m-0 ratio-tall">
                    <a href="{{ route('page', $activity->slug) }}" class="d-inline">
                        <img src="{{ $activity->feature_image->getPath() }}" alt="{{ $activity->feature_image->alt }}" class="img-cover smooth">
                        <div class="overlay-backdrop text-center pt-5">
                            <h3 class="heading-info text-uppercase mb-1 fw-bold text-white">{{ $activity->title }}</h3>
                            <span class="pkg-counter d-inline-flex align-items-end gap-2 text-white">
                                <b class="text-white pkg-count">{{ $activity->getListPagePackageCount() }}</b>
                                <span class="text-uppercase pkg-count-text fw-bold text-sm">Packages</span>
                            </span>
                        </div>
                    </a>
                </figure>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<div class="line-bg section-gap-bot" style="background-image: url({{ asset('assets/front_assets/images/length-bg.svg') }});" id="bg-container">
    @if (isset($home_expeditions) && $home_expeditions->count() > 0)
    @foreach ($home_expeditions as $expedition)
    @if ($expedition->packages->count() > 0)
    <section class="pb-4">
        <div class="container">
            <div class="row align-items-end {{ $loop->even ? 'flex-md-row-reverse' : '' }}">
                <div class="col-lg-4 pe-lg-0">
                    <div class="bg-8000ers peak-bg text-lg-center pt-5 {{ $loop->even ? 'reverse-peak' : '' }}" id="bg-hook">
                        <h2 class="heading-large text-alt fw-bold mb-0">
                            {{ substr($expedition->title, 0, -3) }}<span class="text-uppercase heading-section text-alt fw-bold">{{ substr($expedition->title, -3) }}</span>
                        </h2>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-6 ps-lg-0">
                    <p class="mb-2 text-lg mt-2 mt-lg-0">
                        {{ Str::limit(strip_tags($expedition->description), 200, '...') }}
                    </p>
                </div>
            </div>
        </div>


        <div class="pt-2 mt-4 overflow-hidden">
            <div class="owl-slide owl-carousel">
                @foreach ($expedition->packages->take(4) as $package)
                <div class="slide-item pb-3">
                    @include('web._partials.available_packages')
                </div>
                @endforeach

                @if ($expedition->packages->count() > 4)
                <!-- actions -->
                <div class="slide-item">
                    <div class="slide-actions content-centered ps-4">
                        <a href="{{$expedition->slug}}" class="main-btn mt-2">View all Packages<i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif
    @endforeach
    @endif

    @if ($testimonials->count() > 0)
    @foreach ($testimonials as $testimonial)
    <!-- Modal -->
    <div class="modal fade" id="testimonialModal{{ $testimonial->id }}" tabindex="-1" aria-labelledby="testimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center text-start">
                        <figure class="img-container small-avatar rounded-circle mb-0 shrink-0">
                            <img src="{{ $testimonial->feature_image->getPath() }}" alt="{{ $testimonial->feature_image->alt }}" class="img-cover">
                        </figure>
                        <div class="ps-3">
                            <b class="base-card-title d-block fw-semibold">{{ $testimonial->name }}</b>

                        </div>
                    </div> <button type="button" class="custom-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <p class="my-2">
                            <?= $testimonial->description ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <!-- testimonails -->
    <section class="section-gap-bot section-gap-top bg-light">
        <div class="container text-center">
            <span class="sub-heading text-uppercase text-secondary">TESTIMONIALS</span>
            <h2 class="heading-main text-alt mt-1">Client's stories about us</h2>
            <!-- testimonials item count here-->
            <input type="hidden" id="tes-count" value="{{ $testimonials->count() }}">
            <div class="row mt-5 justify-content-center">
                <!-- left holder -->
                <div class="col-xl-3 section-gap-top d-none d-xl-block">
                    <div class="slide-list-wrapper position-relative smooth">
                        @foreach ($testimonials as $key => $testimonial)
                        <div class="slide-list slide-list-left animated fadeIn" <?= $loop->last ? 'style="display: block;"' : '' ?> data-index="{{ $key }}">
                            <div class="testimonial-card text-primary">
                                <div class="arrow-contents-top">
                                    <figure class="img-container avatar-img mx-auto ratio-1">
                                        <img src="{{ $testimonial->feature_image->getPath() }}" alt="{{ $testimonial->feature_image->alt }}" class="img-cover">
                                    </figure>
                                </div>
                                <p class="my-2">
                                    {{ Str::limit(strip_tags($testimonial->description), 200) }}
                                    @if (strlen($testimonial->description) >= 200)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#testimonialModal{{ $testimonial->id }}">Read
                                        More</a>
                                    @endif
                                </p>
                                <b class="base-card-title d-block fw-bold">{{ $testimonial->name }}</b>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- main slides -->
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="testimonial-carousel custom-indicators slide-gap">
                        @foreach ($testimonials as $testimonial)
                        <div class="slide-item">
                            <div class="testimonial-card text-primary">
                                <div class="arrow-contents-top">
                                    <figure class="img-container avatar-img mx-auto ratio-1">
                                        <img src="{{ $testimonial->feature_image->getPath() }}" alt="{{ $testimonial->feature_image->alt }}" class="img-cover">
                                    </figure>
                                </div>
                                <p class="my-2">
                                    {{ Str::limit(strip_tags($testimonial->description), 200) }}
                                    @if (strlen($testimonial->description) >= 200)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#testimonialModal{{ $testimonial->id }}">Read
                                        More</a>
                                    @endif
                                </p>
                                <b class="base-card-title d-block fw-bold">{{ $testimonial->name }}</b>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- right holder -->
                <div class="col-xl-3 section-gap-top d-none d-xl-block">
                    <div class="slide-list-wrapper position-relative smooth">
                        @foreach ($testimonials as $key => $testimonial)
                        <div class="slide-list slide-list-right animated fadeIn" <?= $key == 1 ? 'style="display: block;"' : '' ?> data-index="{{ $key }}">
                            <div class="testimonial-card text-primary">
                                <div class="arrow-contents-top">
                                    <figure class="img-container avatar-img mx-auto ratio-1">
                                        <img src="{{ $testimonial->feature_image->getPath() }}" alt="{{ $testimonial->feature_image->alt }}" class="img-cover">
                                    </figure>
                                </div>
                                <p class="my-2">
                                    {{ Str::limit(strip_tags($testimonial->description), 200) }}
                                    @if (strlen($testimonial->description) >= 200)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#testimonialModal{{ $testimonial->id }}">Read
                                        More</a>
                                    @endif
                                </p>
                                <b class="base-card-title d-block fw-bold">{{ $testimonial->name }}</b>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (!empty($trekking_section) && $trekking_section->packages()->count() > 0)
    <!-- trekking packages -->
    <section class="section-gap-top section-gap-bot">
        <div class="container text-center">
            <span class="sub-heading text-uppercase text-secondary">Embark On Adventure</span>
            <h2 class="heading-main text-alt mt-1">Explore Our Trekking Packages!</h2>
            <div class="row text-start justify-content-center">
                @foreach ($trekking_section->packages->take(6) as $package)
                <div class="col-xl-4 col-md-6 mt-4">
                    @include('web._partials.available_packages')
                </div>
                @endforeach
            </div>

            @if (isset($trekking_packages_list_page) && $trekking_section->packages->count() > 6)
            <div class="text-center mt-4">
                <a href="{{ route('page', $trekking_packages_list_page->slug ) }}" class="main-btn">View All Packages<i class="fa-solid fa-chevron-right"></i></a>
            </div>
            @endif
        </div>
    </section>
    @endif


    @if (!empty($home_cta))
    <!-- call to actions -->
    <section class="section-bg-img" style="background-image: url({{ $home_cta->feature_image->getPath() }});">
        <div class="theme-backdrop-light section-gap-bot section-gap-top">
            <div class="container py-4">
                <div class="row">
                    <div class="col-xl-8 col-lg-9">
                        <span class="sub-heading text-uppercase text-secondary">{{ $home_cta->name }}</span>
                        <h2 class="heading-main text-white mt-2 mb-4">{{ $home_cta->meta1 }}</h2>
                        <a href="{{ $home_cta->meta }}" class="main-btn">Join Us<i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (isset($other_activities) && $other_activities->count() > 0)
    <!-- other activities -->
    <section class="bg-primary-light section-gap-top section-gap-bot">
        <div class="container text-center">
            <span class="sub-heading text-uppercase text-secondary">More Adventure Awaits</span>
            <h2 class="heading-main text-alt mt-1">Explore Beyond Climbing!</h2>
            <div class="row">
                @foreach ($other_activities as $oa)
                <div class="{{ $other_activities->count() > 2 && $loop->last ? 'col-12' : 'col-sm-6' }} mt-4">
                    <div class="grid-card img-container">
                        <img src="{{ $oa->feature_image->getPath() }}" alt="{{ $oa->feature_image->alt }}" class="img-cover">
                        <a href="{{ route('page', $oa->slug) }}" class="grid-card-contents overlay-backdrop theme-backdrop-light content-centered">
                            <div class="arrow-contents flex-1">

                                @if (!$oa->icon_image->isEmpty())
                                <figure class="my-2">
                                    <img src="{{ $oa->icon_image->getPath() }}" alt="{{ $oa->icon_image->alt }}" class="img-contain icon-img">
                                </figure>
                                @endif

                                <h5 class="title-card-content text-white">{{ $oa->title }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- directors -->
    @if ($our_directors->count() > 0)
    <section class="section-gap-top section-gap-bot">
        <div class="container">
            <div class="row-wrapper text-center">
                <span class="sub-heading text-uppercase text-secondary">Our Directors</span>
                <h2 class="heading-main text-alt mt-1">Meet our Experts</h2>
                <div class="row justify-content-center text-start">
                    @foreach ($our_directors as $team)
                    <div class="col-md-6 col-lg-5 mt-4">
                        <div class="person-card position-relative">
                            <figure class="img-container ratio-1 person-img">
                                <a href="{{ route('team-detail', $team->slug) }}" class="d-inline">
                                    <img src="{{ $team->feature_image->getPath() }}" alt="{{ $team->feature_image->alt }}" class="img-cover hvr-grow-rotate">
                                </a>
                            </figure>
                            <div class="stacked-card-contents">
                                <h4 class="title-card-content mb-0_5">
                                    <a href="{{ route('team-detail', $team->slug) }}" class="link-text">{{ $team->name }}</a>
                                </h4>
                                <span class="d-block text-primary fw-semibold">{{ ucfirst($team->category) }}</span>

                                @if (!empty($team->phone) || !empty($team->ins_link))
                                <div class="border-top d-flex mt-2 pt-2">
                                    @if (!empty($team->phone))
                                    <!-- whatsapp -->
                                    <div class="w-50">
                                        <a href="tel:{{ $team->phone }}" class="link-with-icon text-color">
                                            <i class="fa-brands fa-whatsapp fa-lg text-primary"></i>
                                            <span class="link-with-icon-text">{{ $team->phone }}</span>
                                        </a>
                                    </div>
                                    @endif

                                    @if (!empty($team->ins_link))
                                    <!-- instagram -->
                                    <div class="w-50">
                                        <a href="{{ $team->ins_link }}" class="link-with-icon text-color">
                                            <i class="fa-brands fa-instagram fa-lg text-primary"></i>
                                            <span class="link-with-icon-text">{{ substr(strrchr($team->ins_link, '/'), 1) }}</span>
                                        </a>
                                    </div>

                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if (!empty($teams_page))
        <div class="text-center mt-4">
            <a href="{{ url($teams_page->slug) }}" class="main-btn">View All Teams<i class="fa-solid fa-chevron-right"></i></a>
        </div>
        @endif
    </section>
    @endif
</div>
@endsection

@push('frontend_js')
<script>
    let responsive_items = {
        0: {
            items: 1,
            stagePadding: 20
        },
        575: {
            items: 2,
            stagePadding: 60
        },
        992: {
            items: 2,
            stagePadding: 90
        },
        1200: {
            items: 3,
            stagePadding: 120
        }
    }

    $('.owl-slide').owlCarousel({
        margin: 24,
        nav: true,
        nav: false,
        responsive: responsive_items
    });

    $('.owl-slide-rtl').owlCarousel({
        margin: 24,
        nav: true,
        rtl: true,
        nav: false,
        responsive: responsive_items

    })
</script>
<script>
    // testimonials
    $('.testimonial-carousel').slick({
        speed: 500,
        slidesToShow: 1,
        centerMode: true,
        centerPadding: 0,
        dots: true,
        arrows: false
    });
    const tes_count = Number($("#tes-count").val() || '0');
    $('.testimonial-carousel').on('afterChange', function(event, slick, index) {
        $(`.slide-list`).css("display", "none");
        $(`.slide-list-left[data-index="${ index === 0 ? tes_count - 1 : index - 1}"]`).css("display", "block");
        $(`.slide-list-right[data-index="${ index === tes_count -1 ? 0 : index + 1}"]`).css("display", "block");
    });
</script>
<script>
    $(".person-img").append(`
        <svg viewBox="0 0 300 151" fill="none" xmlns="http://www.w3.org/2000/svg" class="holder-logo position-absolute">
            <path d="M149.881 0L116.234 33.6471L232.829 150.118H299.999L149.881 0Z" fill="#ffffff"/>
            <path d="M100.471 50.1172L0.235294 150.352L0 150.588H67.5294L100.471 117.882L133.412 150.588H200.706L100.471 50.1172Z" fill="currentColor"/>
        </svg>
    `)
</script>
@endpush