<a href="{{ $article->getUrl() }}" class="panel panel--link">
    @if ($article->image)
        <img src="https://via.placeholder.com/2000x2000" alt="" class="panel__image">
    @endif

    <header class="panel__header">

        <div class="panel__badges">
            @include('_components/articles/category-badge', ['category' => $article->category])
            @if ($archive)
                <span class="badge badge--red">Archived</span>
            @endif
        </div>

        <h2 class="panel__header-title">{{ $aticle->heading ?? $article->title }}</h2>

        <time class="panel__header-time">{{ $article->getDate()->format('jS F, Y') }}</time>

    </header>
    @if (! isset($noBody) || ! $noBody)
        <main class="panel__body">
            <p>{!! $article->description !!}</p>
        </main>
    @endif
</a>