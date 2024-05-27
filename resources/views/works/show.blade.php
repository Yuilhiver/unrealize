@extends('layout.layout', ['title' => 'Работа'])

@section('content')
    <main class="page">

        @if ($editing ?? false)
            <form action="{{ route('works.update',$work->id) }}" method="post">
                @csrf
                @method('put')
        @endif

        <div class="page__container">
            <div class='page__work dark-container work-page margin-header'>
                <div class="work-page__upper-info dark-container-section work-upper-info">
                    <div class="work-upper-info__left">
                        <a href="{{ route('users.show', $work->user_id) }}" class="work-upper-info__avatar">
                            <img loading="lazy"

                            @if($work->user->getMedia('avatar')->last() != null)
                                src="{{
                                    asset($work->user->getMedia('avatar')->last()->getUrl('thumb'))
                                }}"
                            @else
                                src="{{
                                    asset($work->user->avatar)
                                }}"
                            @endif

                            alt="">
                        </a>
                        <a href="{{ route('users.show', $work->user_id) }}" class="work-upper-info__nickname">{{ $work->user->login }}</a>
                    </div>
                    <div class="work-upper-info__rigth">

                    @auth()
                        @can('update',$work)
                            @if ($editing ?? false)
                                <button type="submit" class="button button-attention">Сохранить изменения</button>
                            @else
                                <a href="{{ route('works.edit',$work->id) }}" class="">Изменить</a>
                                <button class="button" type="submit" id="popup-btn" name="workdel-popup">
                                    Удалить
                                </button>
                                <div class="workdel-popup popup confirmation">
                                    <form method="post" action="{{ route('works.destroy',$work->id) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="achievements-popup__header">
                                            <h1>Вы действительно хотите <span class="red">удалить</span> работу?</h1>
                                        </div>
                                        <div class="popup__flex-container">
                                            <button type="button" id="popup-close" class="button button-attention">Нет</button>
                                            <button type="submit" class="button button-attention" name="submit">Да</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endcan
                        @cannot('update',$work)
                            <a href="{{ route('users.show', $work->user_id) }}" class="work-upper-info__link-item active">Работы автора</a>
                            @if(Auth::user()->follows($work->user))
                                <form action="{{ route('users.unfollow',$work->user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="button" name="submit">Отписаться</button>
                                </form>
                            @elseif(Auth::id() !== $work->user->id)
                                <form action="{{ route('users.follow',$work->user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="button button-attention" name="submit">Подписаться</button>
                                </form>
                            @endif
                        @endcannot
                    @endauth

                    </div>
                </div>
                @if($errors->any())
                    @include('shared.error-message')
                @endif
                <div class="work-page__main-info dark-container-section work-main-info">
                    <div class="work-main-info__images work-img-list">
                        <div class="work-img-list__main-img">
                            <img loading="lazy" alt="">
                        </div>
                        <div class="work-img-list__lower">
                            <button aria-label="Предыдущий" type="button" class="work-img-list__button" id="back-button">
                                <svg class="twoarrows-icon">
                                    <use xlink:href="#twoarrows"></use>
                                </svg>
                            </button>
                            <div class="work-img-list__list" id='scroll-container'>
                                <div class="work-img-list__img-lower">
                                    <img loading="lazy" class="active" src="{{ asset($work->getMedia('works')->last()->getUrl()) }}" alt="">
                                </div>

                                @foreach ($imgArray = explode(",", $work->additionalImgs) as $img)
                                    <div class="work-img-list__img-lower">
                                        <img loading="lazy" src="{{ asset($img) }}" alt="">
                                    </div>
                                @endforeach

                            </div>
                            <button aria-label="Следующий" type="button" class="work-img-list__button" id="forward-button">
                                <svg class="twoarrows-icon">
                                    <use xlink:href="#twoarrows"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="work-main-info__info-block work-info-block">

                        @if($editing ?? false)
                            <input type="text" class="dark-input work-info-block__header edit-input" placeholder="Название" name="title" maxlength="150" value="{{ $work->title }}">
                        @else
                            <h1 class="work-info-block__header">{{ $work->title }}</h1>
                        @endif

                        <div class="work-info-block__star-score">
                            <div class="work-info-block__stars" id="starDisplay">

                                @for ($i=0;$i<5;$i++)
                                    @if ($work->rating>$i)
                                        <svg class="star-icon active">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    @else
                                        <svg class="star-icon">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    @endif
                                @endfor

                            </div>
                            <div class="work-info-block__star-amount"><span id="review-amount">{{ $work->comments->count() }}</span>
                                {{ $work->user->getNoun($work->comments->count(), 'отзыв', 'отзыва', 'отзывов') }}</div>
                        </div>

                        @if($editing ?? false)
                            <input type="text" class="dark-input work-info-block__description edit-input" placeholder="Краткое описание" name="shortDescription" maxlength="1125" value="{{ $work->shortDescription }}">
                        @else
                            <p class="work-info-block__description">{{ $work->shortDescription }}</p>
                        @endif

                        <div class="work-info-block__char-info work-char-info">
                            <div class="work-char-info__item">
                                <p class="work-char-info__char">Дата</p>
                                <p class="work-char-info__value">{{ date('d.m.Y', strtotime($work->created_at)) }}</p>
                            </div>
                            <div class="work-char-info__item">
                                <p class="work-char-info__char">Автор</p>
                                <a href="#" class="work-char-info__value">{{ $work->user->login }}</a>
                            </div>
                            <div class="work-char-info__item">
                                <p class="work-char-info__char">Тип</p>

                                @if ($editing ?? false)

                                    <select class="creation-page__value edit-margins" name="worktype_id">
                                        <option selected value={{ $work->worktype->id }}>{{ $work->worktype->name }}</option>
                                        @foreach ($worktypes as $worktype)
                                            @if($work->worktype->name != $worktype->name)
                                                <option value="{{ $worktype->id }}">{{ $worktype->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                @else
                                    <p class="work-char-info__value">{{ $work->worktype->name }}</p>
                                @endif

                            </div>
                            <div class="work-char-info__item">
                                <p class="work-char-info__char">Жанр</p>

                                @if ($editing ?? false)

                                    <select class="creation-page__value edit-margins" name="workgenre_id">
                                        <option selected value="{{ $work->workgenre->id }}">{{ $work->workgenre->name }}</option>
                                        @foreach ($genres as $workgenre)
                                            @if($work->workgenre->name != $workgenre->name)
                                                <option value="{{ $workgenre->id }}">{{ $workgenre->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                @else
                                    <p class="work-char-info__value">{{ $work->workgenre->name }}</p>
                                @endif

                            </div>
                            <div class="work-char-info__item">
                                <p class="work-char-info__char">Версия</p>

                                @if ($editing ?? false)

                                    <select class="creation-page__value edit-margins" name="version_id">
                                        <option selected value="{{ $work->version->id }}">{{ $work->version->name }}</option>
                                        @foreach ($versions as $version)
                                            @if($work->version->name != $version->name)
                                                <option value="{{ $version->id }}">{{ $version->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                @else
                                    <p class="work-char-info__value">{{ $work->version->name }}</p>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
                <div class="work-page__description dark-container-section work-description">
                @if($editing ?? false)
                    <div class="creation-page__desc-input-group edit-input">
                        <textarea cols="10" rows="7" name="description" class="textarea-edit" placeholder="Описание работы" maxlength="15500"> {{ $work->description }} </textarea>
                    </div>
                @else
                    {!! nl2br(e($work->description)) !!}
                @endif
                </div>
                @if ($editing ?? false)
                    </form>
                @endif

                @if ($editing ?? false)
                @else
                @include('shared.comments-box', ['entityId' => $work->id])
                @endif

                <div class="img-popup">
                    <span id="big-picture-close">&times;</span>
                    <button aria-label="Предыдущий" type="button" class="work-img-list__button" id="back-button">
                        <svg class="twoarrows-icon">
                            <use xlink:href="#twoarrows"></use>
                        </svg>
                    </button>
                    <img loading="lazy" src="{{ asset('') }}" alt="Увеличенное изображение">
                    <button aria-label="Следующий" type="button" class="work-img-list__button" id="forward-button">
                        <svg class="twoarrows-icon">
                            <use xlink:href="#twoarrows"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection
