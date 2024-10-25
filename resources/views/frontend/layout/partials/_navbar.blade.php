<!-- Navbar start -->
        <div class="container-fluid sticky-top px-0">
            <div class="container-fluid topbar bg-dark d-none d-lg-block">
                <div class="container px-0">
                    <div class="topbar-top d-flex justify-content-between flex-lg-wrap">
                        <div class="top-info flex-grow-0">
                            <span class="rounded-circle btn-sm-square bg-primary me-2">
                                <i class="fas fa-bolt text-white"></i>
                            </span>
                            <div class="pe-2 me-3 border-end border-white d-flex align-items-center">
                                <p class="mb-0 text-white fs-6 fw-normal">Trending</p>
                            </div>
                            <div class="overflow-hidden" style="width: 735px;">
                                <div id="note" class="ps-2">
                                    <a href="#">
                                        <p class="text-white mb-0 link-hover">
                                            {{ $top_view->title ?? '' }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="top-link flex-lg-wrap">
                            <i class="fas fa-calendar-alt text-white border-end border-secondary pe-2 me-2"> <span class="text-body">Tuesday, Sep 12, 2024</span></i>
                            <div class="d-flex icon">
                                <p class="mb-0 text-white me-2">Follow Us:</p>
                                <a href="" class="me-2"><i class="fab fa-facebook-f text-body link-hover"></i></a>
                                <a href="" class="me-2"><i class="fab fa-twitter text-body link-hover"></i></a>
                                <a href="" class="me-2"><i class="fab fa-instagram text-body link-hover"></i></a>
                                <a href="" class="me-2"><i class="fab fa-youtube text-body link-hover"></i></a>
                                <a href="" class="me-2"><i class="fab fa-linkedin-in text-body link-hover"></i></a>
                                <a href="" class="me-2"><i class="fab fa-skype text-body link-hover"></i></a>
                                <a href="" class=""><i class="fab fa-pinterest-p text-body link-hover"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-light">
                <div class="container px-0">
                    <nav class="navbar navbar-light navbar-expand-xl">
                        <a href="{{ route('frontend.home') }}" class="navbar-brand mt-3">
                            <p class="text-primary display-6 mb-2" style="line-height: 0;">MSIB</p>
                            <small class="text-body fw-normal" style="letter-spacing: 12px;">Laravel Blog</small>
                        </a>
                        <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="fa fa-bars text-primary"></span>
                        </button>
                        <div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
                            <div class="navbar-nav mx-auto border-top">
                                <a href="{{ route('frontend.home') }}" class="nav-item nav-link active">Home</a>

                                <a href="{{ route('articles.index') }}" class="nav-item nav-link">Articles</a>

                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                                    <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                        <a href="{{ route('category.show', 'laravel') }}" class="dropdown-item">Laravel</a>
                                        <a href="{{ route('category.show', 'express-js') }}" class="dropdown-item">Express Js</a>
                                        <a href="{{ route('category.show', 'adonis-js') }}" class="dropdown-item">Adonis Js</a>
                                        <a href="{{ route('category.index') }}" class="dropdown-item">All Category</a>
                                    </div>
                                </div>

                                <a href="contact.html" class="nav-item nav-link">Contact Us</a>
                            </div>

                            <div class="d-flex flex-nowrap border-top pt-3 pt-xl-0">
                                <div class="d-flex">
                                    <img src="{{ asset('assets/frontend') }}/img/weather-icon.png" class="img-fluid w-100 me-2" alt="">
                                    <div class="d-flex align-items-center">
                                        <strong class="fs-4 text-secondary">31°C</strong>
                                        <div class="d-flex flex-column ms-2" style="width: 150px;">
                                            <span class="text-body">NEW YORK,</span>
                                            <small>Mon. 10 jun 2024</small>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-search btn border border-primary btn-md-square rounded-circle bg-white my-auto" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar End -->
