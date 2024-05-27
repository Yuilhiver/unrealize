<div class="works-page__works-menu works-menu">
    @if(count($this->collaborations) < 1)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
        </div>
    @endif
    <div class="cols-view-wrapper">
        @foreach ($this->collaborations as $collaboration)
            @include('shared.collaboration-card')
        @endforeach
        {{ $this->collaborations->onEachSide(1)->links('pagination::tailwind') }}
    </div>
</div>
