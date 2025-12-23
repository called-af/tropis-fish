<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $websiteName = App\Models\Setting::get('website_name', config('app.name'));
    @endphp
    <title>{{ $title ?? $websiteName }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white w-full overflow-x-hidden">
    {{ $slot }}

    @stack('scripts')
</body>
</html>
