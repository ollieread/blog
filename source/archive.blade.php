---
title: Archived articles
description: The archive of old and retired articles.
pagination:
    collection: archive
    perPage: 10
---
@extends('_layouts.main')

@section('page.header')
    <!--  Metadata -->
    <meta name="description" content="The archive of old and retired articles." />
    <meta name="keywords" content="Ollie, Read, Ollie Read, ollieread, php, laravel, multitenancy, php developer, laravel developer, software engineer" />

    <!-- OpenGraph Metadata -->
    <meta name="og:type" property="og:type" content="website" />
    <meta name="og:title" property="og:title" content="ollieread.com - Article archive"/>
    <meta name="og:url" property="og:url" content="/archive" />
    <meta name="og:locale" property="og:locale" content="en_GB" />
    <meta name="og:site_name" property="og:site_name" content="ollieread.com"/>
    <meta name="og:image" property="og:image" content="/assets/images/page-thumbnail.png" />

    <!-- Twitter Metadata -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@ollieread" />
@endsection

@section('content')

    <header class="section__header">
        <h1 class="section__heading">Archive</h1>
        <p>
            This is the article archive, containing articles that were either retired or from an old version of this
            site.
        </p>

        <div class="notice notice--error">
            <p>
                These articles were written a long time ago, and while they may have been updated, I cannot guarantee
                that the content included in them is still correct or relevant.
            </p>
        </div>
    </header>

    @include('_components.articles.listing', ['articles' => $pagination, 'archive' => true])

@endsection
