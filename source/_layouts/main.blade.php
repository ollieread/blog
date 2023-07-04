<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ $page->title ?  $page->title . ' | ' : '' }}{{ $page->siteName }}</title>

    <link rel="home" href="{{ $page->baseUrl }}">
    <link rel="icon" href="/favicon.ico">
    <link href="/blog/feed.atom" type="application/atom+xml" rel="alternate" title="{{ $page->siteName }} Atom Feed">

    <link rel="stylesheet" href="{{ mix('css/app.css', 'assets/build') }}">

    {{-- The page header, for everything that should be in the <head> tag --}}
    @yield('page.header')
</head>

<body class="antialiased">

<header class="header">

    @include('_components.page.header.links')
    <img src="/assets/images/ollieread.jpg"
         alt="Picture of ollieread"
         class="header__image">

    <div class="header__title">Ollie Read</div>

    @include('_components.page.header.navbar')

</header>

<main class="section content">
    {{-- The main page content --}}
    @yield('content')
</main>

@if ($page->production)
    <!-- Fathom - beautiful, simple website analytics -->
    <script src="https://cdn.usefathom.com/script.js" data-site="THPWLTOW" defer></script>
    <!-- / Fathom -->
@endif

<script src="{{ mix('js/main.js', 'assets/build') }}"></script>

{{-- The page footer, where extra Javascript and such can go --}}
@yield('page.footer')
</body>
</html>
