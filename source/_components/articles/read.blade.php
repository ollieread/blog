
@if ($page->archive)
    <div class="notice notice--error">
        <p>
            This article was written a long time ago, and while it may have been updated, I cannot guarantee
            that the content included in here is still correct or relevant.
        </p>
    </div>
@endif

<div class="panel">
    @if ($page->image)
        <img src="https://via.placeholder.com/2000x2000" alt="" class="panel__image">
    @endif

    <header class="panel__header">

        <div class="panel__badges">
            <a href="/"
               class="badge badge--green">Category</a>
            @if ($page->archived)
                <span class="badge badge--red">Archived</span>
            @endif
        </div>

        <h1 class="panel__header-title">{{ $page->heading ?? $page->title }}</h1>

        <time class="panel__header-time">{{ $page->getDate()->format('jS F, Y') }}</time>

    </header>
    <main class="panel__body">
        @yield('article')
    </main>
</div>