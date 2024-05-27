<div class="works-page__works-menu works-menu">
    @if(count($this->articles) < 1)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
        </div>
    @endif
    <div class="cols-view-wrapper">
        @foreach ($this->articles as $article)
            @include('shared.article-card')
        @endforeach
    </div>
    {{ $this->articles->onEachSide(1)->links('pagination::tailwind') }}
</div>
