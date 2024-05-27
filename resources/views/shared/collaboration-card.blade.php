<div class="cols-view-wrapper__item cols-item">
    <div class="cols-item__header">
        <a href="{{ route('users.show',$collaboration->user_id) }}" class="cols-item__header-left">
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

            alt="Аватар пользователя">
            <h1>{{ $collaboration->user->login }}</h1>
        </a>
        <div class="cols-item__header-right">
            <div class="cols-item__works-amout">{{ $collaboration->user->works_count ?? 0 }}
                {{ $collaboration->user->getNoun($collaboration->user->works_count ?? 0, 'работа', 'работы', 'работ') }}</div>
            <div class="cols-item__subs-amout">{{ $collaboration->user->followers_count ?? 0 }}</span>
                {{ $collaboration->user->getNoun($collaboration->user->followers_count ?? 0, 'подписчик', 'подписчика', 'подписчиков') }}</div>

            @auth()
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
            @endauth

        </div>
    </div>
    <a class="stealth" href="{{ route('collaborations.show',$collaboration->id) }}">
        <div class="cols-item__col-header">коллаборация</div>
        <div class="cols-item__name-type">
            <h1>{{ $collaboration->title }}</h1>
            <p>{{ $collaboration->type }}</p>
        </div>
        <p class="cols-item__desc">{{ $collaboration->shortDescription }}</p>
        <div class="cols-item__chars">
            <div class="cols-item__char-item">
                <div class="cols-item__param">Версия UE:</div>
                <div class="cols-item__value">{{ $collaboration->version->name }}</div>
            </div>
            <div class="cols-item__char-item">
                <div class="cols-item__param">Жанр:</div>
                <div class="cols-item__value">{{ $collaboration->workgenre->name }}</div>
            </div>
            <div class="cols-item__char-item">
                <div class="cols-item__param">Доступные роли:</div>
                <div class="cols-item__value">{{ $collaboration->roles }}</div>
            </div>
        </div>
    </a>
    <img loading="lazy" src="{{ asset($collaboration->getMedia('collaborations')->last()->getUrl('thumb')) }}" alt="Коллаборации">
</div>
