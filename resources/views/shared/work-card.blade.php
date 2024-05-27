<div class="works-list__item-first work-item-first">
    <div class="item-hover-element">
        <div class="item-upper-part">
            <div class="item-author-left-part">
                <a href="{{ route('users.show', $work->user_id) }}" class="item-avatar">
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

                    alt="аватар пользователя">
                </a>
                <a href="{{ route('users.show', $work->user_id) }}" class="item-author">{{ $work->user->login }}</a>
                <div class="item-date">
                    <span id="work-date">{{ date('d.m.Y', strtotime($work->created_at)) }}</span>
                </div>
            </div>
            <div class="item-author-right-part">
                <div class="item-work-amount"><span id="work-amount">{{ $work->user->works_count ?? 0 }}</span>
                    {{ $work->user->getNoun($work->user->works_count ?? 0, 'работа', 'работы', 'работ') }}
                </div>
                <div class="item-subscribers"><span id="subs-amount">{{ $work->user->followers_count ?? 0}}</span>
                    {{ $work->user->getNoun($work->user->followers_count ?? 0, 'подписчик', 'подписчика', 'подписчиков')}}</div>

                @auth()
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
                @endauth

            </div>
        </div>
        <a href="{{ route('works.show',$work->id) }}" class="item-img">
            <img loading="lazy" src="{{ asset($work->getMedia('works')->last()->getUrl('medium')) }}" alt="работа сообщества">
        </a>
        <a href="{{ route('works.show',$work->id) }}" class="item-hover stealth">
            <p class="item-type">{{ $work->type }}</p>
            <h1 class="item-header">{{ $work->title }}</h1>
            <p class="item-desc">{{ $work->shortDescription }}</p>
        </a>
        <div class="item-lower-info">
            <a href="{{ route('works.show',$work->id) }}#comments" class="item-comments">
                <svg class="comment">
                    <use xlink:href="#comment"></use>
                </svg>
                <span id="comment-amount">{{ $work->comments_count }}</span>
            </a>
            <a href="{{ route('works.show',$work->id) }}#comments" class="item-score">
                <div class="item-star-score" id="starDisplay">

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
            </a>
        </div>
    </div>
    <a a href="{{ route('works.show',$work->id) }}" class="second-img">
        <img loading="lazy" src="{{ asset($work->getMedia('works')->last()->getUrl('thumb')) }}" alt="работа сообщества">
    </a>
</div>
