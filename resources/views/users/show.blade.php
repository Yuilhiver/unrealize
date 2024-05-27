@extends('layout.layout', ['title' => 'Профиль'])

@section('content')

    <main class="page">
        <div class="page__container">
            <div class='page__profile profile-page margin-header'>
                <div class="profile-page__upper-info profile-upper-info">
                    <div class="profile-upper-info__wrapper">
                        <div class="profile-upper-info__left-info">
                            <div class="profile-upper-info__avatar">
                                <img

                                    @if($user->getMedia('avatar')->last() != null)
                                    src="{{
                                        asset($user->getMedia('avatar')->last()->getUrl('thumb'))
                                    }}"
                                    @else
                                    src="{{
                                        asset($user->avatar)
                                    }}"
                                    @endif

                                    alt="Аватар профиля">
                            </div>
                            <div class="profile-upper-info__description">
                                <div>
                                    <h1 id="nickname">{{ $user->login }}</h1>
                                    <p id="description">{{ $user->description }}</p>

                                    @auth()
                                        @if(auth()->user()->is_admin)
                                            <button type="button" class="admin-btn" name="settings-popup" id="popup-btn">
                                                Настройки пользователя
                                            </button>
                                        @endif
                                    @endauth

                                </div>
                                <div class="profile-upper-info__subs-btns">
                                    <div class="profile-upper-info__subs">
                                        <span id="profile-subs">{{ $user->followers()->count() }}</span>
                                        {{ $user->getNoun($user->followers()->count(), 'подписчик', 'подписчика', 'подписчиков') }}
                                    </div>

                                    @auth()
                                        @if(Auth::user()->follows($user))
                                            <form action="{{ route('users.unfollow',$user->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="button" name="submit">Отписаться</button>
                                            </form>
                                        @elseif(Auth::id() !== $user->id)
                                            <form action="{{ route('users.follow',$user->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="button button-attention" name="submit">Подписаться</button>
                                            </form>
                                        @else
                                            <button type="button" class="button" name="settings-popup" id="popup-btn">
                                                <svg class="settings-icon">
                                                    <use xlink:href="#settings-icon"></use>
                                                </svg>
                                                Настройки
                                            </button>
                                        @endif
                                    @endauth

                                </div>
                            </div>
                        </div>
                        <div class="profile-upper-info__achievements">
                            <div class="profile-upper-info__header">
                                <svg class="achievements">
                                    <use xlink:href="#achievements"></use>
                                </svg>
                                <h1>Награды сообщества</h1>
                            </div>
                            <div class="profile-upper-info__achievements-list">

                                @if ($unlockedAchieves == null)
                                    <p>Нет достижений</p>
                                @endif
                                @foreach ($unlockedAchieves as $achievement)

                                    @if ($achievement->hasAchievement($user))
                                        <div class="profile-upper-info__achievement-item">
                                            <img src="{{ asset($achievement->emblem) }}" alt="Достижение">
                                            <p>{{ $achievement->name }}</p>
                                        </div>
                                    @endif

                                @endforeach

                            </div>
                            <button id="popup-btn" name="achievements-popup" type="button">
                                <svg aria-label="Все достижения" class="twoarrows-icon">
                                    <use xlink:href="#twoarrows"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <img

                        @if($user->getMedia('background_image')->last() != null)
                        src="{{
                            asset($user->getMedia('background_image')->last()->getUrl('thumb'))
                        }}"
                        @else
                        src="{{
                            asset($user->background_image)
                        }}"
                        @endif

                        alt="Шапка профиля" class="profile-upper-info__img">
                </div>
                <div class="profile-page__main-part profile-main-part">
                    <div class="profile-main-part__works-menu profile-works-menu">
                        <a id="{{ route('profile_works',$user->id) }}" data-ajax="{{ route('profile_works',$user->id) }}" class="stealth text-light-bg active" name="ajaxChange">Работы</a>
                        <a id="{{ route('profile_article',$user->id) }}" data-ajax="{{ route('profile_article',$user->id) }}" class="stealth text-light-bg" name="ajaxChange">Статьи</a>
                        <a id="{{ route('profile_cols',$user->id) }}" data-ajax="{{ route('profile_cols',$user->id) }}" class="stealth text-light-bg" name="ajaxChange">Коллаборации</a>
                    </div>
                </div>
                <div id="active-section" class="profile-page__works-wrapper profile-works-wrapper">

                </div>
            </div>
        </div>
    </main>
    </div>
    <div class="achievements-popup popup">
        <div class="popup__container">
            <button aria-label="Закрыть попап" class="cross-icon" id="popup-close" type="button">
                <svg>
                    <use xlink:href="#cross"></use>
                </svg>
            </button>
            <div class="achievements-popup__header">
                <svg class="achievements">
                    <use xlink:href="#achievements"></use>
                </svg>
                <h1>Награды сообщества</h1>
            </div>
            <div class="achievements-popup__achievements-list">

                @foreach ($achievements as $achievement)

                    @if (!$achievement->hasAchievement($user))
                        <div class="achievements-popup__achievement">
                            <svg class="lock-icon">
                                <use xlink:href="#lock"></use>
                            </svg>
                            <div class="achievements-popup__img-header">
                                <img src="{{ asset($achievement->emblem) }}" alt="Ачивка">
                                <h1>{{ $achievement->description }}</h1>
                            </div>
                            <p>Не открыто</p>
                        </div>
                    @else
                        <div class="achievements-popup__achievement active">
                            <svg class="lock-icon">
                                <use xlink:href="#lock"></use>
                            </svg>
                            <div class="achievements-popup__img-header">
                                <img src="{{ asset($achievement->emblem) }}" alt="Ачивка">
                                <h1>{{ $achievement->description }}</h1>
                            </div>
                            <p>Открыто</p>
                        </div>
                    @endif

                @endforeach

            </div>
        </div>
    </div>

    @auth()
        @if(auth()->user()->is_admin || Auth::id() == $user->id)
            <div class="settings-popup popup">
                <form class="popup__container" action="{{ route('users.update', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <button aria-label="Закрыть попап" class="cross-icon" id="popup-close" type="button">
                        <svg>
                            <use xlink:href="#cross"></use>
                        </svg>
                    </button>
                    <div class="achievements-popup__header">
                        <svg class="settings-icon">
                            <use xlink:href="#settings-icon"></use>
                        </svg>
                        <h1>Настройки</h1>
                    </div>
                    @if($errors->any())
                            @include('shared.error-message')
                        @endif
                    <div class="settings-popup__imgs">
                        <label class="settings-popup__img-avatar" for="bgInput">
                            <input accept="image/*" class="img-input" id="bgInput" name="avatar" type="file">
                            <img

                                @if($user->getMedia('avatar')->last() != null)
                                    src="{{
                                        asset($user->getMedia('avatar')->last()->getUrl('thumb'))
                                    }}"
                                @else
                                    src="{{
                                        asset($user->avatar)
                                    }}"
                                @endif

                            alt="" id="img-preview">
                        </label>
                        <label class="settings-popup__img-bg" for="avatarInput">
                            <img

                                @if($user->getMedia('background_image')->last() != null)
                                    src="{{
                                        asset($user->getMedia('background_image')->last()->getUrl('thumb'))
                                    }}"
                                @else
                                    src="{{
                                        asset($user->background_image)
                                    }}"
                                @endif

                            alt="" id="img-preview">
                            <div class="settings-popup__main-upper">
                                <input accept="image/*" class="img-input" id="avatarInput" name="background_image" type="file">
                            </div>
                        </label>
                    </div>
                    <div class="settings-popup__inputs">
                        <input class="dark-input" type="text" value="{{ $user->login }}" name="login" maxlength="40">
                        <input class="dark-input" type="text" value="{{ $user->email }}" name="email" maxlength="230">
                        <textarea class="dark-input" name="description" id="" rows="3" maxlength="130">{{ $user->description }}</textarea>
                    </div>
                    <div class="settings-popup__password-input">
                        <h1>Изменение пароля</h1>
                        <input class="dark-input" type="password" placeholder="ваш текущий пароль" name="old_password">
                        <input class="dark-input" type="password" placeholder="ваш новый пароль" name="new_password">
                    </div>
                    <button class="button button-attention" type="submit" name="submit">Сохранить</button>
                    <div class="settings-popup__attention-group">

                        @if(Auth::id() == $user->id)
                            <a class="settings-popup__attention stealth" id="popup-btn" name="logout-popup">Выйти из аккаунта</a>
                        @endif

                        <a class="settings-popup__attention red" id="popup-btn" name="dellaccount-popup">Удалить аккаунт</a>
                    </div>
                </form>
            </div>

            <div class="dellaccount-popup popup confirmation">
                <form class="popup__container" method="post" action="{{ route('users.destroy',$user->id) }}">
                    @csrf
                    @method('delete')
                    <div class="achievements-popup__header">
                        <h1>Вы действительно хотите <span class="red">удалить</span> аккаунт?</h1>
                    </div>
                    <div class="popup__flex-container">
                        <button type="button" id="popup-close" class="button button-attention">Нет</button>
                        <button type="submit" class="button button-attention" name="accdelete-form">Да</button>
                    </div>
                </form>
            </div>
            <div class="logout-popup popup confirmation">
                <form action="{{ route('logout') }}" method="post" class="popup__container">
                    @csrf
                    <div class="achievements-popup__header">
                        <h1>Вы действительно хотите <span class="red">выйти</span> из своего аккаунта?</h1>
                    </div>
                    <div class="popup__flex-container">
                        <button type="button" id="popup-close" class="button button-attention">Нет</button>
                        <button type="submit" class="button button-attention" name="logout-form">Да</button>
                    </div>
                </form>
            </div>

            <script type="text/javascript" defer>
                const imgInput = document.querySelectorAll(".img-input");

                imgInput.forEach((input) => {
                    input.addEventListener("change", (e) => {
                        const label = input.closest("label");
                        const imgContainer = label.querySelector("#img-preview");
                        imgContainer.src = URL.createObjectURL(e.target.files[0]);
                        imgContainer.onload = function() {
                            URL.revokeObjectURL(imgContainer.src) // free memory
                            imgContainer.classList.add('active');
                        }
                    });
                });
            </script>
        @endif
    @endauth

@endsection
