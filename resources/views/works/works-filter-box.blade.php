<div class="block-filters__tags filter-tags">

</div>
<input type="hidden" name="tagsHiddenInput" value="">
<div class="block-filters__filters filters-list">

    <div class="filters-list__item filter-item {{ request('worktype') ? 'active' : '' }}" filter-dropdown id="work-type">
        <a filter-dropdown-button class="filter-item__name">
            <span filter-dropdown-button>Тип работы</span>
            <svg filter-dropdown-button class="arrow-icon">
                <use xlink:href="#arrow"></use>
            </svg>
        </a>
        <ul class="filter-item__settings filter-settings">

            @foreach ($worktypes as $worktype)
                <li wire:navigate href="{{ request()->fullUrlWithQuery([
                        'worktype'=>$worktype->id,
                    ]) }}"
                    class="filter-settings__item
                    {{ request('worktype') == $worktype->id ? 'active' : '' }}">
                    <span>{{ $worktype->name }}</span><span
                        class="filter-settings__amount">{{ $worktype->works_count }}</span>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="filters-list__item filter-item {{ request('workgenre') ? 'active' : '' }}" filter-dropdown id="work-genre">
        <a filter-dropdown-button class="filter-item__name">
            <span filter-dropdown-button>Жанр</span>
            <svg filter-dropdown-button class="arrow-icon">
                <use xlink:href="#arrow"></use>
            </svg>
        </a>
        <ul class="filter-item__settings filter-settings">

        @foreach ($genres as $workgenre)
            <li wire:navigate href="
                {{ request()->fullUrlWithQuery([
                    'workgenre'=>$workgenre->id,
                ]) }}"
                class="filter-settings__item
                {{ request('workgenre') == $workgenre->id ? 'active' : '' }}">
                <span >{{ $workgenre->name }}</span><span
                    class="filter-settings__amount">{{ $workgenre->works_count }}</span>
            </li>
        @endforeach

        </ul>
    </div>

    <div class="filters-list__item filter-item {{ request('version') ? 'active' : '' }}" filter-dropdown id="work-ver">
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
                        class="filter-settings__amount">{{ $version->works_count }}</span>
                </li>
            @endforeach

        </ul>
    </div>
</div>
