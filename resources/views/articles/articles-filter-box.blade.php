<div class="block-filters__tags filter-tags">

</div>
<input type="hidden" name="tagsHiddenInput" value="">
<div class="block-filters__filters filters-list">

    <div class="filters-list__item filter-item
        {{ request('articletheme') ? 'active' : '' }}" filter-dropdown>
        <a filter-dropdown-button class="filter-item__name">
            <span filter-dropdown-button>Тема</span>
            <svg filter-dropdown-button class="arrow-icon">
                <use xlink:href="#arrow"></use>
            </svg>
        </a>
        <ul class="filter-item__settings filter-settings">

            @foreach ($articlethemes as $articletheme)
                <li wire:navigate href="{{ request()->fullUrlWithQuery([
                        'articletheme'=>$articletheme->id,
                    ]) }}"
                    class="filter-settings__item
                    {{ request('articletheme') == $articletheme->id ? 'active' : '' }}">
                    <span>{{ $articletheme->name }}</span><span
                        class="filter-settings__amount">{{ $articletheme->articles_count }}</span>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="filters-list__item filter-item {{ request('version') ? 'active' : '' }}" filter-dropdown>
        <a filter-dropdown-button class="filter-item__name">
            <span filter-dropdown-button>Версия UE</span>
            <svg filter-dropdown-button class="arrow-icon">
                <use xlink:href="#arrow"></use>
            </svg>
        </a>
        <ul class="filter-item__settings filter-settings">

            @foreach ($versions as $version)
                <li wire:navigate href="
                    {{ request()->fullUrlWithQuery([
                        'version'=>$version->id,
                    ]) }}"
                    class="filter-settings__item
                    {{ request('version') == $version->id ? 'active' : '' }}">
                    <span>{{ $version->name }}</span><span
                        class="filter-settings__amount">{{ $version->articles_count }}</span>
                </li>
            @endforeach

        </ul>
    </div>
</div>
