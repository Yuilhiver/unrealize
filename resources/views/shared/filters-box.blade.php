<div class="filters-wrapper">
    <div class="works-page__filters-block block-filters">
        <div class="block-filters__header filters-header">
            <h1 class="filters-header__header">Фильтры</h1>
            <button aria-label="Очистить фильтры" type="button" reset-filters><svg reset-filters
                    class="trashcan">
                    <use reset-filters xlink:href="#trashcan"></use>
                </svg></button>
        </div>

        @include('shared.search-bar', ['route' => 'works.index'])

        <div class="block-filters__tags filter-tags">
        </div>
        <input type="hidden" name="tagsHiddenInput" value="">
        <div class="block-filters__filters filters-list">
            <div class="filters-list__item filter-item" filter-dropdown id="work-type">
                <a filter-dropdown-button class="filter-item__name">
                    <span filter-dropdown-button>Тип работы</span>
                    <svg filter-dropdown-button class="arrow-icon">
                        <use xlink:href="#arrow"></use>
                    </svg>
                </a>
                <ul class="filter-item__settings filter-settings">
                    <li class="filter-settings__item" filter-item id="filter-Локация">
                        <span filter-item>Локация</span><span filter-item
                            class="filter-settings__amount">1000</span>
                    </li>
                    <li class="filter-settings__item" filter-item id="filter-Игра">
                        <span filter-item>Игра</span><span filter-item
                            class="filter-settings__amount">1000</span>
                    </li>
                    <li class="filter-settings__item" filter-item id="filter-Арт">
                        <span filter-item>Арт</span><span filter-item
                            class="filter-settings__amount">1000</span>
                    </li>
                </ul>
            </div>
            <div class="filters-list__item filter-item" filter-dropdown id="work-genre">
                <a filter-dropdown-button class="filter-item__name">
                    <span filter-dropdown-button>Жанр</span>
                    <svg filter-dropdown-button class="arrow-icon">
                        <use xlink:href="#arrow"></use>
                    </svg>
                </a>
                <ul class="filter-item__settings filter-settings">
                    <li class="filter-settings__item" filter-item id="filter-Хоррор">
                        <span filter-item>Хоррор</span><span filter-item
                            class="filter-settings__amount">1000</span>
                    </li>
                    <li class="filter-settings__item" filter-item id="filter-Фентези">
                        <span filter-item>Фентези</span><span filter-item
                            class="filter-settings__amount">1000</span>
                    </li>
                    <li class="filter-settings__item" filter-item id="filter-Реализм">
                        <span filter-item>Реализм</span><span filter-item
                            class="filter-settings__amount">1000</span>
                    </li>
                </ul>
            </div>
            <div class="filters-list__item filter-item" filter-dropdown id="work-ver">
                <a filter-dropdown-button class="filter-item__name">
                    <span filter-dropdown-button>Версия UE</span>
                    <svg filter-dropdown-button class="arrow-icon">
                        <use xlink:href="#arrow"></use>
                    </svg>
                </a>
                <ul class="filter-item__settings filter-settings">
                    <li class="filter-settings__item" filter-item id="filter-5_1">
                        <span filter-item>5_1</span><span filter-item
                            class="filter-settings__amount">1000</span>
                    </li>
                    <li class="filter-settings__item" filter-item id="filter-4_1">
                        <span filter-item>4_1</span><span filter-item
                            class="filter-settings__amount">1000</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
