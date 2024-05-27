<div class="block-filters__tags filter-tags">
</div>
<div class="block-filters__filters filters-list">
    <div class="filters-list__item filter-item active" filter-dropdown>
        <a filter-dropdown-button class="filter-item__name">
            <span filter-dropdown-button>Подписки</span>
            <svg filter-dropdown-button class="arrow-icon">
                <use xlink:href="#arrow"></use>
            </svg>
        </a>
        <ul class="filter-item__settings filter-settings">

            @foreach ($followings as $user)
                <li wire:navigate href="{{ request()->fullUrlWithQuery([
                        'author'=>$user->id,
                    ]) }}"
                    class="filter-settings__item
                    {{ request('author') == $user->id ? 'active' : '' }}">
                    <span>{{ $user->login }}</span><span class="filter-settings__amount">
                        {{ $user->works_count }}</span>
                </li>
            @endforeach

        </ul>
    </div>
</div>
