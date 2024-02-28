<!-- Main-menu-area going here-->
<section id="main-menu-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="main-navbar">
                    <ul class="d-flex flex-column flex-xxl-row flex-xl-row flex-lg-row flex-md-column flex-sm-column justify-content-between align-items-center gap-4">
                        <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About us</a></li>
                        <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services</a></li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="/">
                                <img src="{{ isset($settings['site_logo']['value']) && $settings['site_logo']['value'] != null ? asset('storage/'.$settings['site_logo']['value']) : asset('frontend/assets/img/logo.svg') }}" alt="Brand Logo" width="200">
                            </a>
                        </li>
                        <li class="nav-item"><a href="{{ route('blogs') }}" class="nav-link">Blogs</a></li>
                        <li class="nav-item"><a href="{{ route('team') }}" class="nav-link">Our Team</a></li>
                        <li class="nav-item">
                            <button class="btn" type="submit"><ion-icon name="search-outline"></ion-icon></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End main-menu-area -->