<div class="authors-page__author-item">
    <a href="{{ route('users.show', $user->id) }}">
        <img loading="lazy"

        @if($user->getMedia('avatar')->last() != null)
            src="{{
                asset($user->getMedia('avatar')->last()->getUrl('thumb'))
            }}"
        @else
            src="{{
                asset($user->avatar)
            }}"
        @endif

        alt="Аватар">
    </a>
    <div class="authors-page__author-info">
        <div class="authors-page__author-info-nickname-desc">
            <a href="{{ route('users.show', $user->id) }}">{{ $user->login }}</a>
            <a href="{{ route('users.show', $user->id) }}" class="stealth">{{ $user->description }}</a>
        </div>
        <div class="authors-page__author-lower-part">
            <div class="authors-page__author-lower-left">
                <p class="authors-page__author-works-amount">{{ $user->works_count }} работ</p>
                <p class="authors-page__author-subs-amount">{{ $user->followers_count }}</span>
                    {{ $user->getNoun($user->followers()->count(), 'подписчик', 'подписчика', 'подписчиков') }}</p>
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
                @endif
            @endauth

        </div>
    </div>
</div>
