    <div class="works-page__works-menu works-menu">
        <div class="cols-view-wrapper">

            @if(count($this->feed) < 1)

                <div class="empty-error">
                    <h1>Ничего не найдено</h1>
                    <a href="{{ route('users.index') }}">Подпишитесь на наших талантливых создателей</a>
                </div>

            @endif

            {{ $this->feed->onEachSide(1)->links('pagination::tailwind') }}
            @foreach ($this->feed as $work)
                @include('shared.work-card-second')
            @endforeach
            {{ $this->feed->onEachSide(1)->links('pagination::tailwind') }}

        </div>
    </div>
