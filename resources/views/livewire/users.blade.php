
<div class="authors__authors-block authors-page">
    <div class="authors-page__menu-search">
        <div class="authors-page__menu">
        <a class="{{ $sort === 'desc' && $sortBy != 'works_count'  && $sortBy != 'followers_count' ? 'active' : '' }}
            stealth text-light-bg sort-item" sort-item id="sort-new"
            wire:click="setSort('desc')">
            Новые</a>
        <a class="{{ $sort === 'asc' ? 'active' : '' }}
            stealth text-light-bg sort-item" sort-item id="sort-achievements"
            wire:click="setSort('asc')">
            Старые</a>
        <a class="{{ $sortBy === 'followers_count' ? 'active' : '' }} stealth text-light-bg sort-item" sort-item id="sort-works"
            wire:click="setSort('followers')">
            Больше всего подписчиков</a>
        <a class="{{ $sortBy === 'works_count' ? 'active' : '' }}
            stealth text-light-bg sort-item" sort-item id="sort-works"
            wire:click="setSort('works')">
            Больше всего работ</a>
        </div>

        @include('shared.search-box')

    </div>

    @if(count($this->users) < 1)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
        </div>
    @endif

    <div class="authors-page__list">

        @foreach ($this->users as $user)
            @include('shared.user-card')
        @endforeach
        {{ $this->users->onEachSide(1)->links('pagination::tailwind') }}

    </div>

</div>
