<div class="panels">

    @if ($articles->count() > 0)
        @foreach ($articles->items as $article)
            @include('_components.articles.entry', ['noBody' => true])
        @endforeach
    @else
        <div class="notice notice--info">
            <p>
                No articles could be found
            </p>
        </div>
    @endif

</div>

@if ($articles instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
    {!! $articles->links(); !!}
@endif