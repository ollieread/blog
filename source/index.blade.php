@extends('_layouts.main')

@section('page.title')
    - Hello, I'm Ollie
@endsection

@section('page.header')
    <!--  Metadata -->
    <meta name="description" content="Ollie Read, PHP/Laravel developer, mentor, programmer and general all around code person" />
    <meta name="keywords" content="Ollie, Read, Ollie Read, ollieread, php, laravel, multitenancy, php developer, laravel developer, software engineer" />

    <!-- OpenGraph Metadata -->
    <meta name="og:type" property="og:type" content="website" />
    <meta name="og:title" property="og:title" content="ollieread.com - Home of Ollie Read"/>
    <meta name="og:url" property="og:url" content="https://ollieread.com" />
    <meta name="og:locale" property="og:locale" content="en_GB" />
    <meta name="og:site_name" property="og:site_name" content="ollieread.com"/>
    <meta name="og:image" property="og:image" content="/assets/images/page-thumbnail.png') }}" />

    <!-- Twitter Metadata -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@ollieread" />
@endsection

@section('content')

    <header class="section__header">
        <h1 class="section__heading">Hello there!</h1>
    </header>

    <main class="section__content">
        <p>
            My name is Ollie, and I'm a dad, step-dad, software developer, and asker of unceasing questions.
        </p>
        <p>
            I work with a lot of languages, PHP being my favourite, and the one I'm most skilled with, though I have
            been known to dabble with C, C++, Javascript, Ruby and a close second place favourite, Java.
        </p>
        <p>
            I create educational content for PHP and programming
            in general, in the form of <a href="/articles">articles</a>,
            <a href="https://youtube.com/@olliecodes" target="__blank">videos</a>, and
            <a href="#">courses</a>.
        </p>
        <p>
            I release my own open source work, as well as contribute to existing projects, including but not limited to
            <a href="https://github.com/laravel/framework/pulls?q=is%3Apr+author%3Aollieread+" target="_blank">Laravel</a>,
            <a href="https://github.com/php/php-src/pulls?q=is%3Apr+author%3Aollieread+" target="_blank">
                PHP</a>,
            and
            <a href="https://github.com/php/doc-en/pulls?q=is%3Apr+author%3Aollieread+" target="_blank">
                the PHP docs
            </a>.
        </p>
        <p>
            I'm a freelance contractor that specialises heavily in PHP and Laravel, providing general web development
            services, as well as reviewing, planning, mentoring and general guidance and input.
        </p>
    </main>

@endsection