<div class="works-page__works-menu works-menu">
    <div class="works-menu__menu-view view-menu">
        <div class="view-menu__menu">

            <div class="{{ $sort === 'desc' && $sortBy != 'rating' && $sortBy != 'comments_count' ? 'active' : '' }}
                        works-menu__item menu-item sort-item" sort-item wire:click="setSort('desc')">
                <svg class="menu-item__icon" sort-item>
                    <use xlink:href="#new-works" sort-item></use>
                </svg>
                <div class="menu-item__header" sort-item>Новые</div>
                <img loading="lazy" src="{{ asset('assets/img/new-works.webp') }}" alt="Новые">
            </div>

            <div class="{{ $sort === 'asc' ? 'active' : '' }} works-menu__item menu-item sort-item" sort-item wire:click="setSort('asc')">
                <svg class="menu-item__icon" sort-item>
                    <use xlink:href="#all-works" sort-item></use>
                </svg>
                <div class="menu-item__header" sort-item>Старые</div>
                <img loading="lazy" src="{{ asset('assets/img/all-works.webp') }}" alt="Все работы">
            </div>

            <div class="{{ $sortBy === 'rating' ? 'active' : '' }} works-menu__item menu-item" wire:click="setSort('rating')">
                <svg class="menu-item__icon">
                    <use xlink:href="#best-works" ></use>
                </svg>
                <div class="menu-item__header">Лучшие</div>
                <img loading="lazy" src="{{ asset('assets/img/best-works.webp') }}" alt="Лучшие">
            </div>

            <div class="{{ $sortBy === 'comments_count' ? 'active' : '' }} works-menu__item menu-item" wire:click="setSort('comments')">
                <svg class="menu-item__icon" >
                    <use xlink:href="#popular-works"></use>
                </svg>
                <div class="menu-item__header">Популярные</div>
                <img loading="lazy" src="{{ asset('assets/img/popular-works.webp') }}" alt="Популярные">
            </div>

        </div>
        <div class="view-menu__view-amout">
            <div class="view-menu__view">
                <h1 class="works-menu__view-header">Вид</h1>
                <div class="works-menu__view-buttons">
                    <button aria-label="Первый вид работ"
                        class="works-menu__view-button view-button active" id="1" view-btn>
                        <svg view-btn>
                            <use view-btn xlink:href="#view-type-1"></use>
                        </svg>
                    </button>
                    <button aria-label="Второй вид работ" class="works-menu__view-button view-button"
                        id="2" view-btn>
                        <svg view-btn>
                            <use view-btn xlink:href="#view-type-2"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="view-menu__amount">
                <span id="work-amount">{{ $this->works->total() }}</span> найдено
            </div>
        </div>
    </div>

    <div>
        @if(count($this->works) < 1)
            <div class="empty-error">
                <h1>Ничего не найдено</h1>
            </div>
        @endif
        <div class="works-menu__works works-list">

            @foreach ($this->works as $work)
                @include('shared.work-card')
            @endforeach

        </div>
        {{ $this->works->withQueryString()->onEachSide(1)->links('pagination::tailwind') }}
    </div>

</div>
