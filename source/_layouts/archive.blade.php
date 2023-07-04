@extends('_layouts.main')

@section('page.title')
    - [Archived]
    {{ $page->title ?? $page->heading ?? $page->name }}
@endsection

@section('page.header')
    <!--  Metadata -->
    <meta name="description" content="{{ $page->seo_description ?? $page->excerpt }}" />

    <!-- OpenGraph Metadata -->
    <meta name="og:type" property="og:type" content="article" />
    <meta name="og:title" property="og:title" content="{{ $page->title ?? $page->heading ?? $page->name }}"/>
    <meta name="og:url" property="og:url" content="{{ $page->getUrl() }}" />
    <meta name="og:locale" property="og:locale" content="en_GB" />
    <meta name="og:site_name" property="og:site_name" content="ollieread.com"/>
    <meta name="og:image" property="og:image" content="/assets/images/page-thumbnail.png" />

    <!-- Article Metadata -->
    <meta name="article:published_time" property="article:published_time" content="{{ $page->getDate()->toIso8601String() }}"/>
    <meta name="article:section" property="article:section" content="{{ $page->category }}"/>

    <!-- Twitter Metadata -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@ollieread" />
@endsection

@section('content')

    @include('_components.articles.read')

@endsection