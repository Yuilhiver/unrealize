@extends('layout.layout', ['title' => 'Коллаборация'])

@section('content')

            <main class="page">

                @if ($editing ?? false)
                    <form action="{{ route('collaborations.update',$collaboration->id) }}" method="post">
                        @csrf
                        @method('put')
                @endif

                <div class="page__container">
                    <div class="article-upper-info">
                        <div class="coll-upper-info__center">

                            @if($errors->any())
                                @include('shared.error-message')
                            @endif

                            <div class="coll-page">
                                <div class="coll-page__item">
                                    <div href="collaboration">
                                        <div class="cols-item__name-type">

                                            @if ($editing ?? false)
                                                <input type="text" class="dark-input work-info-block__header edit-input" placeholder="Название проекта" name="title" maxlength="150" value="{{ $collaboration->title }}">
                                                <select class="creation-page__value" name="worktype_id">

                                                    <option selected value={{ $collaboration->worktype_id }}>{{ $collaboration->worktype->name }}</option>
                                                    @foreach ($types as $worktype)
                                                        @if($collaboration->worktype->name != $worktype->name)
                                                            <option value="{{ $worktype->id }}">{{ $worktype->name }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            @else
                                                <h1>{{ $collaboration->title }}</h1>
                                                <p>{{ $collaboration->worktype->name }}</p>
                                            @endif

                                        </div>
                                        <div class="cols-item__col-header">коллаборация</div>

                                        @if ($editing ?? false)
                                            <div class="creation-page__desc-input-group">
                                                <textarea id="collabDesc" cols="10" rows="7" placeholder="Описание проекта" maxlength="1125" name="shortDescription" class="collab-creation-textarea edit-input">{{ $collaboration->shortDescription }}</textarea>
                                            </div>
                                        @else
                                            <p class="cols-item__desc">{{ $collaboration->shortDescription }}</p>
                                        @endif

                                    </div>
                                </div>
                                <div class="coll-page__chars">
                                    <div class="cols-item__char-item">
                                        <div class="cols-item__param">Версия UE:</div>

                                        @if ($editing ?? false)
                                            <select class="creation-page__value" name="version_id">

                                                <option selected value={{ $collaboration->version_id }}>{{ $collaboration->version->name }}</option>
                                                @foreach ($versions as $version)
                                                    @if($collaboration->version->name != $version->name)
                                                        <option value="{{ $version->id }}">{{ $version->name }}</option>
                                                    @endif
                                                @endforeach

                                            </select>
                                        @else
                                            <div class="cols-item__value">{{ $collaboration->version->name }}</div>
                                        @endif

                                    </div>
                                    <div class="cols-item__char-item">
                                        <div class="cols-item__param">Жанр:</div>

                                        @if ($editing ?? false)
                                            <select class="creation-page__value" name="workgenre_id">

                                                <option selected value={{ $collaboration->workgenre_id }}>{{ $collaboration->workgenre->name }}</option>
                                                @foreach ($genres as $workgenre)
                                                    @if($collaboration->workgenre->name != $workgenre->name)
                                                        <option value="{{ $workgenre->id }}">{{ $workgenre->name }}</option>
                                                    @endif
                                                @endforeach

                                            </select>
                                        @else
                                            <div class="cols-item__value">{{ $collaboration->workgenre->name }}</div>
                                        @endif

                                    </div>
                                    <div class="cols-item__char-item">
                                        <div class="cols-item__param">Доступные роли:</div>

                                        @if ($editing ?? false)
                                            <input type="text" class="dark-input" placeholder="Доступные роли в проекте" name="roles" maxlength="150" value="{{ $collaboration->roles }}">
                                        @else
                                            <div class="cols-item__value">{{ $collaboration->roles }}</div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="coll-page__contacts">
                                <div class="coll-page__contacts-param">Контакты автора:</div>

                                @if ($editing ?? false)
                                    <input type="text" class="dark-input" placeholder="Где можно с вами связаться? (например, Discord: exampleds, tg: exampletg, email: example@gmail.com)" name="contacts" maxlength="150" value="{{ $collaboration->contacts }}">
                                @else
                                    <div class="coll-page__contacts-value">{{ $collaboration->contacts }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="article-upper-info__lower-part">
                            <a href="{{ route('users.show',$collaboration->user_id) }}" class="article-upper-info__author">
                                <img loading="lazy"

                                @if($collaboration->user->getMedia('avatar')->last() != null)
                                    src="{{
                                        asset($collaboration->user->getMedia('avatar')->last()->getUrl('thumb'))
                                    }}"
                                @else
                                    src="{{
                                        asset($collaboration->user->avatar)
                                    }}"
                                @endif

                                alt="Аватар">
                                <h1>{{ $collaboration->user->login }}</h1>
                            </a>
                            <div class="article-upper-info__lower-left-part">

                                @auth()
                                    @can('update',$collaboration)
                                        @if ($editing ?? false)
                                            <button class="button button-attention" type="submit">Сохранить изменения</button>
                                        @else
                                            <a href="{{ route('collaborations.edit',$collaboration->id) }}" class="">Изменить</a>
                                            <button class="button" type="submit" id="popup-btn" name="workdel-popup">
                                                Удалить
                                            </button>
                                            <div class="workdel-popup popup confirmation">
                                                <form method="post" action="{{ route('collaborations.destroy',$collaboration->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="achievements-popup__header">
                                                        <h1>Вы действительно хотите <span class="red">удалить</span> коллаборацию?</h1>
                                                    </div>
                                                    <div class="popup__flex-container">
                                                        <button type="button" id="popup-close" class="button button-attention">Нет</button>
                                                        <button type="submit" class="button button-attention" name="submit">Да</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endcan
                                    @cannot('update',$collaboration)
                                        <a href="{{ route('users.show', $collaboration->user_id) }}" class="work-upper-info__link-item active">Работы автора</a>
                                        @if(Auth::user()->follows($collaboration->user))
                                            <form action="{{ route('users.unfollow',$collaboration->user->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="button" name="submit">Отписаться</button>
                                            </form>
                                        @elseif(Auth::id() !== $collaboration->user->id)
                                            <form action="{{ route('users.follow',$collaboration->user->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="button button-attention" name="submit">Подписаться</button>
                                            </form>
                                        @endif
                                    @endcannot
                                @endauth

                            </div>
                        </div>
                        <img loading="lazy" src="{{asset($collaboration->getMedia('collaborations')->last()->getUrl()) }}" alt="Фон статьи">
                    </div>
                </div>

                @if ($editing ?? false)
                    </form>
                @endif

            </main>

@endsection
