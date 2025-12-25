<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $websiteName = App\Models\Setting::get('website_name', config('app.name'));
        $companyName = App\Models\Setting::get('company_name', 'PT. Tropis Fish Indonesia');
        $companyLogo = App\Models\Setting::get('company_logo');
        $faviconUrl = $companyLogo ? asset('storage/' . $companyLogo) : asset('assets/logo-pt.jpeg');

        $seoTitle = App\Models\Setting::get('seo_title', $websiteName);
        $seoDescription = App\Models\Setting::get('seo_description', 'Premium quality ornamental fish exporter from Indonesia');
        $seoKeywords = App\Models\Setting::get('seo_keywords', 'ornamental fish, tropical fish, fish export, aquarium fish, Indonesia');
        $ogImage = App\Models\Setting::get('og_image') ? asset('storage/' . App\Models\Setting::get('og_image')) : $faviconUrl;
    @endphp
    <title>{{ $title ?? $seoTitle }}</title>

    {{-- Meta Tags --}}
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <meta name="author" content="{{ $companyName }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $title ?? $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:type" content="website">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white w-full overflow-x-hidden">
    {{ $slot }}

    @stack('scripts')
</body>
</html>
