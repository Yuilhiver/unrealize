<div class="filters-wrapper">
    <div class="works-page__filters-block block-filters admin-page__left-menu">

        @include('shared.search-box')

        <ul class="admin-page__links">
            <li class="
            {{ Route::is('admin.users') ? 'active' : '' }}
            ">
                <a class="stealth" href="{{ route('admin.users') }}">Авторы</a>
            </li>
            <li class="
            {{ Route::is('admin.works') ? 'active' : '' }}
            ">
                <a class="stealth" href="{{ route('admin.works') }}">Работы</a>
            </li>
            <li class="
            {{ Route::is('admin.articles') ? 'active' : '' }}
            ">
                <a class="stealth" href="{{ route('admin.articles') }}">Статьи</a>
            </li>
            <li class="
            {{ Route::is('admin.collaborations') ? 'active' : '' }}
            ">
                <a class="stealth" href="{{ route('admin.collaborations') }}">Коллаборации</a>
            </li>
        </ul>
    </div>
</div>
