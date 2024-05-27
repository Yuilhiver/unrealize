@extends('layout.layout', ['title' => 'Статья'])

@section('content')

    <main class="page">

        @if ($editing ?? false)
            <form action="{{ route('articles.update',$article->id) }}" method="post">
                @csrf
                @method('put')
        @endif

        <div class="page__container">
            <div class="article-upper-info">
                <div class="article-upper-info__center">

                    @if($errors->any())
                        @include('shared.error-message')
                    @endif

                    @if ($editing ?? false)
                        <input type="text" class="dark-input work-info-block__header edit-input article-edit-input edit-margins" placeholder="Название" name="title" maxlength="150" value="{{ $article->title }}">
                        <input type="text" class="dark-input work-info-block__description edit-input article-edit-input" placeholder="Краткое описание" name="shortDescription" maxlength="525" value="{{ $article->shortDescription }}">
                    @else
                        <h1>{{ $article->title }}</h1>
                        <p>{{ $article->shortDescription }}</p>
                    @endif

                    <div class="coll-page__chars article-chars">
                        <div class="cols-item__char-item">
                            <div class="cols-item__param">Версия UE:</div>

                            @if ($editing ?? false)
                                <select class="creation-page__value" name="version_id">

                                    <option selected value={{ $article->version_id }}>{{ $article->version->name }}</option>
                                    @foreach ($versions as $version)
                                        @if($article->version->name != $version->name)
                                            <option value="{{ $version->id }}">{{ $version->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            @else
                                <div class="cols-item__value">{{ $article->version->name }}</div>
                            @endif

                        </div>
                        <div class="cols-item__char-item">
                            <div class="cols-item__param">Тематика:</div>

                            @if ($editing ?? false)
                                <select class="creation-page__value" name="articletheme_id">

                                    <option selected value={{ $article->articletheme_id }}>{{ $article->articletheme->name }}</option>
                                    @foreach ($articlethemes as $articletheme)
                                        @if($article->articletheme->name != $articletheme->name)
                                            <option value="{{ $articletheme->id }}">{{ $articletheme->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            @else
                                <div class="cols-item__value">{{ $article->articletheme->name }}</div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="article-upper-info__lower-part">
                    <a href="{{ route('users.show', $article->user_id) }}" class="article-upper-info__author">
                        <img loading="lazy"

                        @if($article->user->getMedia('avatar')->last() != null)
                            src="{{
                                asset($article->user->getMedia('avatar')->last()->getUrl('thumb'))
                            }}"
                        @else
                            src="{{
                                asset($article->user->avatar)
                            }}"
                        @endif

                        alt="Аватар">
                        <h1>{{ $article->user->login }}</h1>
                    </a>
                    <div class="article-upper-info__lower-left-part">

                    @auth()
                        @can('update',$article)
                            @if ($editing ?? false)
                                <button class="button button-attention" type="submit">Сохранить изменения</button>
                            @else
                                <a href="{{ route('articles.edit',$article->id) }}" class="">Изменить</a>
                                <button class="button" type="submit" id="popup-btn" name="workdel-popup">
                                    Удалить
                                </button>
                                <div class="workdel-popup popup confirmation">
                                    <form method="post" action="{{ route('articles.destroy',$article->id) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="achievements-popup__header">
                                            <h1>Вы действительно хотите <span class="red">удалить</span> статью?</h1>
                                        </div>
                                        <div class="popup__flex-container">
                                            <button type="button" id="popup-close" class="button button-attention">Нет</button>
                                            <button type="submit" class="button button-attention" name="submit">Да</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endcan
                        @cannot('update',$article)
                            <a href="{{ route('users.show', $article->user_id) }}" class="work-upper-info__link-item active">Работы автора</a>
                            @auth()
                                @if(Auth::user()->follows($article->user))
                                    <form action="{{ route('users.unfollow',$article->user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="button" name="submit">Отписаться</button>
                                    </form>
                                @elseif(Auth::id() !== $article->user->id)
                                    <form action="{{ route('users.follow',$article->user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="button button-attention" name="submit">Подписаться</button>
                                    </form>
                                @endif
                            @endauth
                        @endcannot
                    @endauth

                    </div>
                </div>
                <img loading="lazy" src="{{ asset($article->getMedia('articles')->last()->getUrl()) }}" alt="Фон статьи">
            </div>
            <div class='page__work work-page dark-container'>
                <div class="work-page__description work-description dark-container-section ">
                    <div class="work-description__content work-description-content">

                        @if ($editing ?? false)
                            <div class="creation-page__desc-input-group">
                                <textarea name="content" placeholder="Содержание статьи" class="textarea-edit" maxlength="25500">{{ $article->content }}</textarea>
                            </div>
                        @else
                            <p>{!! nl2br(e($article->content)) !!}</p>
                        @endif

                    </div>
                </div>

                @if ($editing ?? false)
                    </form>
                @endif

            </div>
    </main>

@endsection
