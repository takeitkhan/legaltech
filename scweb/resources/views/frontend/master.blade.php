@php 
    $settings = \Cache::rememberForever('settings', function () {
        $keys = [
                'site_name',
                'copyright',
                'footer_address',
                'facebook_link',
                'instagram_link',
                'linkedin_link',
                'twitter_link',
                'meta_keywords',
                'meta_description',
                'site_logo',
                'favicon'
            ];

        return \App\Models\Setting::whereIn('key', $keys)->select('id', 'key', 'value')->get()->toArray();

    });

    $settings = array_combine(array_column($settings, 'key'), $settings);

@endphp 

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Sadik">

    @if(isset($__env->getSections()['meta'])) 
        @yield('meta')
    @else 
        <meta name="description" content="{{ $settings['meta_description']['value'] ?? null }}">
        <meta name="keywords" content="{{ $settings['meta_keywords']['value'] ?? null }}">

        <meta property="og:title" content="@yield('title')" />
        <meta property="og:description" content="{{ $settings['meta_description']['value'] ?? null }}">
        <meta property="og:type" content="blog" />
        <meta property="og:url" content="{{ request()->url() }}" />
        <meta property="og:image" content="{{ isset($settings['site_logo']['value']) ? asset('storage/'.$settings['site_logo']['value']) : asset('placeholder.jpg') }}" />
    @endif    

    <link rel="shortcut icon" href="{{ isset($settings['favicon']['value']) ? asset('storage/'.$settings['favicon']['value']) : asset('placeholder.jpg') }}"/>
    <title>@yield('title') | Sadik Counsel</title>

    @include('frontend.partials._header_css')

</head>
<body>

    <!-- Main-menu-area going here-->
    @include('frontend.partials._header_menu')

    <!-- Main content -->
    @yield('content')
    <!-- End main content -->

    <!-- Footer -->
    @include('frontend.partials._footer')

    <!-- The social media icon bar -->
    @include('frontend.partials._socials_bar')
    
    @include('frontend.partials._footer_css')
</body>
</html>