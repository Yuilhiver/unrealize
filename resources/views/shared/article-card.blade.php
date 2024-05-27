<div class="article-view-wrapper__item article-item">
    <a href="{{ route('users.show', $article->user_id) }}" class="article-item__avatar-line">
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
    </a>
    <div class="article-item__right-part">
        <div class="article-item__header">
            <a href="{{ route('users.show', $article->user_id) }}" class="article-item__header-left">
                <h1>{{ $article->user->login }}</h1>
                <p>{{ date('d.m.Y', strtotime($article->created_at)) }}</p>
            </a>
            <div class="cols-item__header-right">
                <div class="cols-item__works-amout">{{ $article->user->works_count ?? 0 }}
                    {{ $article->user->getNoun($article->user->works_count ?? 0, 'работа', 'работы', 'работ') }}</div>
                <div class="cols-item__subs-amout">{{ $article->user->followers_count ?? 0 }}</span>
                    {{ $article->user->getNoun($article->user->followers_count ?? 0, 'подписчик', 'подписчика', 'подписчиков') }}</div>

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

            </div>
        </div>
        <h1 class="article-item__art-name">Статья</h1>
        <a href="{{ route('articles.show',$article->id) }}" class="stealth">
            <h1 href="profile" class="article-item__article-name stealth">{{ $article->title }}</h1>
            <p href="profile" class="article-item__content">{{ $article->shortDescription }}</p>
        </a>
    </div>
    <img loading="lazy" src="{{ asset($article->getMedia('articles')->last()->getUrl('thumb')) }}" alt="Коллаборации">
</div>
