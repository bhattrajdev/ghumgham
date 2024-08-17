<!doctype html>
<html lang="en">

<head>
    <title>Ghumgham - Discover Your Next Adventure</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('/assets/frontend/css/style.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Ghumgham</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="#locations">Locations</a></li>
                        <li class="nav-item"><a class="nav-link" href="#blogs">Blogs</a></li>
                        <li class="nav-item"><a class="nav-link" href="#blogs">Blogs</a></li>

                    </ul>
                    <a href="#" class="btn-login ms-auto">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section (Carousel) -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($locations as $index => $location)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                style="background-image: url('{{ $location->cover_image->getPath() }}');">
                @if($location->carousel_text)
                <div class="carousel-caption d-flex align-items-end justify-content-center">
                    <div>
                        <h1>{{$location->carousel_text}}</h1>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- About Us Section -->
    <section id="about" class="about-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ $locations[0]->feature_image->getPath() }}" class="img-fluid rounded mb-4"
                        alt="Travel Experience">
                </div>
                <div class="col-md-6 flex-column justify-content-center align-items-start">
                    <h2 class="text-center mb-4 subheading">About Ghumgham</h2>
                    <p class="text-justify">
                        Ghumgham is your ultimate travel companion, designed to bring you the best travel
                        recommendations tailored to your preferences. Whether you're looking for serene getaways,
                        adventurous explorations, or cultural immersions, Ghumgham has got you covered. Our platform
                        leverages cutting-edge technology to offer personalized travel suggestions based on your
                        interests and past experiences.

                        <br><br>

                        <strong>Discover Your Next Adventure:</strong> From stunning natural landscapes to vibrant city
                        life, our curated recommendations ensure you find exactly what you're looking for. Explore
                        hidden gems, popular destinations, and everything in between with ease.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- Locations Section -->
    <section id="locations" class="locations-section py-5">
        <div class="container">
            <h2 class="text-center mb-4 subheading">New Locations</h2>
            <div class="row">
                @foreach ($locations as $location)
                <div class="col-md-4 mb-4">
                    <a href="{{ $location->link }}" class="card">
                        <img src="{{$location->cover_image->getPath()}}" class="card-img-top" alt="Location">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$location->title}}</h5>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Follow Us Section -->
    <!-- Follow Us Section -->
    <section id="follow-us" class="follow-us">
        <div class="container">
            <h2 class="subheading">Follow Us On</h2>
            <div class="social-icons">
                <a href="https://facebook.com" target="_blank" class="social-icon facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="social-icon twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="social-icon instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://linkedin.com" target="_blank" class="social-icon linkedin">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="https://youtube.com" target="_blank" class="social-icon youtube">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Blogs Section -->
    <section id="blog" class="locations-section py-5">
        <div class="container">
            <h2 class="text-center mb-4 subheading">New Blogs</h2>
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <a href="{{ $location->link }}" class="card">
                        <img src="{{$blog->cover_image->getPath()}}" class="card-img-top" alt="blog">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$blog->title}}</h5>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer text-white text-center">
        <div class="container">
            <p>&copy; 2024 Ghumgham. All rights reserved.</p>
            <p>
                <a href="#" class="text-white">Privacy Policy</a> |
                <a href="#" class="text-white">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- Font Awesome Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>