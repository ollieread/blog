---
title: Articles
description: All articles and musings.
pagination:
    collection: articles
    perPage: 10
---
@extends('_layouts.main')

@section('page.header')
    <!--  Metadata -->
    <meta name="description" content="All articles and musings." />
    <meta name="keywords" content="Ollie, Read, Ollie Read, ollieread, php, laravel, multitenancy, php developer, laravel developer, software engineer" />

    <!-- OpenGraph Metadata -->
    <meta name="og:type" property="og:type" content="website" />
    <meta name="og:title" property="og:title" content="ollieread.com - Article archive"/>
    <meta name="og:url" property="og:url" content="/articles" />
    <meta name="og:locale" property="og:locale" content="en_GB" />
    <meta name="og:site_name" property="og:site_name" content="ollieread.com"/>
    <meta name="og:image" property="og:image" content="/assets/images/page-thumbnail.png" />

    <!-- Twitter Metadata -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@ollieread" />
@endsection

@section('content')

    <header class="section__header">
        <h1 class="section__heading">Articles</h1>
        <p>
            All the articles and musings I've posted.
        </p>
    </header>

    <div class="notice notice--info">
        <p>
            No articles could be found
        </p>
    </div>

@endsection
