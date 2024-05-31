<header class="header">
    <nav class="header__nav nav-header">
        <div class="main-logotype"><a href="{{ route('index') }}">
                <p>UNREALIZE</p>
            </a></div>
        <div data-da=".ph-menu__body,767.98,1" class="nav-header__menu nav-menu menu__body">
            <a class="nav-menu__item" href="{{ route('index') }}">Главная</a>
            <div class="nav-menu__item item-dropdown" data-dropdown>
                <a data-dropdown-button>Сообщество</a>
                <ul data-da=".item-dropdown,767.98,0" class="item-dropdown__content dropdown__animation">
                    <li><a href="{{ route('works.index') }}">Работы</a></li>
                    <li><a href="{{ route('users.index') }}">Авторы</a></li>
                    <li><a href="{{ route('articles.index') }}">Статьи</a></li>
                    <li><a href="{{ route('collaborations.index') }}">Коллаборации</a></li>
                </ul>
            </div>
            <a class="nav-menu__item" href="{{ route('feed') }}">Подписки</a>
            @auth() @if (Auth::user()->is_admin)
                <a class="nav-menu__item" href="{{ route('admin.users') }}">Админ-панель</a>
            @endauth @endif
        </div>

        @auth()
            <div class="profile-btns" data-da=".ph-menu-bottom,767.98,3">
                <a href="{{ route('creation.index') }}"><button type="button" class="button button-attention">Создание</button></a>

                <a href="{{ route('users.show', auth()->id()) }}" class="header-avatar"><img

                    @if(Auth::user()->getMedia('avatar')->last() != null)
                        src="{{
                            asset(Auth::user()->getMedia('avatar')->last()->getUrl('thumb'))
                        }}"
                    @else
                        src="{{
                            asset(Auth::user()->avatar)
                        }}"
                    @endif

                    alt="Аватар профиля"></a>
            </div>
        @endauth

        @guest
            <div data-da=".ph-menu__body,767.98,3" class="nav-header__buttons btns-menu">
                <a href="{{ route('login') }}"><button class="btns-menu__login button">Войти</button></a>
            </div>
        @endguest

        <nav class="ph-menu"><button aria-label="Меню навигации" type="button" class="icon-menu">
                <span></span>
                <span></span>
                <span></span>
            </button><div class="ph-menu__body"></div></nav>
    </nav>
</header>
